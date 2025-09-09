<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $MAIL_FROM_NAME }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: #2a72a6;
            padding: 15px;
            text-align: center;
            color: #ffffff;
            font-size: 20px;
            font-weight: bold;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .content img {
            display: block;
            margin: 0 auto 15px;
        }
        .content .login {
            display: inline-block;
            background: #2a72a6;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .footer {
            background: #10318d;
            text-align: center;
            padding: 10px;
            color: #ffffff;
            font-size: 14px;
        }
        .social-icons {
            text-align: center;
            margin-top: 10px;
        }
        .social-icons a {
            margin: 0 10px;
            display: inline-block;
        }
        .social-icons img {
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            {{ $MAIL_FROM_NAME }}
        </div> 
        <div class="content">
            <!-- <img src="{{ url('public/uploads/' . optional($website_settings)->website_logo) }}" alt="{{ $MAIL_FROM_NAME }}" width="150"> -->
            <p>Dear <strong>{{ ucfirst($name) }} </strong>,</p>
            <p>Your account details below.</p>
            <p><strong>Login Credentials:</strong></p>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>New Password:</strong>  {{ $password }}</p>
            <p style="text-align: center;"><a href="{{ url($redirectUrl) }}" class="login">Click Here to Login</a></p>         
            <p>Best regards,</p>
            <p><strong>Team {{ $MAIL_FROM_NAME }}</strong></p>
        </div>
        <!-- <div class="social-icons">
            <a href="{{ optional($website_settings)->fb_link }}" target="_blank"><img src="{{ url('assets/front/facebook.png') }}" alt="Facebook"></a>
            <a href="{{ optional($website_settings)->twitter_link }}" target="_blank"><img src="{{ url('assets/front/twitter.png') }}" alt="Twitter"></a>
            <a href="{{ optional($website_settings)->youtube_link }}" target="_blank"><img src="{{ url('assets/front/youtube.png') }}" alt="YouTube"></a>
            <a href="{{ optional($website_settings)->instagrams_link }}" target="_blank"><img src="{{ url('assets/front/instagram.png') }}" alt="Instagram"></a>
        </div> -->
        <div class="footer">
            &copy; {{ date('Y') }} {{ $MAIL_FROM_NAME }} | All Rights Reserved
        </div>
    </div>
</body>
</html>