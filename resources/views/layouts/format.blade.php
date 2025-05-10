<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Owner Dashboard</title>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <div class="leftHeader">
                <img class="w-25" src="{{ asset('images/ezd-logo.jpg') }}" alt="Logo" class="header-img">
                <h1>Owner Dashboard</h1>
            </div> <!-- End of leftHeader -->

            <div class="rightHeader">
                Bayot Paul 
            </div> <!-- End of rightHeader -->

        </div> <!-- End of header -->

        <div class="container">

            {{-- This is where content loads, i think,  --}}
            @yield('content')

        </div><!-- End of container -->
    </div> <!-- End of wrapper -->
</body>
</html>