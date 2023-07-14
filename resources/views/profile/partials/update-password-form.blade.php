<section>
    <header>
        <h2>
            Update Password
        </h2>

        <p>
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div>
            <label for="current_password">Current Password</label>
            <input id="current_password" name="current_password" type="password">
            @error('current_password')
                {{ $message }}
            @enderror
        </div>

        <div>
            <label for="password">New Password</label>
            <input id="password" name="password" type="password">
            @error('password')
                {{ $message }}
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password">
            @error('password_confirmation')
                {{ $message }}
            @enderror
        </div>


        <div class="flex items-center gap-4">
            <button>Save</button>

            @if (session('status') === 'password-updated')
                <p>Saved.</p>
            @endif
        </div>
    </form>
</section>