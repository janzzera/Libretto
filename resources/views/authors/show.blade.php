@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Author Information
                </div>
                <div class="float-end">
                    <a href="{{ route('authors.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <label for="id" class="col-md-4 col-form-label text-md-end text-start"><strong>ID:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $author->id }}
                    </div>
                </div>
                <div class="row">
                    <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $author->name }}
                    </div>
                </div>
                <div class="row">
                    <label for="books" class="col-md-4 col-form-label text-md-end text-start"><strong>Books:</strong></label>
                    <div class="col-md-7" style="line-height: 35px;">
                        @forelse ($author->books as $book)
                            {{ $loop->iteration }}. {{ $book->title }} <br>
                            @empty No book available<br>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div> 
</div> 
@endsection