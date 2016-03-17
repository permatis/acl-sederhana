<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <title>@if(request()->segment(1) != '/') @yield('title-page') - @endif Simple Task Managements</title>
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    @stack('script')
    <script type="text/javascript" src="{{ asset('js/crud.js') }}"></script>
</head>

<body class="skin-black sidebar-mini">
    <div class="wrapper">
        @include('partials.navbar')
        @include('partials.sidebar')

        <div class="content-wrapper" style="min-height: 916px;">
            <section class="content-header">
                <h1 id="page-title">@yield('title-page')</h1>
                <ol class="breadcrumb">
                    {!! breadcrumb('Dashboard') !!}
                </ol>
            </section>
            
            <section class="content">
                @yield('content')
            </section>
        </div>

        @include('partials.footer')
    </div>
    
    @if(session('success'))
    <script type="text/javascript">
            var n = noty({
                text: '{{ session('success') }}',
                theme: 'relax',
                layout: 'bottomRight',
                type: 'success',
                timeout: 5000,
                animation: {
                    open: 'animated fadeIn',
                    close: 'animated fadeOut',
                    easing: 'swing',
                    speed: 500 
                }
            });
    </script>
    @endif
</body>
</html>
