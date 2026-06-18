<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-body text-center p-5">


                <h1 class="mb-3">
                    Welcome, {{ session('user_name') }}
                </h1>

                <p class="text-muted">
                    You have successfully logged in.
                </p>

                <div class="mt-4">

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">
                        Edit Profile
                    </a>

                    <a href="{{ route('logout') }}" class="btn btn-danger">
                        Logout
                    </a>

                </div>

            </div>
        </div>

    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</html>
