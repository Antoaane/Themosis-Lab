<!doctype html>
<html {!! get_language_attributes() !!}>
<head>
    <meta charset="{{ get_bloginfo('charset') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    @head
</head>
<body @php(body_class())>
<div id="page" class="min-h-screen flex flex-col font-outfit text-dark">
    <header class="flex-none relative z-50 @if(!is_front_page()) bg-image @endif">
        @include('layouts.header')

    </header>

    <div id="content" class="flex-grow">
        <main id="main" class="site-main">
            @yield('content')
        </main>
    </div>

    <footer class="flex-none">
        @include('layouts.footer')
    </footer>
</div>

@footer

</body>
</html>
