<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylehseet">
    <!--link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.0/css/all.css" integrity="sha384-Mmxa0mLqhmOeaE8vgOSbKacftZcsNYDjQzuCOm6D02luYSzBG8vpaOykv9lFQ51Y" crossorigin="anonymous"-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/all.js') }}"></script>
</head>
<body onload = time();>
        <div class="container main-content col-md-10">
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script> 
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/datatables.min.js') }}"></script> 
<script src="{{ asset('js/bootstrap-tokenfield.js') }}"></script>
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>  
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/numbers2words.min.js') }}"></script>
<script src="{{ asset('js/numeral.min.js') }}"></script>
<script src="{{ asset('js/createorder.js') }}"></script>
<script src="{{ asset('js/tableview.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/inventory.js') }}"></script>
<script src="{{ asset('js/voidtransactions.js') }}"></script>
<script src="{{ asset('js/glamping.js') }}"></script>
<script src="{{ asset('js/input-validation.js') }}"></script>
<script src="{{ asset('js/sidebar.js') }}"></script>
<script src="{{ asset('js/checkout.js') }}"></script>
<script src="{{ asset('js/unitfinder-calendar.js') }}"></script>
<script src="{{ asset('js/backpacker.js') }}"></script>
<script src="{{ asset('js/backpacker-2.js') }}"></script>
<script src="{{ asset('js/custom7.js') }}"></script>
<script>
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    
    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        } else {
        dropdownContent.style.display = "block";
        }
        });
    }
</script>
<script> 
    function clock(){
        var refresh = 1000; 
        mytime = setTimeout('time()', refresh)
    }

    function time() {
        var date = new Date()
        var today = date;
        document.getElementById('currentDatetime').innerHTML = today;
        display = clock();
    }
</script>
</body>
</html>
