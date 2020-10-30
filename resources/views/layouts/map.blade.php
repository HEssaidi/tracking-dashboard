<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

            <!-- The core Firebase JS SDK is always required and must be listed first -->
            <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-app.js"></script>

            <!-- TODO: Add SDKs for Firebase products that you want to use
            https://firebase.google.com/docs/web/setup#available-libraries -->
            <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-analytics.js"></script>
            <script src="https://www.gstatic.com/firebasejs/7.16.0/firebase-database.js"></script>
            <title>
                Laramap
            </title>
           
        </meta>
            <link rel="stylesheet" href="{{asset('css/main.css')}}">
            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
            </link>

            <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
            <!-- CSS Just for demo purpose, don't include it in your project -->
            <link href="assets/demo/demo.css" rel="stylesheet" />
    </head>
    <body>
        @yield('content')
        <script crossorigin="anonymous" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" src="https://code.jquery.com/jquery-3.1.0.min.js">
        </script>
        {{-- Google map api  --}}

        <script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRbSCy8CY96i3WLdXpj8_cyQuQLwh6Rx8">
        </script>

        <script src="{{asset('js/script_map.js')}}"></script>
        <!--script src="{{asset('js/ajaxsearch.js')}}"></script-->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
        </script>


<!--script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script-->

    </body>
</html>