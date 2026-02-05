<!DOCTYPE html>
<html lang="en">

<head>
    @include('public_view.components.head')
</head>

<body>

    <!-- Spinner Start -->
    @include('public_view.components.spinner')
    <!-- Spinner End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">

        @include('public_view.components.navbar')
        <!-- Carousel Start -->
        @include('public_view.components.carousel')
        <!-- Carousel End -->
    </div>
    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('public_view.components.modal-search')
    <!-- Modal Search End -->

    <!-- feature Start -->
    @yield('content')
    <!-- Fact Counter -->


    <!-- Footer Start -->
    @include('public_view.components.footer')
    <!-- Copyright End -->
    @include('public_view.components.back-to-top')

    <!-- Back to Top -->


 @include('public_view.components.javascript')
    <!-- JavaScript Libraries -->



    <!-- Template Javascript -->

</body>

</html>
