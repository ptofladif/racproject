<html>
<head>
    <title>@yield('mail_title')</title>
</head>
<body style="background: #ffffff">
<table style='margin:0;padding:0;width:100%'>
    <tr>
        <td align='center'>
            <table style="width:500px; color:#636b6f">
                <tr>
                    <td><a href='{{ url("/") }}'><i class="fas fa-globe-europe text-info"></i></a></td>
                </tr>
                <tr>
                    <td valign='top' style='border-top: 3px solid #ff7500; padding:33px; height:250px'>
                        <h2>@yield('mail_title')</h2>
                        @yield('mail_content')
                    </td>
                </tr>
                <tr>
                    <td style="border-top: 1px solid #d2d6de; text-align:right;padding:9px">
                        <strong> MFF &copy; {{ date('Y') }} </strong>. Todos os direitos reservados.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
