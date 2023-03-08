<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @stack('styles')
    <title>@yield('title', 'Meu título')</title>
</head>
<body>
    <h1>Meu layout</h1>

    @section('sidebar')
        <div> 
            <nav> 
                sidebar
            </nav>
        </div>
    @show
    
    @yield('content')
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
</html>