@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Genre Information
                </div>
                <div class="float-end">
                    <a href="{{ route('genres.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <label for="id" class="col-md-4 col-form-label text-md-end text-start"><strong>ID:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $genre->id }}
                    </div>
                </div>
                <div class="row">
                    <label for="genre" class="col-md-4 col-form-label text-md-end text-start"><strong>Genre:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $genre->name }}
                    </div>
                </div>
                <div class="row">
                    <label for="books" class="col-md-4 col-form-label text-md-end text-start"><strong>Books:</strong></label>
                </div>
                @forelse ($genre->books as $book)
                <div class="row">
                    <div class="col-md-4 col-form-label text-md-end text-start">{{ $loop->iteration }}. </div>
                    <div class="col-md-7" style="line-height: 35px;">
                        {{ $book->title }}
                    </div>                
                    @empty
                    <div class="col-md-6 col-form-label text-md-end text-start">No Book Found </div>
                </div>
                
                @endforelse
            </div>
        </div>
    </div> 
</div> 
@endsection
