@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Book
                </div>
                <div class="float-end">
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('books.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-6">
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-md-4 col-form-label text-md-end text-start">Author</label>
                        <div class="col-md-6">
                            <select type="text" class="form-select" id="author" name="author">
                                <option value=""> ...</option>
                                @foreach ($authors as $author)
                                <option value="{{ $author->id }}"> {{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="genre" class="col-md-4 col-form-label text-md-end text-start">Genre</label>
                        <div class="col-md-6">
                            <select type="text" class="form-select" id="genres" name="genres[]" multiple>
                                <option value=""> ...</option>
                                @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}"> {{ $genre->name }}</option>
                                @endforeach
                            </select>
                            @error('genres')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Book">
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
@endsection

