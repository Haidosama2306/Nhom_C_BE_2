<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.client._head')
</head>

<body>
    <div id="wrapper" class="wrap">
        <header>
            <!-- headerTop -->
            @include('layouts.client.headerTop')

            <!-- headerNav -->
            @include('layouts.client.headerNav')
        </header>

        <div class="container">
            <!-- content -->
            @yield('content')
        </div>

        <footer>
            @include('layouts.client.footer')
        </footer>

        <!-- javascript -->
        @include('layouts.client._script')
</body>

</html>
