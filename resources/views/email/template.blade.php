<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Notification Email</title>
  <style>
    body {
      background-color: #f8f9fc;
      font-family: 'Helvetica Neue', Arial, sans-serif;
      color: #333;
      margin: 0;
      padding: 0;
    }
    .email-container {
      max-width: 600px;
      margin: 40px auto;
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
      overflow: hidden;
    }
    .header {
      background-color: #667eea;
      color: #ffffff;
      text-align: center;
      padding: 30px 20px;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
      font-weight: 600;
    }
    .content {
      padding: 30px 20px;
      text-align: left;
    }
    .content h2 {
      color: #1a1a1a;
      font-size: 20px;
      margin-bottom: 10px;
    }
    .content p {
      color: #555;
      line-height: 1.6;
      font-size: 15px;
      margin-bottom: 20px;
    }
    .button {
      display: inline-block;
      padding: 12px 24px;
      background-color: #667eea;
      color: #ffffff !important;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      font-size: 15px;
    }
    .button:hover {
      background-color: #5a6edc;
    }
    .footer {
      background-color: #f0f2f8;
      color: #888;
      text-align: center;
      font-size: 13px;
      padding: 20px;
      border-top: 1px solid #e6e8ef;
    }
    @media (max-width: 480px) {
      .email-container {
        margin: 10px;
      }
      .content {
        padding: 20px 15px;
      }
    }
  </style>
</head>
<body>
  <div class="email-container">
    <div class="header">
      <h1>{{ $title ?? 'Notification from ' . ($company ?? config('app.name')) }}</h1>
    </div>

    <div class="content">
      <h2>{{ $greeting ?? ('Hello' . (isset($name) ? ', ' . $name : '')) }}</h2>

      @if(!empty($introLines) && is_array($introLines))
        @foreach($introLines as $line)
          <p>{{ $line }}</p>
        @endforeach
      @elseif(!empty($intro))
        <p>{{ $intro }}</p>
      @else
        <p>{{ $slot ?? 'We wanted to let you know about an update to your account.' }}</p>
      @endif

      @if(!empty($actionText) && !empty($actionUrl))
        <p style="margin-top:10px">&nbsp;</p>
        <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
      @endif

      @if(!empty($outroLines) && is_array($outroLines))
        @foreach($outroLines as $line)
          <p style="margin-top: 20px;">{{ $line }}</p>
        @endforeach
      @elseif(!empty($outro))
        <p style="margin-top: 20px;">{{ $outro }}</p>
      @endif
    </div>

    <div class="footer">
      @if(!empty($signature))
        <p>{{ $signature }}</p>
      @else
        <p>&copy; {{ date('Y') }} {{ $company ?? config('app.name') }}. All rights reserved.</p>
      @endif

      @if(!empty($address))
        <p>{{ $address }}</p>
      @endif
    </div>
  </div>
</body>
</html>
