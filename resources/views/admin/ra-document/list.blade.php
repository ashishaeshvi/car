@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{route('home')}}" class="btn btn-danger" style="float: right;margin-right:3px;"><i
                            class="fa fa-arrow-left fa-xs"></i></a>
                    @can('ra-document.create')
                    <button type="button" class="btn btn-info" style="margin-right:3px;float: right;" data-toggle="modal" data-target="#addRADocumentModal">
                        <i class="fa fa-plus fa-xs"></i> Add
                    </button>
                    @endcan
                </div>
                <div class="card-body">
                    <table id="ra-document" class="table table-bordered table-striped">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.ra-document.modals.add-edit')
@include('admin.ra-document.modals.view')
@endsection
@section('scripts')
<script src="{{ asset('admin-assets/scripts/ra-document.js') }}"></script>
<script>
    $(document).ready(function() {
        var url = $("#_url").val();
        $("#ra-document").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            // stateSave: true,
            ajax: url + "/ra-document",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: '#',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'ra_name',
                    name: 'ra_name',
                    title: 'RA Name',

                },
                {
                    data: 'agency_name',
                    name: 'agency_name',
                    title: 'Agency Name',
                },
                {
                    data: 'address',
                    name: 'ra_documents.address',
                    title: 'Address',
                },
                {
                    data: 'user.name',
                    name: 'user.name', // important for sorting & searching
                    title: 'Created By',
                    orderable: false,
                },

                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created Date'
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status',

                },

                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    orderable: false,
                    searchable: false,
                },
            ]
        });
    });
</script>
@endsection