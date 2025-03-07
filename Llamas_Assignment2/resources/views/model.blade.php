<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('documenttitle') </title>

    @yield('style')

</head>
<body style="background-color: grey;">

    @yield('content')

    @yield('script')
</body>
</html>