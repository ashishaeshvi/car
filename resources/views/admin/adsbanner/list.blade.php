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
                            class="fa fa-arrow-left fa-xs"></i> {{ __('Back') }}</a>              
                   @can('adsbanner.create')           
                     <a href="{{ route('adsbanner.create') }}" type="button" class="btn btn-info"
                         style="float: right;margin-right:3px;">Add New {{ $create_title }}</a>
                    @endcan                       
                  
                </div>
                <div class="card-body">
                    <table id="adsbannerTable" class="table table-bordered table-striped">                        
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
            $("#adsbannerTable").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: url + "/adsbanner",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        title: '#',
                        orderable: false,
                        searchable: false
                    },
                    {
                    data: 'adsImg',
                    name: 'adsImg',
                    title: 'Image',
                },                   
                    {
                        data: 'status',
                        name: 'status',
                        title: 'Status',
                        orderable: false
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
