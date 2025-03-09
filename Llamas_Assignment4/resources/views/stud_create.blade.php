<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color: grey;">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card rounded p-5 shadow p-3 mb-5">
            <div class="card-body">
                <h3 class="text-center mb-3">Create Student</h3>
                <form action="/create" method="post">
                @csrf
                        <div class="form-floating">
                            <input type="text" class="form-control" name="stud_name" placeholder="name@example.com">
                            <label for="floatingInput">Name</label>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                            <input class="btn btn-success me-3" type="submit" value="Add Student">
                            <a class="btn btn-primary" href="/view-records">View Records</a>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>