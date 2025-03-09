<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: grey;">
    <br>
        <div class="container">
            <h1 class="text-light">Records</h1>
            <a class="btn btn-primary mb-4" style="text-decoration: none" href="/insert">+ Create new</a>
                <div class="card rounded p-5 shadow p-3 mb-5 align-items-center">
                <table class="table" style="max-width: 1000px;">
                    <thead class="table-dark">
                        <th>ID</th>
                        <th>Name</th>
                        <th style="width: 17%;">Action</th>
                    </thead>
                    @foreach($users as $user)
                    <tbody>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td><a class="btn btn-danger" href='delete/{{ $user->id }}'>Delete</a> <a class="btn btn-warning" href="edit/{{ $user->id }}">Edit</a></td>
                    </tbody>
                    @endforeach
                </table>
                </div>
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>