<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eloquent Relationships</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body> 
    <div class="container">
        <header class="bg-light p-3 rounded shadow d-flex gap-2 flex-wrap mt-3 align-items-center">
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('authors.index') }}" class="btn btn-primary btn-sm">
                    Author
                </a>
                <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">
                    Book
                </a> 
                <a href="{{ route('genres.index') }}" class="btn btn-primary btn-sm">
                    Genre
                </a>
                <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-sm">
                    Review
                </a>
            </div>
             
            @if (Auth::check())
                <form action="{{ route('logout') }}" method="POST" class="ms-auto">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            @endif
        </header>
        
        <h3 class=" mt-3">Eloquent Relationships</h3>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> 
</body> 
</html>