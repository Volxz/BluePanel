<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('partials.head')

    @stack('styles')
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        @include('partials.header')
    </header>
    <aside class="main-sidebar">
        @include('partials.nav')
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            @yield('content-header')
        </section>

        <section class="content">
            @yield('content')
        </section>
    </div>



</div>
@include('partials.footer')
<!-- Scripts -->
@stack('scripts')

</body>
</html>
