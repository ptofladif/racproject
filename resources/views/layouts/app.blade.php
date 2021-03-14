<!DOCTYPE html>
<html>

<html lang="pt">

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page" style="background-color: #2a2925;
    background: url(/img/LoginBackground_new.jpg) no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;">

    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        @yield('content')
    </section><!-- /.content -->
</body>

</html>
