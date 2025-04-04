<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <label for="">Email: </label>
            <input type="email" name="email" id="" required>
        </div>
        <div>
            <label for="">Password</label>
            <input type="text" name="password" id="">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>