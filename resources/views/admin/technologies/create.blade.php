@extends('admin.layouts.base')

@section('title', 'Create')

@section('main') 

    <div class="create container">

        <h1>Add Technologies!</h1>
    
        <form 
            class="create-form"
            method="POST"
            action="{{ route('admin.technologies.store') }}"
        >
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input 
                    technology="text" 
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

            

            <div class="create-button">
                <a class="btn btn-secondary" href="/admin/technologies">Back</a>
                <button technology="reset" class="btn btn-warning">Reset</button>
                <button class="btn btn-primary">Submit</button>
            </div>

        </form>

    </div>

@endsection