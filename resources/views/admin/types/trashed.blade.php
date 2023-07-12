@extends('admin.layouts.base')

@section('title', 'Trashed')

@section('main') 

    <div class="trashed container">

        @if (count($trashedTypes) === 0)
            <h1>Nothing Deleted</h1>
        @else

            <h1>OUR DELETED TYPES</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
            <tbody>
                @foreach($trashedTypes as $type)
                    <tr>
                        <th scope="row">{{ $type->id }}</th>
                        <td>{{ $type->name }}</td>
                            <td>
                                <form
                                    action="{{ route("admin.types.restore", ['type' => $type]) }}"
                                    method="post"
                                    class="d-inline-block"
                                >
                                    @csrf
                                    <button class="btn btn-success">Restore</button>
                                </form>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger myModal" data-bs-toggle="modal" data-bs-target="#myInput" data-id="{{ $type->id }}">
                                    <i class="bi bi-trash3"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif

        {{-- Paginator --}}
        <div class="paginator">
            {{ $trashedTypes->links() }}
        </div>

        <a class="btn btn-secondary" href="{{ route('admin.types.index') }}">Back</a>

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
                            action="{{ route("admin.types.harddelete", ['type' => '***']) }}"
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