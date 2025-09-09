<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\RaDocument;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class RaDocumentController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('ra-document.view'), 403, __('RA document does not have the right permissions.'));

        $data['title'] = 'RA Document List';
        $data['create_title'] = 'RA Document';
        $authId = auth()->id();

        $Radocuments = RaDocument::with('user')
            ->when(auth()->user()->role_id != 1, function ($query) use ($authId) {
                return $query->where('ra_documents.user_id', $authId);
            })
            ->whereNull('ra_documents.deleted_at');

        if ($request->ajax()) {

            return DataTables::of($Radocuments)
                ->addIndexColumn()
                ->editColumn('action', function ($document) {
                    return $this->generateActionButtons($document);
                })
                ->editColumn('status', function ($document) {
                    return ucfirst($document->status === 'active' ? 'active' : 'inactive'); // Assuming 1 for active, 0 for inactive
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }

        return view('admin.ra-document.list')->with($data);
    }

    private function generateActionButtons($document)
    {
        $html = "";
        if (auth()->user()->can('ra-document.edit')) {
            $html .= '<a href="javascript:void(0)"  class="edit-ra-document"  data-toggle="modal" data-target="#addRADocumentModal"  data-id="' . encrypt($document->id) . '" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }


        if (auth()->user()->can('ra-document.view')) {
            $html .= '<a href="' . route('ra-document.show', encrypt($document->id)) . '" title="View"><i class="fa fa-eye"></i></a>   ';
        }


        if (auth()->user()->can('ra-document.status')) {
            $status = $document->status;
            $id = encrypt($document->id);
            $url = route('ra-document.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'ra-document';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }

        if (auth()->user()->can('ra-document.delete')) {
            $id = encrypt($document->id);
            $url = route('ra-document.destroy', $id);
            $tableid = 'ra-document';

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
     * Store or update an RA Document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function store(Request $request)
    {

        $isUpdate = $request->filled('id');

        $rules = [
            'ra_name' => $isUpdate
                ? 'required|string|min:2|max:60|unique:ra_documents,ra_name,' . $request->id . ',id,deleted_at,NULL'
                : 'required|string|max:60|unique:ra_documents,ra_name,NULL,id,deleted_at,NULL',
            'ra_name_hindi' => 'required|string|min:3|max:100',
            'registration_no' => 'required|string|min:10|max:60',
            'agency_name' => 'required|string|min:8|max:200',
            'address' => 'required|max:300',
        ];

        if ($isUpdate) {
            if (!auth()->user()->can('ra-document.edit')) {
                return response()->json([
                    'success' => false,
                    'message' => __('User does not have permission to update RA documents.')
                ], 403);
            }

            $rules['ra_stamp'] = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            $rules['ra_sign']  = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            $rules['scan_notary.*']  = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            $rules['affidavit_notary.*'] = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            $rules['letterpad_logo']  = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            $rules['letterpad_footer']  = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
        } else {
            if (!auth()->user()->can('ra-document.create')) {
                return response()->json([
                    'success' => false,
                    'message' => __('User does not have permission to create RA documents.')
                ], 403);
            }

            $rules['ra_stamp'] = 'required|file|mimes:jpg,jpeg,png|max:5120';
            $rules['ra_sign']  = 'required|file|mimes:jpg,jpeg,png|max:5120';
            $rules['scan_notary.*']  = 'required|file|mimes:jpg,jpeg,png|max:5120';
            $rules['affidavit_notary.*'] = 'required|file|mimes:jpg,jpeg,png|max:5120';
            $rules['letterpad_logo']  = 'required|file|mimes:jpg,jpeg,png|max:5120';
            $rules['letterpad_footer']  = 'required|file|mimes:jpg,jpeg,png|max:5120';
        }

        $messages = [
            'ra_stamp.required' => 'RA stamp is required.',
            'ra_sign.required' => 'RA sign is required.',
            'scan_notary.*.required' => 'Scan notary is required.',
            'affidavit_notary.*.required' => 'Affidavit notary is required.',
            'letterpad_logo.required' => 'Letterpad logo is required.',
            'letterpad_footer.required' => 'Letterpad footer is required.',
            'ra_stamp.max' => 'RA stamp must not be greater than 5 MB.',
            'ra_sign.max' => 'RA sign must not be greater than 5 MB.',
            'scan_notary.*.max' => 'Scan notary file must not be greater than 5 MB.',
            'affidavit_notary.*.max' => 'Affidavit notary file must not be greater than 5 MB.',
            'letterpad_logo.max' => 'Letterpad logo must not be greater than 5 MB.',
            'letterpad_footer.max' => 'Letterpad footer must not be greater than 5 MB.',
            'scan_notary.*.mimes' => 'Scan notary must be a JPG or PNG image.',
            'affidavit_notary.*.mimes' => 'Affidavit notary must be a JPG or PNG image.',
        ];

        $validated = $request->validate($rules, $messages);

        try {
            $userId = auth()->id();

            $dataToSave = [
                'ra_name' => $validated['ra_name'],
                'agency_name' => $validated['agency_name'],
                'ra_name_hindi' => $validated['ra_name_hindi'],
                'registration_no' => $validated['registration_no'],
                'address' => $validated['address'],
            ];

            if ($request->hasFile('ra_stamp')) {
                $dataToSave['ra_stamp'] = uploadFiles($request, 'ra_stamp', 'ra_docs');
            }

            if ($request->hasFile('ra_sign')) {
                $dataToSave['ra_sign'] = uploadFiles($request, 'ra_sign', 'ra_docs');
            }

            if ($request->hasFile('scan_notary')) {
                $dataToSave['scan_notary'] = uploadFiles($request, 'scan_notary', 'ra_docs');
            }

            if ($request->hasFile('affidavit_notary')) {
                $dataToSave['affidavit_notary'] = uploadFiles($request, 'affidavit_notary', 'ra_docs');
            }

            if ($request->hasFile('letterpad_logo')) {
                $dataToSave['letterpad_logo'] = uploadFiles($request, 'letterpad_logo', 'ra_docs');
            }

            if ($request->hasFile('letterpad_footer')) {
                $dataToSave['letterpad_footer'] = uploadFiles($request, 'letterpad_footer', 'ra_docs');
            }

            if ($isUpdate) {
                $raDocument = RaDocument::findOrFail($request->id);


                if ($request->hasFile('ra_stamp') && $raDocument->ra_stamp) {
                    deleteFiles($raDocument->ra_stamp);
                }

                if ($request->hasFile('ra_sign') && $raDocument->ra_sign) {
                    deleteFiles($raDocument->ra_sign);
                }

                if ($request->hasFile('affidavit_notary') && $raDocument->affidavit_notary) {
                    deleteFiles($raDocument->affidavit_notary);
                }
                if ($request->hasFile('scan_notary') && $raDocument->scan_notary) {
                    deleteFiles($raDocument->scan_notary);
                }
                if ($request->hasFile('letterpad_logo') && $raDocument->letterpad_logo) {
                    deleteFiles($raDocument->letterpad_logo);
                }
                if ($request->hasFile('letterpad_footer') && $raDocument->letterpad_footer) {
                    deleteFiles($raDocument->letterpad_footer);
                }

                $raDocument->update($dataToSave);
                $message = __('RA document updated successfully.');
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = $userId;
                $raDocument = RaDocument::create($dataToSave);
                $message = __('RA document created successfully.');
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data' => $raDocument,
            ]);
        } catch (\Exception $e) {
            Log::error('RA document save failed: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => __('Failed to save RA document. Please try again.'),
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

        if (!auth()->user()->can('ra-document.edit')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {
            $raId = decrypt($id);
            $raDocument = RaDocument::findOrFail($raId);

            return response()->json([
                'status' => true,
                'doc' => $raDocument,
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => __('User not found.')
            ], 404);
        } catch (\Exception $e) {
            \Log::error('User edit failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to retrieve ra-document. Please try again.')
            ], 500);
        }
    }



    public function show(string $id)
    {
        abort_if(!auth()->user()->can('ra-document.view'), 403, __('User does not have the right permissions.'));

        try {
            $raId = decrypt($id);
            $raDocument = RaDocument::findOrFail($raId);

            $title = 'Ra Document Detail';
            return view('admin.ra-document.view', compact('raDocument', 'title'));
        } catch (Exception $e) {

            Log::error('User profile retrieval failed: ' . $e->getMessage());
            return back()->with('error', __('Failed to retrieve candidate detail. Please try again.'));
        }
    }


    public function changeStatus(Request $request)
    {

        if (!auth()->user()->can('ra-document.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {

            $docId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $Radocument = RaDocument::findOrFail($docId);
            $Radocument->status = $newStatus;
            $Radocument->save();

            return response()->json([
                'message' => 'Ra document status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('Ra document status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update ra document status. Please try again.')
            ], 500);
        }
    }

    public function destroy($id)
    {

        if (!auth()->user()->can('ra-document.delete')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {
            DB::beginTransaction();
            $Radocument = RaDocument::findOrFail(decrypt($id));
            $delete = $Radocument->delete();
            if ($delete) {
                deleteFiles($Radocument->ra_stamp);
                deleteFiles($Radocument->ra_sign);
                deleteFiles($Radocument->affidavit_notary);
                deleteFiles($Radocument->scan_notary);
                deleteFiles($Radocument->letterpad_logo);
                deleteFiles($Radocument->letterpad_footer);
            }

            DB::commit();
            return response()->json([
                'message' => 'Ra document deleted successfully.',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Ra document deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to delete ra document. Please try again.')
            ], 500);
        }
    }
}
