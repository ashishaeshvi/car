<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;
use DB;

class DealerController extends Controller
{
 /**
     * Display dealer listing.
     */
    public function index(Request $request)
    {

       
        abort_if(!auth()->user()->can('dealer.view'), 403, __('User does not have the right permissions.'));

        $data['title'] = 'Dealer List';
        $data['create_title'] = 'Add Dealer';
        $authUser = auth()->user();
        $authId   = $authUser->id;       

     $query = User::with(['role', 'createdBy'])
    ->when($authUser->role_id != 1, function ($query) use ($authId) {
        return $query->where('users.added_by', $authId);
    })
    ->where('users.role_id', '=', 4)
    ->whereNull('users.deleted_at')
    ->select('users.*')
    ->leftJoin('users as creator', 'users.added_by', '=', 'creator.id')
    ->leftJoin('cities as city', 'users.city', '=', 'city.id')
    ->addSelect('creator.name as created_by_name', 'city.name as city_name');

        if ($request->ajax()) {
            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
        if ($request->has('search') && $search = $request->input('search.value')) {
            $search = strtolower($search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(users.name) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(users.email) LIKE ?', ["%$search%"])
                   ->orWhereRaw('LOWER(users.address) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(users.mobile) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(users.status) LIKE ?', ["%$search%"])
                  ->orWhereRaw('LOWER(city.name) LIKE ?', ["%$search%"]);
                //   ->orWhereRaw('LOWER(users.state) LIKE ?', ["%$search%"]);
            });
        }
    })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M, Y'))
                ->addColumn('action', fn($row) => $this->generateActionButtons($row))
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('admin.dealers.list')->with($data);
    }

    private function generateActionButtons($dealer)
    {
        $html = '';
        if (auth()->user()->can('dealer.edit')) {
            $html .= '<a href="' . route('dealers.edit', encrypt($dealer->id)) . '" title="Edit"><i class="fa fa-edit"></i></a> ';
        }


        if (auth()->user()->can('dealer.status')) {
            $status = $dealer->status;
            $id = encrypt($dealer->id);
            $url = route('user.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-user-slash text-danger' : 'fa-user-check text-success';
            $tableid = 'dealers-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }

        if (auth()->user()->can('dealer.delete')) {
            $id = encrypt($dealer->id);
            $url = route('dealers.destroy', $id);
            $tableid = 'dealers-table';

            $html .= '<button type="button" class="btn btn-danger btn-xs delete-record"
                data-id="' . $id . '"
                data-url="' . $url . '"
                data-tableid="' . $tableid . '"
                data-title="dealer"
                title="Delete">
                <i class="fa fa-trash"></i>
            </button>';
        }

        return $html;
    }

    /**
     * Show create form
     */
    public function create()
    {
        abort_if(!auth()->user()->can('dealer.create'), 403, __('User does not have the right permissions.'));
  $cities  = City::select('id', 'name')->get();
        $title = 'Add Dealer';
        return view('admin.dealers.add',  compact('cities','title'));
    }

    /**
     * Store or update dealer.
     */
   public function storeOrUpdate(Request $request)
{
    $isUpdate = $request->dealerEditId;

    $rules = [
        'dealer_name'       => 'required|string|max:255',
        'contact_person'    => 'required|string|max:255',
        'email'             => [
            'required', 'email', 'max:255',
            Rule::unique('users', 'email')->ignore($isUpdate)->whereNull('deleted_at'),
        ],
        'mobile'            => 'required|digits:10',
        'alternate_phone'   => 'nullable|digits:10',
        'password'          => $isUpdate ? 'nullable|min:6' : 'required|min:6',
        'dealership_name'   => 'required|string|max:255',
        'dealer_code'       => 'nullable|string|max:50',
        'dealer_type'       => 'required|in:new,used,both',
        'rera_license'      => 'nullable|string|max:100',
        'address'           => 'required|string|max:255',
        'address_line2'     => 'nullable|string|max:255',
        'city'              => 'required|string|max:100',        
        'pincode'           => 'required|digits:6',
        'google_map'        => 'nullable|string|max:255',
        'established_year'  => 'nullable|digits:4',
        'employees'         => 'nullable|integer',
        'monthly_sales'     => 'nullable|integer',
        //'dealer_logo'       => $isUpdate ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120',
        'trade_license'     => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
        'pan_card'          => 'nullable|mimes:pdf,jpeg,png,jpg|max:5120',
    ];

    $validator = Validator::make($request->all(), $rules);

   

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // 1. Save core dealer info in users table
    $dealer = $isUpdate ? User::findOrFail($isUpdate) : new User();
    $dealer->name   = $request->dealer_name;
    $dealer->email  = $request->email;
    $dealer->mobile = $request->mobile;
    $dealer->address = $request->address;
    $dealer->city = $request->city;
    $dealer->pincode = $request->pincode; 
    $dealer->dealer_type = $request->dealer_type; 
     if (!$isUpdate) {
    $dealer->added_by = auth()->id();
}
    if ($request->hasFile('dealer_logo')) {
    $dealer->profile_image = uploadFiles($request, 'dealer_logo', 'dealer_logo');
      }

if ($request->hasFile('pan_card')) {
   $dealer->id_proof = uploadFiles($request, 'pan_card', 'pan_card');
}
    $dealer->role_id = 4;
    if ($request->password) {
        $dealer->password = bcrypt($request->password);
    }

    $dealer->save();

    $metaData = [
    'contact_person'  => $request->contact_person,
    'alternate_phone' => $request->alternate_phone,
    'dealership_name' => $request->dealership_name,
    'dealer_code'     => $request->dealer_code,   
    'address_line2'   => $request->address_line2,    
    'google_map'      => $request->google_map,
    'established_year'=> $request->established_year,
    'employees'       => $request->employees,
    'monthly_sales'   => $request->monthly_sales,
];


if ($request->hasFile('trade_license')) {
    $metaData['trade_license'] = uploadFiles($request, 'trade_license', 'trade_license');
}


// Use trait to save all meta at once
$dealer->setMetaBulk($metaData);



    $message = $isUpdate ? 'Dealer updated successfully' : 'Dealer added successfully';

    return redirect()->route('dealers.index')
        ->with('success', $message);
}



    /**
     * Edit dealer
     */
    public function edit($id)
    {
        abort_if(!auth()->user()->can('dealer.edit'), 403, __('User does not have the right permissions.'));

        try {
            $title = 'Edit Dealer';
            $dealerId = decrypt($id);
            $cities  = City::select('id', 'name')->get();
          $dealer = User::with('meta')->findOrFail($dealerId);
          
           return view('admin.dealers.add', compact('dealer','title','cities'));
        } catch (\Exception $e) {
            Log::error('Dealer edit failed', ['message' => $e->getMessage()]);
            return redirect()->route('dealers.index')->with('error', __('Failed to retrieve dealer for editing.'));
        }
    }

    /**
     * Delete dealer
     */
    public function destroy($id)
    {
        abort_if(!auth()->user()->can('dealer.delete'), 403, __('User does not have the right permissions.'));

        try {
            DB::beginTransaction();
            $dealer = User::findOrFail(decrypt($id));
            $dealer->delete();

            if ($dealer->dealer_logo) deleteFiles($dealer->dealer_logo);
            if ($dealer->trade_license) deleteFiles($dealer->trade_license);
            if ($dealer->pan_card) deleteFiles($dealer->pan_card);

            DB::commit();

            return response()->json(['message' => 'Dealer deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Dealer deletion failed: ' . $e->getMessage());
            return response()->json([
                'status'  => false,
                'message' => __('Failed to delete dealer. Please try again.')
            ], 500);
        }
    }
}
