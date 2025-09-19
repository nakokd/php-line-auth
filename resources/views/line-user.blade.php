<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>LINE User Info</title>
</head>
<body>
    <h1>LINE User Info</h1>
    <table border="1">
        <tr><th>ID</th><td>{{ $lineUser->getId() }}</td></tr>
        <tr><th>Name</th><td>{{ $lineUser->getName() }}</td></tr>
        <tr><th>Avatar</th><td><img src="{{ $lineUser->getAvatar() }}" width="80"></td></tr>
        <tr><th>アクセストークン</th><td>{{ $lineUser->token }}</td></tr>
        <tr><th>有効期限(秒)</th><td>{{ $lineUser->expiresIn }}</td></tr>
    </table>
</body>
</html>
