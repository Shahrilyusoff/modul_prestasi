<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kemaskini Penilaian') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                @include('penilaian.form')
            </div>
        </div>
    </div>
</x-app-layout>