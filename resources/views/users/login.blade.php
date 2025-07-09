<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Simple Laravel 11 CRUD Application Tutorial</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>


    <form action="{{ route('authenticate') }}" method="POST" class="mx-auto" style="max-width: 400px;">
        @csrf

        <label for="name" class="form-label">Username</label>
        <input type="text" name="name" id="name" 
               class="form-control @error('name') is-invalid @enderror" 
               value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        <label for="password" class="form-label mt-3">Password</label>
        <input type="password" name="password" id="password" 
               class="form-control @error('password') is-invalid @enderror">
        @error('password')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary w-100 mt-4">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('register') }}">Register an account</a>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
