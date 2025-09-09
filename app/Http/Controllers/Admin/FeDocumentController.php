<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\FeDocument;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class FeDocumentController extends Controller
{

    public function index(Request $request)
    {
        abort_if(!auth()->user()->can('fe-document.view'), 403, __('User document does not have the right permissions.'));

        $type = $request->get('type');

        if ($type == 'sign') {

            $data['title'] = 'Fe Sign List';
            $data['create_title'] = 'Fe Sign';
            $data['type'] =  $type;
        } elseif ($type == 'stamp') {
            $data['title'] = 'Fe Stamp List';
            $data['create_title'] = 'Fe Stamp';
            $data['type'] =  $type;
        } else {
            $data['title'] = 'Fe Document List';
            $data['type'] =  '';
            $data['create_title'] = 'Fe Document';
        }
        $authId = auth()->id();
        $FeDocuments = FeDocument::with('user')
            ->when(auth()->user()->role_id != 1, function ($query) use ($authId) {
                return $query->where('fe_documents.user_id', $authId);
            })
            ->where('fe_documents.type', $type)
            ->whereNull('fe_documents.deleted_at');

        if ($request->ajax()) {
            return DataTables::of($FeDocuments)
                ->addIndexColumn()

                ->editColumn('action', function ($document) {
                    return $this->generateActionButtons($document);
                })
                ->editColumn('status', function ($document) {
                    return ucfirst($document->status === 'active' ? 'active' : 'inactive'); // Assuming 1 for active, 0 for inactive
                })
                ->editColumn('created_at', fn($row) => $row->created_at->format('d F, Y'))
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.fe-document.list')->with($data);
    }

    private function generateActionButtons($document)
    {
        $html = "";
        if (auth()->user()->can('fe-document.edit')) {
            $html .= '<a href="javascript:void(0)"  class="edit-fe-document"  data-toggle="modal" data-target="#FeDocumentModal"  data-id="' . encrypt($document->id) . '" title="Edit Detail"><i class="fa fa-edit"></i></a>   ';
        }

        if (auth()->user()->can('fe-document.view')) {
            $html .= '<a href="javascript:void(0)"  class="view-fe-document"   data-toggle="modal" data-target="#viewFeDocumentModal"  data-id="' . encrypt($document->id) . '" title="View"><i class="fa fa-eye"></i></a>   ';
        }

        if (auth()->user()->can('fe-document.status')) {
            $status = $document->status;
            $id = encrypt($document->id);
            $url = route('fe-document.status');
            $title = $status === 'active' ? 'Make Inactive' : 'Make Active';
            $icon = $status === 'active' ? 'fa-toggle-off text-danger' : 'fa-toggle-on text-success';
            $tableid = 'fe-document';
            $html .= '<a href="javascript:void(0);" class="toggle-status"
                data-id="' . $id . '"
                data-status="' . $status . '"
                data-tableid="' . $tableid . '"
                data-url="' . $url . '"
                title="' . $title . '">
                <i class="fa fa-fw ' . $icon . '"></i> 
                </a>';
        }
        if (auth()->user()->can('fe-document.delete')) {
            $id = encrypt($document->id);
            $url = route('fe-document.destroy', $id);
            $tableid = 'fe-document';

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
     * Store or update an Fe Document.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function store(Request $request)
    {
        // Determine if it's an update or create action
        $isUpdate = $request->filled('id');
        $type = $request->type;


        $rules = [
            'name' => $isUpdate
                ? [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('fe_documents', 'name')
                        ->ignore($request->id)
                        ->where(function ($query) use ($type) {
                            return $query->where('type', $type)->whereNull('deleted_at');
                        })
                ]
                : [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('fe_documents', 'name')
                        ->where(function ($query) use ($type) {
                            return $query->where('type', $type)->whereNull('deleted_at');
                        })
                ],

            'type' => 'required|string|max:255',
        ];
        // Authorization check based on action type
        if ($isUpdate) {

            if (!auth()->user()->can('fe-document.edit')) {
                return response()->json([
                    'success' => false,
                    'message' => __('User does not have the right permissions.')
                ], 403);
            }

            if ($type == 'stamp') {
                $rules['fe_stamp'] = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            } elseif ($type == 'sign') {
                $rules['fe_sign']  = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            }
        } else {

            if (!auth()->user()->can('fe-document.create')) {
                return response()->json([
                    'success' => false,
                    'message' => __('User does not have permission to create Fe documents.')
                ], 403);
            }

            if ($type == 'stamp') {
                $rules['fe_stamp'] = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            } elseif ($type == 'sign') {
                $rules['fe_sign']  = 'nullable|file|mimes:jpg,jpeg,png|max:5120';
            }
        }

        $messages = [
            'fe_stamp.max' => 'The FE stamp must not be greater than 5 MB.',
            'fe_sign.max' => 'The FE sign must not be greater than 5 MB.',
        ];
        // Validation rules
        $validated = $request->validate($rules, $messages);
        try {
            $userId = auth()->id();

            $dataToSave = [
                'name'  => $validated['name'],
                'type'  => $validated['type'],
            ];


            if ($request->hasFile('fe_sign')) {
                $uploadedFileName = uploadFiles($request, 'fe_sign', 'fe_docs');
                $dataToSave['attachment']  = $uploadedFileName; // get the filename without the path
            }

            if ($request->hasFile('fe_stamp')) {
                $uploadedFileName = uploadFiles($request, 'fe_stamp', 'fe_docs');
                $dataToSave['attachment']  = $uploadedFileName; // get the filename without the path
            }


            if ($isUpdate) {
                $FeDocument = FeDocument::findOrFail($request->id);


                // Delete old files if new ones uploaded
                if ($request->hasFile('fe_sign') && $FeDocument->fe_sign) {
                    deleteFiles($FeDocument->fe_sign);
                }

                if ($request->hasFile('fe_stamp') && $FeDocument->fe_stamp) {
                    deleteFiles($FeDocument->fe_stamp);
                }
                $FeDocument->update($dataToSave);
                $message = __('Fe document updated successfully.');
                $type = 'edit';
            } else {
                $dataToSave['user_id'] = $userId;
                $FeDocument = FeDocument::create($dataToSave);
                $message = __('Fe document created successfully.');
                $type = 'add';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'type' => $type,
                'data'    => $FeDocument,
            ]);
        } catch (\Exception $e) {
            Log::error('Fe document save failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => __('Failed to save Fe document. Please try again.'),
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
        if (!auth()->user()->can('fe-document.edit')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }

        try {
            $feId = decrypt($id);
            $feDocument = FeDocument::findOrFail($feId);

            return response()->json([
                'status' => true,
                'doc' => $feDocument,
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
                'message' => __('Failed to retrieve fe-document. Please try again.')
            ], 500);
        }
    }

    public function changeStatus(Request $request)
    {

        if (!auth()->user()->can('fe-document.status')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }



        try {

            $docId = decrypt($request->input('id'));
            $newStatus = $request->input('status') === 'active' ? 'inactive' : 'active';
            $FeDocument = FeDocument::findOrFail($docId);
            $FeDocument->status = $newStatus;
            $FeDocument->save();

            return response()->json([
                'message' => 'Fe document status updated successfully.',
                'newStatus' => $newStatus,
                'icon' => $newStatus === 'active' ? 'fa-toggle-off' : 'fa-toggle-on',
                'title' => $newStatus === 'active' ? 'Make Inactive' : 'Make Active',
                'class' => $newStatus === 'active' ? 'text-danger' : 'text-success',
            ]);
        } catch (\Exception $e) {

            Log::error('Fe document status update failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to update fe document status. Please try again.')
            ], 500);
        }
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('fe-document.delete')) {
            return response()->json([
                'success' => false,
                'message' => __('User does not have the right permissions.')
            ], 403);
        }
        try {

            $FeDocument = FeDocument::findOrFail(decrypt($id));

            if ($FeDocument->fe_stamp) {
                deleteFiles($FeDocument->attachment);
            }

            $FeDocument->delete();

            return response()->json([
                'message' => 'Fe document deleted successfully.',

            ]);
        } catch (\Exception $e) {

            Log::error('Fe document deletion failed: ' . $e->getMessage());

            return response()->json([
                'status' => false,
                'message' => __('Failed to delete fe document. Please try again.')
            ], 500);
        }
    }
}
