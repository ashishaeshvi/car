@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))
@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                </div>
                <div class="card-body">
                    <table id="activity-log-table" class="table table-bordered table-striped">
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
        $("#activity-log-table").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: url + "/log-activity", // route for activity logs
            order:[[0,'desc']],
            columns: [
                { data: 'DT_RowIndex', name: 'id', title: '#', orderable: true, searchable: false },
                { data: 'user', name: 'user', title: 'User', orderable: false },
                { data: 'event_name', name: 'event', title: 'Event', orderable: true },
                { data: 'description', name: 'description', title: 'Description', orderable: false },
                { data: 'changes', name: 'changes', title: 'Changes', orderable: false, searchable: false },
                { data: 'created_at', name: 'created_at', title: 'Date', orderable: true }
            ]
        }); 
    });
</script>
@endsection