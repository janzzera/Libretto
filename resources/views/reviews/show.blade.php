@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Review Information
                </div>
                <div class="float-end">
                    <a href="{{ route('reviews.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <label for="id" class="col-md-4 col-form-label text-md-end text-start"><strong>ID:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->id }}
                    </div>
                </div>
                <div class="row">
                    <label for="book" class="col-md-4 col-form-label text-md-end text-start"><strong>Book:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->book->title }}
                    </div>
                </div>
            
                <div class="row">
                    <label for="content" class="col-md-4 col-form-label text-md-end text-start"><strong>Content:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->content }}
                    </div>
                </div>

                <div class="row">
                    <label for="rating" class="col-md-4 col-form-label text-md-end text-start"><strong>Rating:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $review->rating }}
                    </div>
                </div>

            </div>
        </div>
    </div> 
</div> 
@endsection
