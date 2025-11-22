@extends('layouts.admin-layout')

@section('title', 'Edit Pengguna')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow rounded-lg p-6">

    <h1 class="text-2xl font-semibold text-gray-800 mb-4 font-fredoka">
        Edit Pengguna
    </h1>

    @if ($errors->any())
        <div class="mb-4 bg-red-50 text-red-700 text-sm px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Role ID</label>
            <input type="number" name="role_id"
                   value="{{ old('role_id', $user->role_id) }}"
                   class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            {{-- nanti bisa diganti select role kalau sudah ada tabel roles --}}
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('admin.users.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                Batal
            </a>
            <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
