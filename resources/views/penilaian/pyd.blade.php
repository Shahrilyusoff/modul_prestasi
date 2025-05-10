<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penilaian Saya') }}
        </h2>
    </x-slot>

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
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
                        @forelse($penilaian as $pen)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pen->tempohPenilaian->nama_tempoh ?? '-' }}</td>
                            <td>{{ $pen->ppp->name ?? '-' }}</td>
                            <td>{{ $pen->ppk->name ?? '-' }}</td>
                            <td>
                                @switch($pen->status)
                                    @case('draf')
                                        <span class="badge bg-secondary">Draf</span>
                                        @break
                                    @case('penilaian_ppp')
                                        <span class="badge bg-warning text-dark">Penilaian PPP</span>
                                        @break
                                    @case('penilaian_ppk')
                                        <span class="badge bg-info text-dark">Penilaian PPK</span>
                                        @break
                                    @case('selesai')
                                        <span class="badge bg-success">Selesai</span>
                                        @break
                                    @default
                                        <span class="badge bg-light text-dark">-</span>
                                @endswitch
                            </td>
                            <td>{{ $pen->markah_purata ? $pen->markah_purata . '%' : '-' }}</td>
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
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Tiada rekod penilaian.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
