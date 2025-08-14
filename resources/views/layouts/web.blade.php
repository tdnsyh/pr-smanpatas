<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title') - Ikatan Alumni SMAN 4 Tasikmalaya</title>
    {{-- <link rel="shortcut icon" type="image/png" href="{{ asset('web/images/logos/seodashlogo.png') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('web/libs/simplebar/dist/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('web/css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/extensions/aos/aos.css') }}">

    @stack('style')
</head>

<body>

    @yield('content')


    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
        integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
    </script>
    <script src="{{ asset('assets/extensions/aos/aos.js') }}"></script>
    <script src="{{ asset('web/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('web/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/libs/simplebar/dist/simplebar.js') }}"></script>
    @stack('script')
</body>

</html>
