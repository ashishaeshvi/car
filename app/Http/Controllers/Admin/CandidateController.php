<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllCountry;
use App\Models\AllState;
use App\Models\Candidate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use Yajra\DataTables\DataTables;

class CandidateController extends Controller
{
    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('candidate-form.view'), 403, __('This section does not have the right permissions.'));

        $data['title'] = 'Online & Offline Form List';
        $data['create_title'] = 'Online & Offline Form';
        $authId = auth()->id();

        $candidates = Candidate::with(['user', 'passportDetail'])->when(auth()->user()->role_id != 1, function ($query) use ($authId) {
            return $query->where('user_id', $authId);
        });
        if ($request->ajax()) {
            return DataTables::of($candidates)
                ->addIndexColumn()
                ->addColumn('full_name', fn($candidates) => $candidates->full_name)
                ->filterColumn('full_name', function ($query, $search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name_eng', 'like', "%{$search}%")
                            ->orWhere('last_name_eng', 'like', "%{$search}%");
                    });
                })
                ->orderColumn('full_name', function ($query, $order) {
                    $query->orderBy('first_name_eng', $order)
                        ->orderBy('last_name_eng', $order);
                })
                // ->addColumn('filled_by', fn($row) => $row->filled_by)
                ->editColumn('status', fn($row) => ucfirst($row->status))
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M, Y'))
                ->editColumn('action', function ($candidates) {
                    return $this->generateActionButtons($candidates);
                })
                ->addColumn('country', function ($row) {
        return $row->passportDetail?->country?->name ?? 'N/A';
    })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.candidate_form.list')->with($data);
    }

    private function generateActionButtons($candidates)
    {
        $html = "";
        if (auth()->user()->can('candidate-form.edit')) {
            $html .= '<a href="' . route('candidate_form.edit', encrypt($candidates->id)) . '" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('candidate-form.download')) {
            $html .= '<a href="' . route('candidate_form.show', encrypt($candidates->id)) . '" title="Download" class="ml-1"><i class="fa fa-file-pdf text-danger" aria-hidden="true"></i></a>   ';
        }

        if (auth()->user()->can('candidate-form.status')) {
            $status = $candidates->status;
            $id = encrypt($candidates->id);
            $url = route('candidate_form.status');
            $title = $status === 'filled' ? 'Make Completed' : 'Make Filled';
            $icon = $status === 'filled' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'candidate-form-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status class="ml-1""
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }

        if (auth()->user()->can('candidate-form.delete')) {
            $id = encrypt($candidates->id);
            $url = route('candidate_form.destroy', $id);
            $tableid = 'candidate-form-table';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record class="ml-1"" 
            data-id="' . $id . '" 
            data-url="' . $url . '" 
            data-tableid="' . $tableid . '" 
            data-title="Candidate" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        return $html;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Candidate Form';
        $countries = AllCountry::select('id', 'name')->get();
        return view('admin.candidate_form.add', compact('title', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $isUpdate = $request->id ? true : false;

        $validated = $request->validate([
            'emigrate_fe_id' => 'nullable|alpha_num|max:25',
            'user_passport_id' => 'required|numeric',
            'visa_no' => 'required|min:8|max:50|regex:/^[A-Za-z0-9\/]+$/',
            'en_visa_no' => 'nullable|digits_between:8,40',
            'visa_issue_date' => 'required|date|date_format:d-m-Y|before_or_equal:today',
            'visa_expiry_date' => 'required|date|date_format:d-m-Y|after:visa_issue_date|after_or_equal:today',
            'visa_issue_place' => 'required|min:3|max:20|regex:/^[a-zA-Z\s]+$/',
            'job_on_visa' => 'required|min:3|max:40|regex:/^[a-zA-Z\s]+$/',
            'passport_no' => $isUpdate ? 'required|min:5|max:10|alpha_num|unique:candidates,passport_no,' . $request->id . ',id,deleted_at,NULL' : 'required|min:5|max:12|alpha_num|unique:candidates,passport_no,NULL,id,deleted_at,NULL',
            'last_name_eng' => 'nullable|min:3|max:25|regex:/^[a-zA-Z\s]+$/',
            'first_name_eng' => 'required|min:3|max:35|regex:/^[a-zA-Z\s]+$/',
            'name_hindi' => 'required|min:3|max:50|regex:/^[\p{Devanagari}\s]+$/u',
            'birth_place' => 'required|min:3|max:20|regex:/^[a-zA-Z\s]+$/',
            'passport_issue_place' => 'required|min:3|max:20|regex:/^[a-zA-Z\s]+$/',
            'dob' => 'required|date|date_format:d-m-Y|before:today',
            'passport_issue_date' => 'required|date|date_format:d-m-Y|before_or_equal:today',
            'passport_expiry_date' => 'required|date|after:passport_issue_date|date_format:d-m-Y|after:today',
            'father_name' => 'required|min:3|max:35|regex:/^[a-zA-Z\s]+$/',
            'nominee_relation' => 'required',
            'nominee_name' => 'required|min:3|max:35|regex:/^[a-zA-Z\s]+$/',
            'passport_address' => 'required|min:10|max:120',
            'passport_pin_code' => 'required|digits:6|not_in:000000',
            'current_city' => 'required|min:3|max:20|regex:/^[a-zA-Z\s]+$/',
            'passport_issue_state' => 'required|min:3|max:20|regex:/^[a-zA-Z\s]+$/',
            'candidate_mobile_no' => 'required|digits:10|not_in:0000000000,9999999999',
            'alternate_no' => 'nullable|digits:10|not_in:0000000000,9999999999',
            // 'pobox' => 'required|digits_between:3,6',
            // 'pin_code' => 'required|digits_between:3,6',
        ],
        [
            'visa_no.regex' => 'only letters, numbers, and slashes(/) are allowed.',
            'name_hindi.regex' => 'केवल हिंदी अक्षर और स्पेस लिखें',
        ]);
        try {

            $validated['user_id'] = Auth::user()->id;
            $validated['status'] = 'completed';
            $data = Candidate::updateOrCreate(['id' => $request->id], $validated);

            return response()->json([
                'success' => true,
                'message' => 'Record saved successfully!',
                'data' => $data
            ]);

        } catch (Exception $e) {
            Log::error('Error ' . $e->getMessage() . ' on the Line No. ' . $e->getLine());
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_if(!auth()->user()->can('candidate-form.view'), 403, __('User does not have the right permissions.'));

        try {
            $id = decrypt($id);
            $candidate = Candidate::findOrFail($id);
            $title = 'Candidate Detail';
            return view('admin.candidate_form.view', compact('candidate', 'title'));
        } catch (Exception $e) {

            Log::error('Candidate detail retrieval failed: ' . $e->getMessage());
            return back()->with('error', __('Failed to retrieve candidate detail. Please try again.'));
        }
    }

    public function uploadedDocument(string $id)
    {
        try {
            $id = decrypt($id);
            $candidate = Candidate::findOrFail($id);
            $title = 'Attachment Detail';
            return view('admin.candidate_form.uploaded_document', compact('candidate', 'title'));
        } catch (Exception $e) {

            Log::error('Attachment retrieval failed: ' . $e->getMessage());
            return back()->with('error', __('Failed to retrieve attachment detail. Please try again.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $id = decrypt($id);
        $title = 'Candidate Form';
        $candidates = Candidate::findOrFail($id);
        return view('admin.candidate_form.add', compact('title', 'candidates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $id = decrypt($id);
            abort_if(!auth()->user()->can('candidate-form.delete'), 403, __('This section does not have the right permissions.'));
            Candidate::destroy($id);
            return response()->json([
                'status' => true,
                'message' => 'Candidate record deleted successfully.',

            ]);
        } catch (Exception $e) {
            Log::error('User passport deletion failed: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('Failed to delete candidate detail. Please try again.')
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {
        if (!auth()->user()->can('candidate-form.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {
            $id = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'filled' ? 'completed' : 'filled';
            $candidate = Candidate::findOrFail($id);
            $candidate->status = $newStatus;
            $candidate->save();

            return response()->json([
                'message' => 'Candidate status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'filled' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'filled' ? 'Make completed' : 'Make Filled',
                'class' => $newStatus === 'filled' ? 'text-danger' : 'text-success',
            ]);
        } catch (Exception $e) {

            Log::error('Candidate status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update candidate status. Please try again.')
            ], 500);
        }
    }
}
