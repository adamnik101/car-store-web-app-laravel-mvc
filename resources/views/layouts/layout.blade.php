<!doctype html>
<html lang="en">
    @include("common.head")
<body>
    <div class="page-wrapper">
        @include('common.header')

        <div class="main-content-wrapper">
            @yield('content')
        </div>

        @include('common.footer')
    </div>
    @include("common.scripts")
</body>
</html>
