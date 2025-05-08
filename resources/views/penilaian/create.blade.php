<!-- resources/views/penilaian/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penilaian') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tempoh_penilaian_id" class="form-label">{{ __('Tempoh Penilaian') }}</label>
                                <select class="form-select" id="tempoh_penilaian_id" name="tempoh_penilaian_id" required>
                                    <option value="">{{ __('Pilih Tempoh Penilaian') }}</option>
                                    @foreach($tempohPenilaian as $tempoh)
                                    <option value="{{ $tempoh->id }}">
                                        {{ $tempoh->nama_tempoh }} ({{ $tempoh->tarikh_mula->format('d/m/Y') }} - {{ $tempoh->tarikh_tamat->format('d/m/Y') }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="pyd_id" class="form-label">{{ __('PYD') }}</label>
                                <select class="form-select" id="pyd_id" name="pyd_id" required>
                                    <option value="">{{ __('Pilih PYD') }}</option>
                                    @foreach($pydOptions as $pyd)
                                    <option value="{{ $pyd->id }}">
                                        {{ $pyd->name }} ({{ $pyd->jawatan }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="ppp_id" class="form-label">{{ __('PPP') }}</label>
                                <select class="form-select" id="ppp_id" name="ppp_id" required>
                                    <option value="">{{ __('Pilih PPP') }}</option>
                                    @foreach($pppOptions as $ppp)
                                    <option value="{{ $ppp->id }}">
                                        {{ $ppp->name }} ({{ $ppp->jawatan }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="ppk_id" class="form-label">{{ __('PPK') }}</label>
                                <select class="form-select" id="ppk_id" name="ppk_id">
                                    <option value="">{{ __('Pilih PPK') }}</option>
                                    @foreach($ppkOptions as $ppk)
                                    <option value="{{ $ppk->id }}">
                                        {{ $ppk->name }} ({{ $ppk->jawatan }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> {{ __('Kembali') }}
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ __('Simpan') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>