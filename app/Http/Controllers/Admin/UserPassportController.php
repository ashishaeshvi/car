<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\AllCountry;
use App\Models\Candidate;
use App\Models\FeDocument;
use App\Models\RaDocument;
use App\Models\UserPassport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use DataTables;
use DB;

class UserPassportController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('user-passport.view'), 403, __('User does not have the right permissions.'));

        $data['title'] = 'Document Upload List';
        $data['create_title'] = 'Document Upload';
        $authId = auth()->id();

        $query = UserPassport::with(['user', 'raDocument', 'country'])
            ->when(auth()->user()->role_id != 1, function ($q) use ($authId) {
                $q->where('user_passports.user_id', $authId);
            });

        if ($request->ajax()) {
            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->filter(function ($query) use ($request) {
                    if ($request->has('search') && $search = $request->input('search.value')) {
                        $search = strtolower($search);
                        $query->where(function ($q) use ($search) {
                            $q->whereRaw('LOWER(passport_no) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(sponsor_name) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(sponsor_id) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(individual_or_company) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(fe_name) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(fe_no) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(fe_age) LIKE ?', ["%$search%"])
                                ->orWhereRaw('LOWER(user_passports.status) LIKE ?', ["%$search%"])
                                ->orWhereRaw('CAST(salary AS CHAR) LIKE ?', ["%$search%"])
                                ->orWhereHas('country', function ($q2) use ($search) {
                                    $q2->whereRaw('LOWER(name) LIKE ?', ["%$search%"]);
                                })
                                ->orWhereHas('raDocument', function ($q2) use ($search) {
                                    $q2->whereRaw('LOWER(agency_name) LIKE ?', ["%$search%"]);
                                });
                                // ->orWhereHas('user', function ($q2) use ($search) {
                                //     $q2->whereRaw('LOWER(name) LIKE ?', ["%$search%"]);
                                // });
                        });
                    }
                })
                ->addColumn('country_name', function ($row) {
                    return $row->country->name ?? '-';
                })

                ->addColumn('user_name', function ($row) {
                    return $row->user->name ?? '-';
                })
                ->addColumn('agency_name', function ($row) {
                    return $row->raDocument->agency_name ?? '-';
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d M, Y'))
                ->addColumn('action', function ($row) {
                    return $this->generateActionButtons($row);
                })
                ->rawColumns(['action'])
                ->toJson(); 
        }
        

        return view('admin.user_passports.list')->with($data);
    }

    private function generateActionButtons($passport)
    {
        $html = "";
        if (auth()->user()->can('user-passport.edit')) {
            $html .= '<a href="' . route('user-passports.edit', encrypt($passport->id)) . '" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('user-passport.status')) {
            $status = $passport->status;
            $id = encrypt($passport->id);
            $url = route('user-passports.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'user-passports-table';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }

        if (auth()->user()->can('user-passport.delete')) {
            $id = encrypt($passport->id);
            $url = route('user-passports.destroy', $id);
            $tableid = 'user-passports-table';

            $html .= '  <button type="button" class="btn btn-danger btn-xs delete-record" 
            data-id="' . $id . '" 
            data-url="' . $url . '" 
            data-tableid="' . $tableid . '" 
            data-title="document" 
            title="Delete">
            <i class="fa fa-trash"></i>
          </button>';
        }

        return $html;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('user-passport.create'), 403, __('User does not have the right permissions.'));

        $data['title'] = 'User Passport';
        $data['create_title'] = 'User Passport';
        $data['countries'] = AllCountry::get();
        $data['reSignStamps'] = RaDocument::where('status', 'active')->get();
        $data['feSigns'] = FeDocument::where('status', 'active')->where('type', 'sign')->get();
        $data['feStamps'] = FeDocument::where('status', 'active')->where('type', 'stamp')->get();
        return view('admin.user_passports.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function storeOrUpdate(Request $request, $id = null)
    {

        $isUpdate = $request->passportEditId;
        $rules = [
            'passport_no' => [
                'required',
                'alpha_num',
                'min:5',
                'max:10',
                Rule::unique('user_passports', 'passport_no')
                    ->ignore($isUpdate)
                    ->whereNull('deleted_at'),
            ],
            'candidate_sign' => $isUpdate ? 'nullable|image|mimes:jpeg,png,jpg|max:5120' : 'required|image|mimes:jpeg,png,jpg|max:5120', // max 20 MB = 5120 KB
            'passport' => $isUpdate ? 'nullable|mimes:pdf|max:5120' : 'required|mimes:pdf|max:5120',
            'visa' => $isUpdate ? 'nullable|mimes:pdf|max:5120' : 'required|mimes:pdf|max:5120',
            'ra_document_id' => 'required|integer',
            'sponsor_name' => 'nullable|string|max:255',
            'sponsor_id' => 'nullable|string|max:255',
            'fe_name' => 'required|string|max:255',
            'fe_no' => 'required|digits_between:4,20',
            'fe_age' => 'required|digits_between:1,2',
            'pobox' => 'required|digits_between:3,6',
            'pin_code' => 'required|digits_between:3,6',
            'job' => 'required|string|max:255',
            'vacancy' => 'required|integer|max:10',
            'salary' => 'required|numeric|min:0',
            'country' => 'required|integer|max:255',
            'ref_no' => 'nullable|min:2|max:50',
            'individual_or_company' => 'required|in:individual,company',
            'fe_sign_id' => 'nullable|integer',
            'fe_stamp_id' => [
                'nullable',
                'integer',
                Rule::requiredIf(function () use ($request) {
                    return $request->individual_or_company === 'company';
                }),
            ],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Return JSON response for AJAX
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }


        // If ID exists -> update, else create new
        $passport = $isUpdate ? UserPassport::findOrFail($isUpdate) : new UserPassport();

        $passport->passport_no = $request->passport_no;
        $passport->ra_document_id = $request->ra_document_id;
        $passport->sponsor_name = $request->sponsor_name;
        $passport->sponsor_id = $request->sponsor_id;
        $passport->fe_name = $request->fe_name;
        $passport->fe_no = $request->fe_no;
        $passport->fe_age = $request->fe_age;
        $passport->pobox = $request->pobox;
        $passport->pin_code = $request->pin_code;
        $passport->job = $request->job;
        $passport->vacancy = $request->vacancy;
        $passport->salary = $request->salary;
        $passport->all_country_id = $request->country;
        $passport->individual_or_company = $request->individual_or_company;
        $passport->fe_sign_id = $request->fe_sign_id;
        $passport->fe_phone_no = '5545' . substr($request->fe_no, -4);
        $passport->ref_no = $request->ref_no;

        if (empty($isUpdate)) {
            $passport->user_id = $userId = auth()->id();
        }


        $passport->fe_stamp_id = $request->individual_or_company === 'company' ? $request->fe_stamp_id : null;

        if ($request->hasFile('passport')) {
            if ($isUpdate && $passport->passport) {
                deleteFiles($passport->passport);
            }
            $passport->passport = uploadFiles($request, 'passport', 'passport');
        }

        if ($request->hasFile('visa')) {
            if ($isUpdate && $passport->visa) {
                deleteFiles($passport->visa);
            }
            $passport->visa = uploadFiles($request, 'visa', 'visa');
        }

        if ($request->hasFile('candidate_sign')) {
            if ($isUpdate && $passport->candidate_sign) {
                deleteFiles($passport->candidate_sign);
            }
            $passport->candidate_sign = uploadFiles($request, 'candidate_sign', 'candidate_sign');
        }


        if ($passport->save()) {
            $message = $isUpdate ? 'User passport updated successfully' : 'User passport added successfully';
            $type = $isUpdate ? 'edit' : 'add';
            $isUpdate && Candidate::where('user_passport_id', $passport->id)->update(['passport_no' => $passport->passport_no]);

            return response()->json([
                'success' => true,
                'type' => $type,
                'message' => $message,
                'data' => $passport,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Failed to save user passport. Please try again.',
            ], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        abort_if(!auth()->user()->can('user-passport.edit'), 403, __('User does not have the right permissions.'));

        try {

            $data['title'] = 'Edit User Passport';
            $data['create_title'] = 'Edit User Passport';
            $data['countries'] = AllCountry::get();
            $data['reSignStamps'] = RaDocument::where('status', 'active')->get();
            $data['feSigns'] = FeDocument::where('status', 'active')->where('type', 'sign')->get();
            $data['feStamps'] = FeDocument::where('status', 'active')->where('type', 'stamp')->get();
            $categoryId = decrypt($id);
            $data['userPassport'] = UserPassport::findOrFail($categoryId);
            return view('admin.user_passports.add', $data);
        } catch (\Exception $e) {
            Log::error('Document edit failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'method'  => __METHOD__,
            ]);
            return redirect()->route('user-passports.index')->with('error', __('Failed to retrieve field for editing. Please try again.'));
        }
    }



    public function checkPassport(Request $request)
    {
        $query = DB::table('user_passports')
            ->where('passport_no', $request->passport_no);

      
        if ($request->filled('passport_edit_id')) {
            $query->where('id', '!=', $request->passport_edit_id);
        }

        $exists = $query->exists();

        return response()->json(['exists' => $exists]);
    }


    public function checkFeDetails(Request $request)
    {
        $fe_name = $request->fe_name;
        $country_id = $request->country_id;
        $excludeId = $request->exclude_id; // This will be null during add

        // Step 1: Get the latest record to determine latest fe_no
        $latest = UserPassport::where('all_country_id', $country_id)
            ->where('fe_name', $fe_name)
            ->when($excludeId, function ($query, $excludeId) {
                $query->where('id', '!=', $excludeId);
            })
            ->latest()
            ->first();

        if (!$latest) {
            return response()->json([
                'exists' => false,
                'fe_no' => null,
                'latest_records' => [],
            ]);
        }

        $latestFeNo = $latest->fe_no;

        // Step 2: Get all records for this fe_no, optionally excluding current record
        $records = UserPassport::select('fe_age', 'sponsor_name', 'sponsor_id', 'fe_sign_id', 'fe_stamp_id', 'individual_or_company','vacancy','pobox','pin_code')          
            ->where('all_country_id', $country_id)
            ->where('fe_name', $fe_name)
            ->where('fe_no', $latestFeNo)
            ->when($excludeId, function ($query, $excludeId) {
                $query->where('id', '!=', $excludeId);
            })
            ->orderByDesc('id')
            ->get();

        $count = $records->count();

        return response()->json([
            'exists' => true,
            'fe_no' => $count < 10 ? $latestFeNo : null,
            'latest_records' => $records,
        ]);
    }



    public function changeStatus(Request $request)
    {

        if (!auth()->user()->can('user-passport.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {

            $docId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $Radocument = UserPassport::findOrFail($docId);
            $Radocument->status = $newStatus;
            $Radocument->save();

            return response()->json([
                'message' => 'User passport status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('User passport status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update user passport status. Please try again.')
            ], 500);
        }
    }

    public function destroy($id)
    {

        if (!auth()->user()->can('user-passport.delete')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {

            DB::beginTransaction();
            $UserPassport = UserPassport::findOrFail(decrypt($id));
            $delete = $UserPassport->delete();

            if ($delete) {
                deleteFiles($UserPassport->passport);
                deleteFiles($UserPassport->visa);
                deleteFiles($UserPassport->candidate_sign);
            }

            DB::commit();

            return response()->json([
                'message' => 'User passport deleted successfully.',

            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('User passport deletion failed: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => __('Failed to delete user passport. Please try again.')
            ], 500);
        }
    }

    public function getPassportInfo(Request $request)
    {
        try {
            $rules = [
                'passport' => ['required', 'string', 'alpha_num', 'min:5', 'max:10',],
                'user_passport_id' => 'nullable|numeric|exists:user_passports,id',
            ];

            // Conditionally add rules only if user_passport_id is not present
            if (!$request->filled('user_passport_id')) {
                $rules['passport'][] = Rule::exists('user_passports', 'passport_no')->where('status', 'active')->whereNull('deleted_at');
                $rules['passport'][] = Rule::unique('candidates', 'passport_no')->whereNull('deleted_at');
            }

            $validated = $request->validate($rules);
            $passport = UserPassport::select('id', 'passport_no', 'fe_name', 'passport', 'visa', 'all_country_id')->with('country')->where('passport_no', $validated['passport'])->firstOrFail();
            return response()->json([
                'success' => true,
                'message' => 'Passport Data fetched successfully!',
                'data' => $passport,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
             Log::error('Failed to get passport data', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'method'  => __METHOD__,
            ]);
            return response()->json([
                'success' => false,
                'message' => __('Failed to get passport data. Something went wrong!')
            ], 500);
        }
    }
}
