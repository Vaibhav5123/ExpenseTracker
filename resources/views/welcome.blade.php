<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark d-flex flex-column min-vh-100">

    @include('layouts.header')

    <main class="flex-grow-1 d-flex align-items-center justify-content-center text-center">
        <div class="container">
            <h2 class="mb-4">Welcome to Expense Tracker</h2>
            <p class="lead">Track your expenses now..!</p>
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
