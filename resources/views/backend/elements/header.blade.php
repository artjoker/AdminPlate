<!-- begin #header -->
<div id="header" class="header navbar-default">
    <!-- begin navbar-header -->
    <div class="navbar-header">
        <a href="{{ route('backend.dashboard') }}" class="navbar-brand"><span class="navbar-logo"></span> <b>{{ config('app.name', 'Laravel Boilerplate') }}</b></a>
        <button type="button" class="navbar-toggle pt-0 pb-0 mr-0" data-toggle="collapse" data-target="#top-navbar">
				<span class="fa-stack fa-lg text-inverse">
					<i class="far fa-square fa-stack-2x"></i>
					<i class="fa fa-cog fa-stack-1x"></i>
				</span>
        </button>
    </div>
    <!-- end navbar-header -->

    <!-- begin header-nav -->
    <ul class="navbar-nav navbar-right">

        <li class="dropdown navbar-language">
            <a href="#" class="dropdown-toggle pr-1 pl-1 pr-sm-3 pl-sm-3" data-toggle="dropdown">
                <span class="name d-none d-sm-inline">{{ strtoupper(App::getLocale()) }}</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu">
                @foreach(config('app.backend_locales') as $locale)
                    @if($locale !== App::getLocale())
                        <a href="{{ route('backend.setLanguage', ['locale' => $locale]) }}" class="dropdown-item">
                            <span class="flag-icon flag-icon-us" title="us"></span> {{ strtoupper($locale) }}</a>
                    @endif
                @endforeach
            </div>
        </li>
        <li class="dropdown navbar-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('assets/img/user/user-12.jpg') }}" alt=""/>
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span> <b class="caret"></b>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('backend.logout') }}" class="dropdown-item">@lang('backend.logout')</a>
            </div>
        </li>
        <li class="navbar-user">
            <a href="{{ url('/') }}" class="dropdown-toggle pr-1 pl-1 pr-sm-3 pl-sm-3" target="_blank">
                <i class="fa fa-home"></i> @lang('backend.go_to_site')
            </a>
        </li>
    </ul>
    <!-- end header navigation right -->
</div>
<!-- end #header -->
