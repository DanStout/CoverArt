<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">CoverArt.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="/about">About</a></li>
                <li><a href="/templates">Templates</a></li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li>{!! Html::linkRoute('covers.create', 'Upload Cover') !!}</li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            {{Auth::user()->name}} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>{!! Html::linkRoute('profiles.show', 'Profile', [Auth::user()->id]) !!}</li>
                            <li>{!! Html::linkRoute('auth.logout', 'Logout') !!}</li>
                        </ul>
                    </li>
                @else
                    <li>{!! Html::linkRoute('auth.login', 'Login') !!}</li>
                    <li><p class="navbar-btn">{!! Html::linkRoute('auth.register', 'Register', null, ['class' => 'btn btn-primary']) !!}</p></li>
                @endif

            </ul>
        </div>
    </div>
</nav>
