<input type="hidden" id="_url" value="{{url('/')}}">
<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('admin-assets/js/adminlte.js')}}"></script>
<script src="{{ asset('admin-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('admin-assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('admin-assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin-assets/js/select2.min.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('admin-assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('admin-assets/js/toastify.min.js')}}"></script>
<script src="{{asset('admin-assets/scripts/helper.js')}}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/js/country.js') }}"></script>
<script src="{{ asset('admin-assets/js/bootstrap-toggle.min.js')}}"></script>
<script src="{{ asset('admin-assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.10.111/pdf.min.js"></script>
<script src="https://unpkg.com/@panzoom/panzoom/dist/panzoom.min.js"></script>
<script src="{{ asset('admin-assets/ckeditor/ckeditor.js')}}"></script>
</script>
<script type="text/javascript">
  $(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      // isLocal: false
    });
  });

  $(document).ready(function() {

    $('.select2').select2({
      // placeholder: 'Select a company',
      width: '100%',
      placeholder: "Select an option",
      allowClear: true
    });

  });

  document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
    Toastify({
      text: "{{ session('success') }}",
      duration: 3000,
      gravity: "top",
      position: 'right',
      backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
    }).showToast();
    @endif

    @if(session('error'))
    Toastify({
      text: "{{ session('error') }}",
      duration: 3000,
      gravity: "top",
      position: 'right',
      backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
    }).showToast();
    @endif
  });

  @if($errors->any())

  @foreach($errors->all() as $error)
  Toastify({
    text: "{{ $error }}",
    duration: 4000,
    close: true,
    gravity: "top", // top or bottom
    position: "right", // left, center or right
    backgroundColor: "#f44336",
  }).showToast();
  @endforeach

  @endif

  function myFunction() {
    setTimeout(showPage, 50);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
  }

  $(function() {
    bsCustomFileInput.init();
  });
</script>
@yield('script')