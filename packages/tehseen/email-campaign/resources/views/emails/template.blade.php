<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
<style>
    body { font-family: Arial, sans-serif; line-height: 1.6; }
    .container { max-width: 600px; margin: 0 auto; }
    .header { background: #f8f9fa; padding: 20px; text-align: center; }
    .content { padding: 20px; }
    .footer { margin-top: 20px; padding: 10px; text-align: center; font-size: 12px; color: #6c757d; }
</style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>{{ $title }}</h1>
    </div>

    <div class="content">
        {!! $content !!}
    </div>

    <div class="footer">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </div>
</div>
</body>
</html>