<input type="hidden" id="_url" value="{{url('/')}}">
 <script src="{{ asset('front-assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('front-assets/js/main.js') }}"></script>
  <script src="{{ asset('front-assets/js/custom.js') }}"></script>
  <script src="{{asset('front-assets/scripts/helper.js')}}" type="text/javascript"></script>
  <script type="text/javascript" src="{{ asset('admin-assets/js/jquery.validate.js')}}"></script>
  <script src="{{ asset('front-assets/scripts/login.js') }}"></script>
  <script src="{{asset('admin-assets/js/toastify.min.js')}}"></script>
  <script type="text/javascript">
    $('select:not(.ignore)').niceSelect();
    $(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        isLocal: false
      });
    });

    $(document).ready(function() {
      //Disable cut copy paste
      $('body').bind('cut copy paste', function(e) {
        //     e.preventDefault();
      });

      //Disable mouse right click
      $("body").on("contextmenu", function(e) {
        // return false;
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

  function myFunction() {
    setTimeout(showPage, 50);
  }

  function showPage() {
    document.getElementById("loader").style.display = "none";
  }
  </script>
@yield('script')