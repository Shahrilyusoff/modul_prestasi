<!-- resources/views/users/form.blade.php -->

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nama') }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Emel') }}</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email ?? '') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="jawatan" class="form-label">{{ __('Jawatan') }}</label>
            <input type="text" class="form-control @error('jawatan') is-invalid @enderror" id="jawatan" name="jawatan" value="{{ old('jawatan', $user->jawatan ?? '') }}">
            @error('jawatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="gred" class="form-label">{{ __('Gred') }}</label>
            <input type="text" class="form-control @error('gred') is-invalid @enderror" id="gred" name="gred" value="{{ old('gred', $user->gred ?? '') }}">
            @error('gred')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="jabatan" class="form-label">{{ __('Jabatan') }}</label>
            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $user->jabatan ?? '') }}">
            @error('jabatan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="no_kp" class="form-label">{{ __('No. Kad Pengenalan') }}</label>
            <input type="text" class="form-control @error('no_kp') is-invalid @enderror" id="no_kp" name="no_kp" value="{{ old('no_kp', $user->no_kp ?? '') }}">
            @error('no_kp')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="role" class="form-label">{{ __('Peranan') }}</label>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                <option value="">{{ __('Pilih Peranan') }}</option>
                <option value="superadmin" {{ old('role', $user->role ?? '') == 'superadmin' ? 'selected' : '' }}>{{ __('Superadmin') }}</option>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                <option value="ppp" {{ old('role', $user->role ?? '') == 'ppp' ? 'selected' : '' }}>{{ __('PPP') }}</option>
                <option value="ppk" {{ old('role', $user->role ?? '') == 'ppk' ? 'selected' : '' }}>{{ __('PPK') }}</option>
                <option value="pyd" {{ old('role', $user->role ?? '') == 'pyd' ? 'selected' : '' }}>{{ __('PYD') }}</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="jenis" class="form-label">{{ __('Jenis PYD') }}</label>
            <select class="form-select @error('jenis') is-invalid @enderror" id="jenis" name="jenis">
                <option value="">{{ __('Pilih Jenis') }}</option>
                <option value="pengurusan" {{ old('jenis', $user->jenis ?? '') == 'pengurusan' ? 'selected' : '' }}>{{ __('Pengurusan') }}</option>
                <option value="sokongan_i" {{ old('jenis', $user->jenis ?? '') == 'sokongan_i' ? 'selected' : '' }}>{{ __('Sokongan I') }}</option>
                <option value="sokongan_ii" {{ old('jenis', $user->jenis ?? '') == 'sokongan_ii' ? 'selected' : '' }}>{{ __('Sokongan II') }}</option>
            </select>
            @error('jenis')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

@if(!isset($user) || !$user->id)
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Kata Laluan') }}</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Sahkan Kata Laluan') }}</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
    </div>
</div>
@endif

<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
</div>