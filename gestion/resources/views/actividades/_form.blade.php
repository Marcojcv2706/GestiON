@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-3">
    <label for="name" class="form-label">Nombre de la Actividad</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $actividad->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="sub_espacio_id" class="form-label">Sub-espacio</label>
    <select class="form-select" id="sub_espacio_id" name="sub_espacio_id" required>
        <option value="">Seleccione un sub-espacio...</option>
        @foreach($subEspacios as $subEspacio)
            <option value="{{ $subEspacio->id }}" @selected(old('sub_espacio_id', $actividad->sub_espacio_id ?? '') == $subEspacio->id)>
                {{ $subEspacio->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Descripción (Opcional)</label>
    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $actividad->description ?? '') }}</textarea>
</div>

<a href="{{ route('actividades.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-primary">
    {{ isset($actividad) ? 'Actualizar Actividad' : 'Crear Actividad' }}
</button>