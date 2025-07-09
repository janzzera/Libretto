@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Genre
                </div>
                <div class="float-end">
                    <a href="{{ route('genres.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('genres.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="genre" class="col-md-4 col-form-label text-md-end text-start">Genre</label>
                        <div class="col-md-6">
                            <input type="text" 
                                   class="form-control @error('genre') is-invalid @enderror" 
                                   id="genre" name="genre" value="{{ old('genre') }}">
                            @error('genre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Genre">
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
@endsection

