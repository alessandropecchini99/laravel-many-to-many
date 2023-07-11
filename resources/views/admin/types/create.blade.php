@extends('admin.layouts.base')

@section('title', 'Create')

@section('main') 

    <div class="create container">

        <h1>Add a Type!</h1>
    
        <form 
            class="create-form"
            method="POST"
            action="{{ route('admin.types.store') }}"
        >
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    type="text" 
                    class="form-control 
                    @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}"
                >
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea 
                    class="form-control 
                    @error('description') is-invalid @enderror" 
                    id="description" 
                    rows="3" 
                    name="description"
                >{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>  
                @enderror
            </div>

            

            <div class="create-button">
                <a class="btn btn-secondary" href="/admin/types">Back</a>
                <button type="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>

    </div>

@endsection