<header class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>

        <li class="nav-item" style="font-size:1.5rem">
            <span>{{ auth()->user()->name }}</span>
        </li>

        <li class="nav-item" style="font-size:1.5rem">
            {{--                        {{dd($_SERVER,$_SERVER['HTTP_HOST'].'/logviewer')}}--}}
            <a href="{{ config('env.APP_URL_PROTOCOL', 'http://').$_SERVER['HTTP_HOST'].'/log-viewer'}}" target="_blank">
                <i class="fa fa-fw fa-book"></i> LogViewer
            </a>
        </li>

    </ul>

    <!-- Right navbar links -->
    @if(count(config('panel.available_languages', [])) > 1)
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    {{ strtoupper(app()->getLocale()) }}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @foreach(config('panel.available_languages') as $langLocale => $langName)
                        <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                    @endforeach
                </div>
            </li>
        </ul>
    @endif

</header>
