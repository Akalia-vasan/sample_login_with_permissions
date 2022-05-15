<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', 'My Task')</title>
        <meta name="description" content="@yield('meta_description', 'Laravel Starter')">
        <meta name="author" content="@yield('meta_author', 'FasTrax Infotech')">
        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(asset('css/frontend.css')) }}

        @stack('after-styles')
    </head>
    <body>

        <div id="app">
            @include('account.layouts.nav')

            <div class="container">
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(asset('js/manifest.js')) !!}
        {!! script(asset('js/vendor.js')) !!}
        {!! script(asset('js/frontend.js')) !!}
        @stack('after-scripts')

    </body>
</html>
