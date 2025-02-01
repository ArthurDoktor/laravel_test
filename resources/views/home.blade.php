<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <div style="border: 3px solid black;">
        <h1>Register</h1>
        <form action="/register" method="POST">
            @csrf
            <input type="text" placeholder="Username">
            <input type="text" placeholder="e-mail">
            <input type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
</body>
</html>
