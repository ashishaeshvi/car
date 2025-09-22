@extends('admin.layouts.master')
@section('title', __('Admin | ' . $title))

@section('maincontent')
<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $title }}</h3>
                    <a href="{{ route('home') }}" class="btn btn-danger float-right ml-2">
                        <i class="fa fa-arrow-left fa-xs"></i>
                    </a>
                    @can('dealer.create')
                        <a href="{{ route('dealers.create') }}" class="btn btn-info float-right ml-2">
                            <i class="fa fa-plus fa-xs"></i> Add Dealer
                        </a>
                    @endcan
                </div>

                <div class="card-body">
                    <table id="dealers-table" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <!-- <th>#</th>
                                <th>Dealer Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Company</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th> -->
                            </tr>
                        </thead>
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
    $(document).ready(function () {
        var url = $("#_url").val();
        $("#dealers-table").DataTable({
            responsive: true,
            autoWidth: false,
            processing: true,
            serverSide: true,
            stateSave: true,
            searchable: true,
            ajax: url + "/dealers",
            order: [[0, 'desc']],
            columns: [
                { data: 'DT_RowIndex', name: 'id', title: '#', orderable: true, searchable: false },
                { data: 'name', name: 'name', title: 'Dealer Name' },
                { data: 'email', name: 'email', title: 'Email' },
                { data: 'mobile', name: 'mobile', title: 'Mobile' },               
                { data: 'address', name: 'address', title: 'Address' },
                { data: 'city_name', name: 'city.name', title: 'City' },
                { data: 'status', name: 'status', title: 'Status' },
                { data: 'created_at', name: 'created_at', title: 'Created At' },
                { data: 'action', name: 'action', title: 'Action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endsection
