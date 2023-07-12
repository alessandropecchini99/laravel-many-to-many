@extends('admin.layouts.base')

@section('title', 'Index')

@section('main') 

    <div class="index container">
    
        <h1>TECHNOLOGIES</h1>

            {{-- conferma delete --}}
            @if (session('harddelete_success'))
                @php $technology = session('harddelete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $technology->name }}" Permanently Deleted
                </div>
            @endif

            {{-- conferma delete --}}
            @if (session('softdelete_success'))
                @php $technology = session('softdelete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $technology->name }}" Soft Deleted
                    <form
                        action="{{ route("admin.technologies.restore", ['technology' => $technology]) }}"
                        method="POST"
                        class="d-inline-block restore-btn"
                    >
                        @csrf
                        <button class="btn btn-warning">Restore</button>
                    </form>
                </div>
            @endif

            {{-- conferma restore --}}
            @if (session('restore_success'))
                @php $technology = session('restore_success') @endphp
                <div class="alert alert-success">
                    "{{ $technology->name }}" Restored
                </div>
            @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">N. Post</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technologies as $technology)
                    <tr>
                        <th scope="row">{{ $technology->id }}</th>
                        <td>{{ $technology->name }}</td>
                        <td>{{ count($technology->posts) }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.technologies.show', ['technology' => $technology->id]) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('admin.technologies.edit', ['technology' => $technology->id]) }}">Edit</a>
                            <!-- Button soft delete -->
                            <form
                                action="{{ route('admin.technologies.destroy', ['technology' => $technology->id]) }}"
                                method="POST"
                                class="d-inline-block"
                            >
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginator --}}
        <div class="paginator">
            {{ $technologies->links() }}
        </div>

        {{-- other buttons --}}
        <div>
            {{-- Add New technology --}}
            <a class="btn btn-primary" href="{{ route('admin.technologies.create') }}">Add new Technology</a>

            {{-- Trash Can --}}
            <a class="btn btn-warning" href="{{ route('admin.technologies.trashed') }}">
                Trash Can
                <i class="bi bi-trash3"></i>
            </a>
        </div>

    </div>

@endsection