<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Language" content="en" />
        <meta name="msapplication-TileColor" content="#2d89ef">
        <meta name="theme-color" content="#4188c9">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <link rel="icon" href="/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        <!-- Generated: 2019-04-04 16:57:42 +0200 -->
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
        <script src="/assets/js/require.min.js"></script>
        <script>
            requirejs.config({
                baseUrl: '/'
            });
        </script>
        <!-- Dashboard Core -->
        <link href="/assets/css/dashboard.css" rel="stylesheet" />
        <script src="/assets/js/dashboard.js"></script>
        <!-- c3.js Charts Plugin -->
        <link href="/assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
        <script src="/assets/plugins/charts-c3/plugin.js"></script>
        <!-- Input Mask Plugin -->
        <script src="/assets/plugins/input-mask/plugin.js"></script>
        <!-- Datatables Plugin -->
        <script src="/assets/plugins/datatables/plugin.js"></script>
        <!-- Datatables Plugin -->
        <script src="/assets/plugins/jquery.growl/plugin.js"></script>
    </head>
    <body>
        <div class="page">
            <div class="flex-fill">
                {!!view('common/header',['menu_active' => isset($menu_active) ? $menu_active : ''])!!}
                <div class="my-3 my-md-5">        
                    @yield('content')
                </div>
            </div>
            {!!view('common/footer')!!}
        </div>
        <script type="text/javascript">
            $(document).ready(function(){
                alert('abc');
            })
        </script>
        @yield('script')
    </body>
</html>