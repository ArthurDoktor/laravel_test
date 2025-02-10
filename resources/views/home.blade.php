<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog</title>
</head>
<body>

    @auth

        <p>Wuhu you are loged in!</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Log out</button>
        </form>

        <div style="border: 3px solid black;">
            <h1>Create post</h1>
            <form action="/create-post" method="POST">
                @csrf
                <input name="title" type="text" placeholder="Title">
                </br>
                <textarea name="content" placeholder="Content"></textarea>
                <button>Post</button>
            </form>
        </div>

        <div style="border: 3px solid black;">
            <h1>All posts</h1>

            @foreach($posts as $post)
                <div style="background: #9ca3af">
                    <h2>{{$post['title']}}</h2>
                    <h6>By {{$post->user->name}}</h6>
                    {{$post['content']}}
                    <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                    <form action="/delete-post/{{$post->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            @endforeach
        </div>

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

        <div style="border: 3px solid black;">
            <h1>Log in</h1>
            <form action="/login" method="POST">
                @csrf
                <input name="email" type="text" placeholder="e-mail">
                <input name="password" type="password" placeholder="password">
                <button>Log in</button>
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
