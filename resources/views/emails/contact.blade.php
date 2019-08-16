<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="background-color: #fcfcfc;">
<table border="0" cellpadding="0" cellspacing="0" style="margin:0 auto; padding:0 0 32px; max-width: 600px; color: #1A1A1A; background-color: #fff; line-height: 1; -moz-box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); -webkit-box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); box-shadow: 0 0 2px rgba(0, 0, 0, 0.2);">
    <tr>
        <td>
            <table border="0" cellpadding="0" cellspacing="0" width="600px" bgcolor="#EAEAEA" style="margin: 0; padding: 0">
                <tr>
                    <td style="width: 100%; padding-top: 11px; padding-bottom: 11px;">
                        <a href="{{ route('home') }}" style="display: block; width: 100%; font-size: 18px;" target="_blank"><img src="{{ url('/images/logo.png') }}" alt="{{ config('app.name') }}" border="0" width="149" height="50px" style="display:block; margin: auto;"/></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; text-align: center; padding-top: 35px; padding-right: 30px; padding-left: 30px; font-size: 16px; line-height: 17px; font-weight: 600;">
            <h3>Contact from {{ $name }}</h3>
        </td>
    </tr>
    <tr>
        <td style="width: 100%; text-align: left; padding-right: 30px; padding-left: 30px; padding-top: 25px; font-size: 16px;">
            Name: {{ $name }} <br />
            Email: {{ $email }} <br />
            Message:<br />
            {{ $text }}
        </td>
    </tr>
</table>
</body>
</html>