<!doctype html>
<html lang="en">
@include("admin.common.head")
<body>
<div class="admin-wrapper">
    @include('admin.common.header')
    @include('admin.common.sidebar')

    @yield('content')


    @include('admin.common.footer')
</div>
@include("admin.common.scripts")
</body>
</html>
