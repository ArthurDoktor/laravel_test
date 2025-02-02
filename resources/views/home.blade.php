<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>

    @auth

        <p>Wuhu you are loged in!</p>
        <form action="/logout" method="POST">
            <button>Log out</button>
        </form>

    @else

        <div style="border: 3px solid black;">
        <h1>Register</h1>
        <form action="/register" method="POST">
            @csrf
            <input name="name" type="text" placeholder="Username">
            <input name="email" type="text" placeholder="e-mail">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        </div>

    @endauth

</body>
</html>
