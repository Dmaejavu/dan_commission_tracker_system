<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ Auth::user()->position }} Dashboard</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="leftHeader">
                <img class="w-25" src="{{ asset('images/ezd-logo.png') }}" alt="Logo" class="header-img">
                <h1>{{ Auth::user()->position }} Dashboard</h1>
            </div> <!-- End of leftHeader -->

            <div class="rightHeader">
                <button> 
                    <img src="{{ asset('images/icons8-whitePerson-90.png') }}" alt="Logo" class="header-img">
                </button>
                <h3 class="no-underline">{{ Auth::user()->username }}</h3> 
            </div> <!-- End of rightHeader -->

        </div> <!-- End of header -->
        
        <div class="container">

            {{-- This is where content loads, i think,  --}}
            @yield('content')

        </div><!-- End of container -->
    </div> <!-- End of wrapper -->
</body>
</html>