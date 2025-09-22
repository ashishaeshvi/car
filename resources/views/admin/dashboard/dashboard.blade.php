@extends('admin.layouts.master')
@section('title',__('Admin Dashboard'))
@section('maincontent')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Dashboard</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#"><a
                href="{{ url('admin/dashboard') }}">Dashboard</a></a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="row">

    @can('user.view')
    <div class="col-lg-3 col-6">
      <div class="small-box bg-primary">
        <div class="inner">
          <h3>{{ $staff_counts }}</h3>
          <p>Staff</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-6">
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{ $user_counts }}</h3>
          <p>Users</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{ route('user.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    @endcan

   


   

   

  </div>
</section>

@endsection
@section('scripts')
@endsection