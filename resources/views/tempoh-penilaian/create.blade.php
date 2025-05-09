<!-- resources/views/tempoh-penilaian/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Tempoh Penilaian') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('tempoh-penilaian.store') }}" method="POST">
                    @csrf
                    @include('tempoh-penilaian.form')
                </form>
            </div>
        </div>
    </div>
</x-app-layout>