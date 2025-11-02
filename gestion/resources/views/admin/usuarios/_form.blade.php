{{-- Nombre --}}
<div class="mb-3">
    <label for="name" class="form-label">Nombre Completo</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $usuario->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Email --}}
<div class="mb-3">
    <label for="email" class="form-label">Correo Electrónico</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $usuario->email ?? '') }}" required>
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Rol --}}
<div class="mb-3">
    <label for="role_id" class="form-label">Rol</label>
    <select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required>
        <option value="">Seleccione un rol...</option>
        @foreach($roles as $rol)
            <option value="{{ $rol->id }}" {{ (old('role_id', $usuario->role_id ?? '') == $rol->id) ? 'selected' : '' }}>
                {{ $rol->name }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<hr>

{{-- Contraseña --}}
<div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" {{ isset($usuario) ? '' : 'required' }}>
    @if(isset($usuario))
        <small class="form-text text-muted">Dejar en blanco para no cambiar la contraseña.</small>
    @endif
    @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Confirmar Contraseña --}}
<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
</div>

{{-- Botones de Acción --}}
<a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-primary">
    {{ isset($usuario) ? 'Actualizar Usuario' : 'Crear Usuario' }}
</button>   