@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container text-center">
        <h1 class="mt-4">{{ $post->title }}</h1>

        <div class="row">
            <div class="col-md-12">
                <div class="post-img mb-2">
                    <img src="https://picsum.photos/id/{{ $post->id }}/600/400" class="img-fluid" alt="{{ $post->title }}">
                </div>
                @if ($post->category)
                    <a href="#" class="badge badge-dark text-dark">{{ $post->category->name }}</a>
                @endif
            </div>
            <div class="col-md-12">
                <div class="post-content mb-1">
                    <p>{{ $post->content }}</p>
                </div>
                <div class="post-tags text-center">
                    <p>Tags:
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-dark text-dark">
                                <a href="#">{{ $tag->name }} </a>
                            </span>
                        @endforeach
                    </p>
            </div>
            </div>
        </div>

        {{-- @if (empty($post->image))
            <div class="row">
                <div class="col-md-6">
                    <img src="https://picsum.photos/{{ $post->id }}/600/400" class="img-fluid" alt="{{ $post->title }}">
                </div>
                <div class="col-md-6">
                    @if ($post->category)
                        <a href="#" class="badge badge-dark">post category name </a>
                    @endif
                    <p>{{ $post->content }}</p>
                    <p>Tags:
                        @foreach ($post->tags as $tag)
                            <span class="badge badge-dark">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                </div>
            </div>
        @else
            {{-- Display a placeholder image or alternative content for posts without an image --}}
            {{-- <div class="card-body">
                <p>Category: @if ($post->category)
                                <a href="#" class="badge badge-dark"> post category->name </a>
                            @endif
                </p>
                <p>{{ $post->content }}</p>
                <p>Tags:
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-dark">{{ $tag->name }}</span>
                    @endforeach
                </p>
            </div>
        @endif --}}
    </div>
@endsection
