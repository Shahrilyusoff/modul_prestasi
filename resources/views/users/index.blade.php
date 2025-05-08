<!-- resources/views/users/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengurusan Pengguna') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('Tambah Pengguna') }}
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('Nama') }}</th>
                            <th>{{ __('Emel') }}</th>
                            <th>{{ __('Jawatan') }}</th>
                            <th>{{ __('Jabatan') }}</th>
                            <th>{{ __('Peranan') }}</th>
                            <th>{{ __('Tindakan') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->jawatan }}</td>
                            <td>{{ $user->jabatan }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ __(ucfirst($user->role)) }}</span>
                                @if($user->jenis)
                                    <span class="badge bg-info">{{ __(ucfirst(str_replace('_', ' ', $user->jenis))) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Adakah anda pasti?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>