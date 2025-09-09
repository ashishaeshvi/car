<link rel="stylesheet" href="{{ asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet"
  href="{{ asset('admin-assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin-assets/css/adminlte.min.css')}}">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('admin-assets/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('admin-assets/css/toastify.min.css')}}">
<link href="{{ asset('admin-assets/css/my-css.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('admin-assets/css/bootstrap-toggle.min.css')}}">
<style>
  #loader {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 9999;
  }

  #loader::after {
    content: '';
    width: 60px;
    height: 60px;
    display: block;
    position: absolute;
    left: calc(50% - 30px);
    top: calc(50% - 30px);
    border: 5px solid #f5f5f5;
    border-radius: 50%;
    border-top: 5px solid #e1306c;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
  }

  @-webkit-keyframes spin {
    0% {
      -webkit-transform: rotate(0deg);
    }

    100% {
      -webkit-transform: rotate(360deg);
    }
  }

  @keyframes spin {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
</style>
@yield('stylesheet')