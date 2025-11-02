{{-- Muestra errores de validación si existen --}}
@if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Campo Nombre --}}
<div class="mb-3">
    <label for="name" class="form-label">Nombre del Recurso</label>
    <input type="text" 
           class="form-control @error('name') is-invalid @enderror" 
           id="name" 
           name="name" 
           value="{{ old('name', $recurso->name ?? '') }}" 
           required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

{{-- Botones de Acción --}}
<a href="{{ route('admin.recursos.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-primary">
    {{ isset($recurso) ? 'Actualizar Recurso' : 'Crear Recurso' }}
</button>