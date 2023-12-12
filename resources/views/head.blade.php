<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>NextBasis</title>
    <link rel="shortcut icon" href="logo.png" />

    <!-- @stack('prepend-style') -->
    @include('style')
    <!-- @stack('addon-style') -->
</head>

<body>

    <div class="container">
        @include('sidebar')

        @yield('content')
    </div>

    @stack('prepend-script')
    @include('script')
    @stack('addon-script')
</body>

</html>