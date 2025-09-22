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
                    @can('cars.add')
                        <a href="{{ route('cars.create') }}" class="btn btn-info float-right ml-2">
                            <i class="fa fa-plus fa-xs"></i> Add Cars
                        </a>
                    @endcan
                </div>

                <div class="card-body">
                    <table id="cars-table" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                               
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
       $("#cars-table").DataTable({
    responsive: true,
    autoWidth: false,
    processing: true,
    serverSide: true,
    stateSave: true,
    searchable: true,
    ajax: url + "/cars",
    order: [[0, 'desc']],
    columns: [
        { data: 'DT_RowIndex', name: 'id', title: '#', orderable: true, searchable: false },
        { data: 'dealer_name', name: 'dealer_name', title: 'Dealer Name' },
        { data: 'car_name', name: 'car_name', title: 'Car Name / Model' },
        { data: 'brand', name: 'brand', title: 'Brand' },
        { data: 'variant', name: 'variant', title: 'Variant' },
        { data: 'price', name: 'price', title: 'Price' },
        { data: 'manufacture_year', name: 'manufacture_year', title: 'Year' },
        { data: 'car_condition', name: 'car_condition', title: 'Condition' },
         { data: 'status', name: 'status', title: 'Status' },
        { data: 'created_at', name: 'created_at', title: 'Created At' },
        { data: 'action', name: 'action', title: 'Action', orderable: false, searchable: false },
    ]
});

    });
</script>
@endsection
