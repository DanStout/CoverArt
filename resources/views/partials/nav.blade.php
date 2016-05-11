<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {!! Html::linkRoute('covers.index', 'CoverArt', [], ['class' => 'navbar-brand']) !!}
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                {!! Html::linkRouteActiveLi('templates.index', 'Templates') !!}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    {!! Html::linkRouteActiveLi('covers.create', 'Upload Cover') !!}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            {!! Html::linkRouteActiveLi('profiles.show', 'Profile', [Auth::id()]) !!}
                            <li>{!! Html::linkRoute('auth.logout', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    {!! Html::linkRouteActiveLi('auth.login', 'Login') !!}
                    <li {{Route::currentRouteName() == 'auth.register' ? 'class="active"' : ''}}><p class="navbar-btn">{!! Html::linkRoute('auth.register', 'Register', null, ['class' => 'btn btn-primary']) !!}</p></li>
                @endif

            </ul>
        </div>
    </div>
</nav>
