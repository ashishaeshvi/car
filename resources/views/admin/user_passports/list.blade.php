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
                    @can('user-passport.create')
                    <a href="{{ route('user-passports.create') }}" type="button" class="btn btn-info"
                        style="float: right;margin-right:3px;"><i class="fa fa-plus fa-xs"></i> Add</a>
                    @endcan

                </div>
                <div class="card-body">
                    <table id="user-passports-table" class="table table-bordered table-striped">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        var url = $("#_url").val();
        $("#user-passports-table").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            searchable: true,
            ajax: url + "/user-passports",
            order: [[0, 'desc']],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'user_passports.id',
                    title: '#',
                    orderable: true,
                    searchable: false
                },
                {
                    data: 'passport_no',
                    name: 'passport_no',
                    title: 'Passport No',
                    orderable: false
                },
                
                {
                    data: 'agency_name',
                    name: 'raDocument.agency_name',
                    title: 'Agency Name'
                },

                {
                    data: 'fe_name',
                    name: 'fe_name',
                    title: 'FE Name'
                },
                {
                    data: 'fe_no',
                    name: 'fe_no',
                    title: 'FE No'
                },
               
                {
                    data: 'sponsor_name',
                    name: 'sponsor_name',
                    title: 'Sponsor Name'
                },
                {
                    data: 'sponsor_id',
                    name: 'sponsor_id',
                    title: 'Sponsor Id'
                },

                // {
                //     data: 'fe_age',
                //     name: 'fe_age',
                //     title: 'FE Age'
                // },
                {
                    data: 'job',
                    name: 'job',
                    title: 'Job'
                },
                {
                    data: 'vacancy',
                    name: 'vacancy',
                    title: 'Vacancy'
                },
                // {
                //     data: 'salary',
                //     name: 'salary',
                //     title: 'Salary',
                //     searchable: false,
                //     sortable: false
                // },
                {
                    data: 'country_name',
                    name: 'country.name',
                    title: 'Country'
                },
                {
                    data: 'individual_or_company',
                    name: 'individual_or_company',
                    title: 'Type'
                },
                {
                    data: 'user.name',
                    name: 'user.name',
                    title: 'Added By',
                    orderable: true,
                },
                {
                    data: 'status',
                    name: 'status',
                    title: 'Status'
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                    title: 'Date'
                },
                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>
@endsection