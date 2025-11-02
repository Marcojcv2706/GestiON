<div class="mb-3">
    <label for="name" class="form-label">Nombre del Espacio</label>
    <input type="text" class="form-control" id="name" name="name" 
            value="{{ old('name', $espacio->name ?? '') }}" required>
</div>

<a href="{{ route('admin.espacios.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-primary">
    {{ isset($espacio) ? 'Actualizar' : 'Guardar' }}
</button>