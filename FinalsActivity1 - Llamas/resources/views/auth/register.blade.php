<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div>
            <label for="">Name: </label>
            <input type="text" name="name" value="{{ old('name') }}" id="" required autofocus>
        </div>
        <div>
            <label for="">Email: </label>
            <input type="email" name="email" value="{{ old('email') }}" id="" required>
        </div>
        <div>
            <label for="">Password: </label>
            <input type="text" name="password" id="" required>
        </div>
        <div>
            <label for="">Confirm Password</label>
            <input type="text" name="password_confirmation" id="" required>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>