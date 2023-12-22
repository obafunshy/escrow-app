<!-- resources/views/posts/index.blade.php -->

@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <h1 class="mt-4">Posts</h1>

        <div class="row">
            @foreach ($posts as $post)
                <div class="mb-4">
                    <div class="card">
                        @if (!empty($post->image))
                            {{-- Display image for posts with an image --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="https://picsum.photos/id/{{ $post->id }}/300/200" class="card-img-top img-fluid" alt="{{ $post->title }}">
                                </div>
                                <div class="col-md-9">
                                    <div class="card-body">
                                        <span>
                                        @if ($post->category)
                                            <p>Category: <a style="color: black" href="{{ route('categories.show', ['category' => $post->getUrlFriendlyTitleAttribute()]) }}" class="badge badge-dark">{{ $post->category->name }}</a></p>
                                        @endif
                                        </span>
                                        <p class="card-text">{{ $post->short_content }}</p>
                                        <a href="{{ route('posts.show', ['post' => $post->slug]) }}" class="btn btn-primary">Read More</a>
                                        <p>Tags:
                                            @foreach ($post->tags as $tag)
                                                <span class="badge badge-dark" style="color: black"><a href="{{ route('tags.show', ['tag' => $post->getUrlFriendlyTitleAttribute()]) }}" class="btn btn-primary">{{ $tag->name }}</a></span>
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            {{-- Display a placeholder image or alternative content for posts without an image --}}
                            <div class="card-body">
                                <p class="card-text">{{ $post->short_content }}</p>
                                <a href="{{ route('posts.show', ['post' => $post->slug]) }}" class="btn btn-primary">Read More</a>
                                <p>Tags:
                                    @foreach ($post->tags as $tag)
                                        <span class="badge badge-primary">{{ $tag->name }}</span>
                                    @endforeach
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}
    </div>
@endsection
