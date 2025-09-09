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
                    @can('candidate-form.create')
                    <a href="{{ route('candidate_form.create') }}" type="button" class="btn btn-info"
                        style="float: right;margin-right:3px;"><i class="fa fa-plus fa-xs"></i> Add</a>
                    @endcan

                </div>
                <div class="card-body">
                    <table id="candidate-form-table" class="table table-bordered table-striped">
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
        $("#candidate-form-table").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: url + "/candidate_form",
            order: [[0, 'desc']],
            columns: [
                { data: 'DT_RowIndex', name: 'candidates.id', title: '#', orderable: true, searchable: false },
                { data: 'passport_no', name: 'passport_no', title: 'Passport', orderable: true, searchable: true },
                { data: 'visa_no', name: 'visa_no', title: 'Visa' },
                { data: 'job_on_visa', name: 'job_on_visa', title: 'Job' },
                { data: 'visa_expiry_date', name: 'visa_expiry_date', title: 'Visa Expiry' },
                { data: 'full_name', name: 'full_name', title: 'Full name' },
                { data: 'father_name', name: 'father_name', title: 'Father name' },
                { data: 'country', name: 'passportDetail.country.name', title: 'Country', orderable: false, searchable: true },
                { data: 'user.name', name: 'user.name', title: 'Filled by', orderable: true, searchable: true },
                { data: 'status', name: 'status', title: 'Form Status' },
                { data: 'created_at', name: 'created_at', title: 'Date' },
                { data: 'action', name: 'action', title: 'Action', orderable: false, searchable: false }
            ]
        }); 
    });
</script>
@endsection