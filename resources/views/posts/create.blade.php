@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="container">
        <h1 class="mt-4 text-center">Create a New Post</h1>

        <div class="row">
            <div class="col-md-9 mx-auto">
                @auth
                <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" id="content" name="content" required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create Post</button>
                </form>
                @else
                    <p>You must be logged in to create a post.</p>
                    <p><a href="{{ route('login') }}">Login</a></p>
                @endauth
            </div>
        </div>
    </div>
@endsection
