@extends('admin.layouts.base')

@section('title', 'Index')

@section('main') 

    <div class="index container">
    
        <h1>TECHNOLOGIES</h1>

            {{-- conferma delete --}}
            @if (session('delete_success'))
                @php $technology = session('delete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $technology->name }}" Permanently Deleted
                </div>
            @endif

            {{-- conferma delete --}}
            {{-- @if (session('softdelete_success'))
                @php $technology = session('softdelete_success') @endphp
                <div class="alert alert-danger m-0 mb-3">
                    "{{ $technology->title }}" Soft Deleted
                    <form
                        action="{{ route("admin.technologies.restore", ['technology' => $technology]) }}"
                        method="technology"
                        class="d-inline-block restore-btn"
                    >
                        @csrf
                        <button class="btn btn-warning">Restore</button>
                    </form>
                </div>
            @endif --}}

            {{-- conferma restore --}}
            {{-- @if (session('restore_success'))
                @php $technology = session('restore_success') @endphp
                <div class="alert alert-success">
                    "{{ $technology->title }}" Restored
                </div>
            @endif --}}

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
                            <!-- Button trigger modal -->
                            <button 
                                type="button" class="btn btn-danger myModal" data-bs-toggle="modal" data-bs-target="#myInput" 
                                data-id="{{ $technology->id }}"
                            >
                                Delete
                            </button>
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
            {{-- <a class="btn btn-warning" href="{{ route('admin.technologies.trashed') }}">
                Trash Can
                <i class="bi bi-trash3"></i>
            </a> --}}
        </div>

        <!-- Modal -->
        <div class="modal fade w-100" id="myInput" tabindex="-1" aria-labelledby="myInput" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Are you sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        This will permanently delete it!
                    </div>
                    <div class="modal-footer">
                    
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>

                        <form
                            action="{{ route("admin.technologies.destroy", ['technology' => '***']) }}"
                            {{-- action="http://localhost:8000/admin/technologies/0/destroy" --}}
                            method="POST"
                            class="d-inline-block"
                            id="myForm"
                        >
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection