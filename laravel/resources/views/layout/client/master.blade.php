<!DOCTYPE html>
<html lang="en">

<head>
    @include('layout.client._head')
</head>

<body>
    <div id="wrapper" class="wrap">
        <header>
            <!-- headerTop -->
            @include('layout.client.header')

            <!-- headerNav -->
            @include('layout.client.navbar')
        </header>

        <div class="container">
            <!-- content -->
            @yield('content')
        </div>

        <!-- javascript -->
        @include('layout.client._script')
</body>

</html>
