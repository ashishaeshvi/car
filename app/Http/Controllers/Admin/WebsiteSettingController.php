<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteSetting;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;


class WebsiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ViewWebsiteSettingPage(Request $request){
        //$id = decrypt($id);
        $data['title'] =  "Edit Setting";      
        $data['access'] = 'access_granted'; 
        $data['settings'] = WebsiteSetting::where('id','1')->first();
       
        return view('admin.setting.setting', $data);
    }


    public function updatesetting (Request $request)
    {
          try {
                $check_already_data = WebsiteSetting::where('id','1')->count();
                $error_flag=0;
                $data['web_mobile_number']=trim($request->web_mobile_number);
                $data['web_email_id']=trim($request->web_email_id);
                $data['company_name']=trim($request->company_name);                  
                $data['company_address']=$request->company_address;               
                $data['footer_description']=$request->footer_description;                 
                $data['copyright_text']=$request->copyright_text;                              
                
                if(!empty($request->website_logo)){
                     $uploadedFileName = uploadFiles($request, 'website_logo', 'website');              
                    $data['website_logo'] = $uploadedFileName;
                }

                $data['updated_at']=date('Y-m-d H:i:s');
               if($error_flag==0){
                    if($check_already_data > 0){
                        $add = WebsiteSetting::where('id','1')->update($data); 
                        $msg="Setting Updated Successfully";    
                    }else{
                        $data['created_at']=date('Y-m-d H:i:s');
                        $add = WebsiteSetting::insertGetId($data);  
                        $msg="Setting Added Successfully";   
                    }   
                } 

                 return response()->json([
                'success' => true,
                'message' => $msg,
               
            ]);
        } catch (\Exception $e) {
            Log::error('Setting save failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('Failed to save setting. Please try again.'),
            ], 500);
        }             
    }

    public function logActivity(Request $request)
    {
        $data['title'] = 'Activity Log List';
        $activities = Activity::with('causer');

        if ($request->ajax()) {
            return DataTables::of($activities)
                ->addIndexColumn()
                ->addColumn('user', fn($row) => $row->causer?->name ?? 'System')
                ->addColumn('event_name', fn($row) => ucfirst($row->event))
                ->addColumn('description', fn($row) => $row->description)
                ->addColumn('changes', function ($row) {
                    $changes = $row->properties ?? [];
                    $html = '';

                    $formatVal = function ($val) {  // Helper to handle arrays/objects
                        if (is_array($val) || is_object($val)) {
                            return json_encode($val, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                        }
                        return $val ?? '-';
                    };

                    if (isset($changes['attributes']) && !isset($changes['old'])) { // Case 1: Create
                        foreach ($changes['attributes'] as $key => $newVal) {
                            $html .= "<b>{$key}</b>: - &#10233; " . $formatVal($newVal) . "<br>";
                        }
                    } elseif (isset($changes['attributes']) && isset($changes['old'])) { // Case 2: Update
                        foreach ($changes['attributes'] as $key => $newVal) {
                            $oldVal = $changes['old'][$key] ?? '-';
                            if ($oldVal != $newVal) {
                                $html .= "<b>{$key}</b>: " . $formatVal($oldVal) . " &#10233; " . $formatVal($newVal) . "<br>";
                            }
                        }
                    } elseif (!isset($changes['attributes']) && isset($changes['old'])) {  // Case 3: Delete
                        foreach ($changes['old'] as $key => $oldVal) {
                            $html .= "<b>{$key}</b>: " . $formatVal($oldVal) . " &#10233; -<br>";
                        }
                    } else { // Case 4: Flat properties (like login/logout with ip & agent)
                        foreach ($changes as $key => $val) {
                            $html .= "<b>{$key}</b>: " . $formatVal($val) . "<br>";
                        }
                    }

                    return $html ?: '-';
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d F, Y H:i'))
                ->rawColumns(['changes'])
                ->make(true);
        };

        return view('admin.activities.index')->with($data);
    }


    public function showLogsPage()
    {
        $path = storage_path('logs/laravel.log');
        if (!File::exists($path)) {
            return view('logs.index', ['logs' => []]);
        }
        $title = 'Error Logs';

        $logContent = File::get($path);
        $pattern = "/\[(.*?)\]\s([a-zA-Z0-9._-]+)\.(\w+):\s(.*?)(?=\n\[|\Z)/s";

        preg_match_all($pattern, $logContent, $matches, PREG_SET_ORDER);

        $logs = collect($matches)->map(function ($match) {
            return [
                'timestamp' => $match[1],
                'env'       => $match[2],
                'level'     => $match[3],
                'message'   => trim($match[4]),
            ];
        });

        return view('admin.activities.logs', compact('logs', 'title'));
    }
}
