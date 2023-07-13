@extends('admin.layouts.base')

@section('title', 'Index')

@section('main') 

    <div class="index container">
    
        <h1>TYPES</h1>

            {{-- conferma delete --}}
            @if (session('harddelete_success'))
                @php $type = session('harddelete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $type->name }}" Permanently Deleted
                </div>
            @endif

            {{-- conferma delete --}}
            @if (session('softdelete_success'))
                @php $type = session('softdelete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $type->name }}" Soft Deleted
                    <form
                        action="{{ route("admin.types.restore", ['type' => $type]) }}"
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
                @php $type = session('restore_success') @endphp
                <div class="alert alert-success">
                    "{{ $type->name }}" Restored
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
                @foreach($types as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                        <td>{{ count($type->posts) }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.types.show', ['type' => $type]) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('admin.types.edit', ['type' => $type]) }}">Edit</a>
                            <!-- Button soft delete -->
                            <form
                                action="{{ route('admin.types.destroy', ['type' => $type]) }}"
                                method="post"
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
            {{ $types->links() }}
        </div>

        {{-- other buttons --}}
        <div>
            {{-- Add New type --}}
            <a class="btn btn-primary" href="{{ route('admin.types.create') }}">Add new Type</a>

            {{-- Trash Can --}}
            <a class="btn btn-warning" href="{{ route('admin.types.trashed') }}">
                Trash Can
                <i class="bi bi-trash3"></i>
            </a>
        </div>

    </div>

@endsection