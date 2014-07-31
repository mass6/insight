<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Password Reset</h2>

<div>
    <p>
    A request to reset your password has been received. To confirm, please click at the bottom of this email.
    You will be emailed a new temporary password.
    </p>
    <p>{{ URL::to('reset-password', array($token)) }}</p>

</div>
</body>
</html>
