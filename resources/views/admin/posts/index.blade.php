@extends('admin.layouts')

@section('title', 'Dashboard - Posts')

@section('content')
    <h2>Posts</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Short Content</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><img width="200" height="150" src="https://picsum.photos/id/{{ $post->id }}/300/200" alt="{{ $post->title }}"></td>
                <td>{{ $post->title }}</td>
                <td>
                    @if ($post->category)
                        <a href="#" class="badge badge-dark">{{ $post->category->name }}</a>
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $post->short_content }}</td>
                <td>{{ $post->status ? 'Approved' : 'Pending' }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Post Actions">
                        <a href="#" class="btn btn-primary">Show</a>
                        <a href="#" class="btn btn-warning">Edit</a>
                        <form action="#" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        {{-- <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form> --}}
                    </div>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{ $posts->links() }}
      </div>
@endsection






