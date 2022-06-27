<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <title>CALAHEX - Carribean And Latin America Hybrid Exchange</title>
    <link rel="icon" href="assets/favicon/favicon.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="{{ asset('css/free.min.css') }}" rel="stylesheet"> <!-- icons -->
    <!-- Main styles for this application-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    @yield('css')

    <!-- Global site tag (gtag.js) - Google Analytics-->
{{--    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>--}}
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>

    <link href="{{ asset('css/coreui-chartjs.css') }}" rel="stylesheet">
  </head>



  <body class="c-app">
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

      @include('dashboard.shared.nav-builder')

      @include('dashboard.shared.header')

      <div class="c-body">

        <main class="c-main">

          @yield('content')

        </main>
        @include('dashboard.shared.footer')
      </div>
    </div>



    <!-- CoreUI and necessary plugins-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="{{ asset('js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('js/coreui-utils.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @yield('javascript')

    @if(Session::has('message'))
    <script>
        
        $(function(){
            "use strict";
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "300",
                "timeOut": "2000",
            }
            
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
    
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
    
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
    
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        })
    </script>
    @endif


  </body>
</html>
