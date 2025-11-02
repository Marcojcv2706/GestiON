{{-- ====================================================================== --}}
{{-- 1. MUESTRA ERRORES DE VALIDACIÓN: Esta sección es clave. --}}
{{-- ====================================================================== --}}
@if ($errors->any())
    <div class="alert alert-danger mb-4">
        <p class="fw-bold">¡Ups! Hubo algunos problemas con tu entrada:</p>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- ====================================================================== --}}
{{-- 2. EL FORMULARIO: Tu código, pero completo y consistente. --}}
{{-- ====================================================================== --}}
<div class="mb-3">
    <label for="description" class="form-label">Descripción Breve</label>
    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $turno->description ?? '') }}" required>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="start_time" class="form-label">Fecha y Hora de Inicio</label>
        <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ old('start_time', isset($turno) ? $turno->start_time->format('Y-m-d\TH:i') : '') }}" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="end_time" class="form-label">Fecha y Hora de Fin</label>
        <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ old('end_time', isset($turno) ? $turno->end_time->format('Y-m-d\TH:i') : '') }}" required>
    </div>
</div>

<hr>

<div class="mb-3">
    <label for="actividad_id" class="form-label">Actividad</label>
    <select class="form-select" id="actividad_id" name="actividad_id" required>
        <option value="">Seleccione una actividad...</option>
        @foreach($actividades as $actividad)
            <option value="{{ $actividad->id }}" {{ (old('actividad_id', $turno->actividad_id ?? '') == $actividad->id) ? 'selected' : '' }}>
                {{ $actividad->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="sub_espacio_id" class="form-label">Sub-espacio</label>
    <select class="form-select" id="sub_espacio_id" name="sub_espacio_id" required>
        <option value="">Seleccione un sub-espacio...</option>
        @foreach($subEspacios as $subEspacio)
            <option value="{{ $subEspacio->id }}" {{ (old('sub_espacio_id', $turno->sub_espacio_id ?? '') == $subEspacio->id) ? 'selected' : '' }}>
                {{ $subEspacio->name }} ({{ $subEspacio->espacio->name }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="recurso_id" class="form-label">Recurso Adicional (Opcional)</label>
    <select class="form-select" id="recurso_id" name="recurso_id">
        <option value="">Ninguno</option>
        @foreach($recursos as $recurso)
            <option value="{{ $recurso->id }}" {{ (old('recurso_id', $turno->recurso_id ?? '') == $recurso->id) ? 'selected' : '' }}>
                {{ $recurso->name }}
            </option>
        @endforeach
    </select>
</div>


<a href="{{ route('turnos.index') }}" class="btn btn-secondary">Cancelar</a>
<button type="submit" class="btn btn-primary">
    {{ isset($turno) ? 'Actualizar Turno' : 'Crear Turno' }}
</button>

{{-- ====================================================================== --}}
{{-- 3. EL SCRIPT: Evita que el usuario seleccione fechas pasadas. --}}
{{-- ====================================================================== --}}
@if (!isset($turno))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        const formattedDateTime = now.toISOString().slice(0, 16);
        const startTimeInput = document.getElementById('start_time');
        if (startTimeInput) {
            startTimeInput.setAttribute('min', formattedDateTime);
        }
    });
</script>
@endif