<!-- resources/views/penilaian/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Senarai Penilaian') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Tambah Penilaian') }}
                </a>
            </div>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('PYD') }}</th>
                            <th>{{ __('PPP') }}</th>
                            <th>{{ __('PPK') }}</th>
                            <th>{{ __('Tempoh Penilaian') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaian as $pen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pen->pyd->name }}</td>
                            <td>{{ $pen->ppp->name }}</td>
                            <td>{{ $pen->ppk ? $pen->ppk->name : '-' }}</td>
                            <td>{{ $pen->tempohPenilaian->nama_tempoh }}</td>
                            <td>
                                @if($pen->status === 'draf')
                                    <span class="badge bg-secondary">{{ __('Draf') }}</span>
                                @elseif($pen->status === 'penilaian_ppp')
                                    <span class="badge bg-warning text-dark">{{ __('Penilaian PPP') }}</span>
                                @elseif($pen->status === 'penilaian_ppk')
                                    <span class="badge bg-info">{{ __('Penilaian PPK') }}</span>
                                @else
                                    <span class="badge bg-success">{{ __('Selesai') }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penilaian.show', $pen->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                                    <a href="{{ route('penilaian.edit', $pen->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('penilaian.destroy', $pen->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Adakah anda pasti?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('laporan.penilaian', $pen->id) }}" class="btn btn-sm btn-secondary" target="_blank">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>