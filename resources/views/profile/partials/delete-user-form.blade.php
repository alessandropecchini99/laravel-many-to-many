<section class="space-y-6">
    <header>
        <h2>
            Delete Account
        </h2>

        <p>
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
    </header>

    <form method="post" action="{{ route('admin.profile.destroy') }}">
        @csrf
        @method('delete')

        <div>
            <label for="password_delete">Password</label>
            <input id="password_delete" name="password" type="password">
            @error('password')
                {{ $message }}
            @enderror
        </div>

        <button class="btn btn-danger">Delete Account</button>
    </form>
</section>