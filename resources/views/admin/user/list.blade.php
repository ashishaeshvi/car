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
                            class="fa fa-arrow-left fa-xs"></i> </a>
                    @can('user.create')
                    <button type="button" class="btn btn-info" style="margin-right:3px;float: right;"
                        data-toggle="modal" data-target="#addUserModal">
                        <i class="fa fa-plus fa-xs"></i> Add
                    </button>
                    @endcan
                </div>
                <div class="card-body">
                    <table id="user-table" class="table table-bordered table-striped">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@include('admin.user.modals.add')
@include('admin.user.modals.edit')
@endsection
@section('scripts')
<script src="{{ asset('admin-assets/scripts/users.js') }}"></script>
<script>
    $(document).ready(function() {
        var url = $("#_url").val();
        $("#user-table").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
           // stateSave: true,
            ajax: url + "/user",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: '#',
                    orderable: false,
                    searchable: false,

                },
                {
                    data: 'name',
                   name: 'name',
                    title: 'Name'
                },
                {
                    data: 'profile_image',
                    name: 'profile_image',
                    title: 'Photo',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email'
                },
                {
                    data: 'mobile',
                    name: 'mobile',
                    title: 'Mobile'
                },
                {
                    data: 'role.name',
                    name: 'role.name',
                    title: 'Role'
                },
               {
  data: 'created_by_name',
  name: 'creator.name', // must match DB alias for searching/sorting
  title: 'Created By'
},
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Created Date'
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    title: 'Action'
                },
            ]
        });
    });
</script>
@endsection