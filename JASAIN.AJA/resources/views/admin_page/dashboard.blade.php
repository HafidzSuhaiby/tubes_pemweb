@extends('layouts.admin-layout')
@section('title', 'Dashboard')

@section('content')
    <div class="h-auto font-fredoka">
        <div class="grid grid-cols-4 gap-4">
            <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-blue-500 shadow-sm rounded">
                <div class="grid grid-cols-1 col-span-3">
                    <label class="text-md font-light">Total Pengguna</label>
                    <span class="text-2xl font-medium">{{ $userCount }}</span>
                </div>
                <div class="text-3xl self-center">
                    <i class="fa-regular fa-user" aria-hidden="true"></i>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-red-500 shadow-sm rounded">
                <div class="grid grid-cols-1 col-span-3">
                    <label class="text-md font-light">Total Jasa</label>
                    <span class="text-2xl font-medium">{{ $petCount ?? 0 }}</span>
                </div>
                <div class="text-3xl self-center">
                    <i class="fa fa-shield-cat" aria-hidden="true"></i>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-green-500 shadow-sm rounded">
                <div class="grid grid-cols-1 col-span-3">
                    <label class="text-md font-light">Total Pesanan</label>
                    <span class="text-2xl font-medium">{{ $adoptionCount ?? 0 }}</span>
                </div>
                <div class="text-3xl self-center">
                    <i class="fa fa-paw" aria-hidden="true"></i>
                </div>
            </div>
            <div class="grid grid-cols-4 gap-1 w-auto p-4 text-white bg-yellow-500 shadow-sm rounded">
                <div class="grid grid-cols-1 col-span-3">
                    <label class="text-md font-light">Total Laporan</label>
                    <span class="text-2xl font-medium">{{ $reportCount ?? 0 }}</span>
                </div>
                <div class="text-3xl self-center">
                    <i class="fa-regular fa-file-lines" aria-hidden="true"></i>
                </div>
            </div>
        </div>

        {{-- Tabel bisa dikosongkan dulu atau pakai @if(count($adoptions)) --}}
    </div>
@endsection
