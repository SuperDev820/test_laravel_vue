@include('layouts.include.head')
<body>
@inject('appConfig', 'App\Http\Controllers\InitController)
<div id="app">
    <main id="app">
        @yield('content')
    </main>
</div>
<script>
    window.appConfig = {
        appUrl: "{{ $appConfig->appUrl }}",
    }
</script>
@include('layouts.include.footer')