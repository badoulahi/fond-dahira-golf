<!DOCTYPE html>
<html lang="en">

<head>
    @include('manager_view.components.head')

    @yield('css')
</head>

<body>
    <div class="wrapper">
        @include('manager_view.components.sidebar')

        <div class="main-panel">
            @include('manager_view.components.navbar')

            <div class="container">
                @yield('content')
            </div>

            @include('public_view.components.footer')
        </div>
    </div>

    @include('manager_view.components.javascript')

    @yield('javascript')

</body>

</html>
