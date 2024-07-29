@extends('layouts.main')
@section('container')

<div class="flex-row w-1/2 mx-auto bg-white p-5 rounded-lg">
    <x-page-header>{{ $title }}</x-page-header>
</div>
<div class="flex-row w-1/2 mx-auto bg-white p-5 rounded-lg mt-5">
    <form action="{{ route('user.authenticate') }}" method="post">
        @csrf
        <div>
            <x-text-input name="username" id="username" value="{{ old('username', $user->username ?? '') }}" :required="true" :readonly="$readonly">Username</x-text-input>
        </div>
        <div class="mt-5">
            <x-password-input name="password" id="password" value="" :required="true" :readonly="$readonly">Password</x-text-input>
        </div>
        <div class="mt-6 flex items-center justify-center gap-x-6">
            <x-blue-submit-button>Login</x-blue-submit-button>
        </div>
    </form>
</div>
@endsection