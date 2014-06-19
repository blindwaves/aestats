<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'AE Stats')</title>
        
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
        
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ URL::asset('js/lodash.compat.min.js') }}"></script>

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-52021607-1', 'blindwaves.com');
            ga('send', 'pageview');
        </script>
    </head>
    <body>
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-menu">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="main-menu">
                    @if (! empty($serverName))
                    <form id="search-form" class="navbar-form navbar-right" role="search" action="{{ URL::action('ServerController@getSearch', array($serverName)) }}" method="get">
                        <div class="form-group">
                            <input name="terms" type="text" class="form-control" placeholder="Player Name/ID" value="{{ Input::get('terms') }}">
                        </div>
                        <button type="submit" class="btn btn-default" data-toggle="popover" data-placement="bottom" data-content="Find Something">search</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
