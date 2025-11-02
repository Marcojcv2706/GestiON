@extends('layouts.auth')

@section('contenido')
    <form action="{{ route('login.store') }}" method="POST" class="bg-white p-4">
        @csrf

        <div class="flex flex-col mb-6">
            <label for="email" class="mb-2">Email:</label>
            <input type="email" name="email" id="email" class="border">
            @error('email')
                <p>
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex flex-col mb-6">
            <label for="password" class="mb-2">Password:</label>
            <input type="password" name="password" id="password" class="border">
        </div>

        <div>
            <button type="submit" class="p-4 rounded border border-black">Login</button>
        </div>
    </form>
@endsection