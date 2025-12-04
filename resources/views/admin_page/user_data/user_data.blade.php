@extends('layouts.admin-layout')

@section('title', 'Data Pengguna')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold text-gray-800 font-fredoka">
            Data Pengguna
        </h1>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-2 rounded-lg bg-green-100 text-green-700 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 px-4 py-2 rounded-lg bg-red-100 text-red-700 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">#</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Nama</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Email</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Role</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">Dibuat</th>
                    <th class="px-4 py-3 text-right font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 bg-white">
                @forelse ($users as $index => $user)
                    <tr>
                        <td class="px-4 py-3">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td class="px-4 py-3">
                            <span class="font-medium text-gray-800">
                                {{ $user->name }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-gray-700">
                            {{ $user->email }}
                        </td>

                        <td class="px-4 py-3 text-gray-700">
                            {{ optional($user->role)->nama_role ?? '–' }}
                        </td>

                        <td class="px-4 py-3 text-gray-500">
                            {{ $user->created_at?->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex justify-end space-x-2">

                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="px-3 py-1 text-xs bg-yellow-400 text-white rounded-lg
                                          hover:bg-yellow-500 flex items-center space-x-1">
                                    <i class="fa-solid fa-pen-to-square fa-sm"></i>
                                    <span>Edit</span>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 text-xs bg-red-500 text-white rounded-lg
                                                   hover:bg-red-600 flex items-center space-x-1">
                                        <i class="fa-solid fa-trash fa-sm"></i>
                                        <span>Hapus</span>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="px-4 py-4 text-center text-gray-500" colspan="6">
                            Belum ada data pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
