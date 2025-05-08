<!-- resources/views/penilaian/pyd.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penilaian Saya') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Tempoh Penilaian') }}</th>
                            <th>{{ __('PPP') }}</th>
                            <th>{{ __('PPK') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Markah Purata') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaian as $pen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pen->tempohPenilaian->nama_tempoh }}</td>
                            <td>{{ $pen->ppp->name }}</td>
                            <td>{{ $pen->ppk ? $pen->ppk->name : '-' }}</td>
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
                                @if($pen->markah_purata)
                                    {{ $pen->markah_purata }}%
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penilaian.show', $pen->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($pen->status === 'draf')
                                    <a href="{{ route('penilaian.edit', $pen->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
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