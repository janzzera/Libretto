@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Book
                </div>
                <div class="float-end">
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('books.update', $book->id) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $book->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="author" class="col-md-4 col-form-label text-md-end text-start">Author</label>
                        <div class="col-md-6">
                            <select type="text" class="form-select" id="author" name="author">
                                @foreach ($authors as $author)
                                @if ($author->id === $book->author_id)
                                    <option value="{{ $author->id }}" selected> {{ $author->name }}</option>
                                @else 
                                    <option value="{{ $author->id }}"> {{ $author->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="genre" class="col-md-4 col-form-label text-md-end text-start">Genre</label>
                        <div class="col-md-6">
                            <select type="text" class="form-select" id="genres" name="genres[]" multiple>
                                @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"
                                    {{ $book->genres->contains('id', $genre->id) ? 'selected' : '' }}> {{ $genre->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
@endsection
