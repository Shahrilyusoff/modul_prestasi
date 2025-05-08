<!-- resources/views/tempoh-penilaian/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tempoh Penilaian') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('tempoh-penilaian.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Tambah Tempoh') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Nama Tempoh') }}</th>
                            <th>{{ __('Tarikh Mula') }}</th>
                            <th>{{ __('Tarikh Tamat') }}</th>
                            <th>{{ __('Jenis') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tempohPenilaian as $tempoh)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tempoh->nama_tempoh }}</td>
                            <td>{{ $tempoh->tarikh_mula->format('d/m/Y') }}</td>
                            <td>{{ $tempoh->tarikh_tamat->format('d/m/Y') }}</td>
                            <td>{{ __(ucfirst(str_replace('_', ' ', $tempoh->jenis))) }}</td>
                            <td>
                                @if($tempoh->aktif)
                                    <span class="badge bg-success">{{ __('Aktif') }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ __('Tidak Aktif') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tempoh-penilaian.edit', $tempoh->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('tempoh-penilaian.destroy', $tempoh->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Adakah anda pasti?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @if(!$tempoh->aktif)
                                    <form action="{{ route('tempoh-penilaian.aktifkan', $tempoh->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> {{ __('Aktifkan') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>