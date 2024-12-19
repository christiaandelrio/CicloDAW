@extends('layouts.app')

@section('title', 'Crear Nuevo Gasto')

@section('content')
<div class="contenedor-create">
    <h2>Crear Nuevo Gasto</h2>
    <div class="formulario">
        <form action="{{ route('gastos.store') }}" method="POST">
            @csrf
            <div class="formulario-grupo">
                <label for="nombre_gasto" class="formulario-label">Nombre del Gasto</label>
                <input type="text" id="nombre_gasto" name="nombre_gasto" required class="formulario-input">
            </div>
            <div class="formulario-grupo">
                <label for="tipo" class="formulario-label">Tipo de Gasto</label>
                <input type="text" id="tipo" name="tipo" required class="formulario-input">
            </div>
            <div class="formulario-grupo">
                <label for="valor" class="formulario-label">Valor (€)</label>
                <input type="number" step="0.01" id="valor" name="valor" required class="formulario-input">
            </div>
            <div class="formulario-grupo">
                <label for="fecha" class="formulario-label">Fecha</label>
                <input type="date" id="fecha" name="fecha" required class="formulario-input">
            </div>
            <div class="formulario-grupo">
                <label for="descripcion" class="formulario-label">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4" class="formulario-input"></textarea>
            </div>
            <div class="formulario-grupo">
                <label for="categoria" class="formulario-label">Categoría</label>
                <select id="categoria" name="categoria" required class="formulario-select">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria => $icono)
                        <option value="{{ $categoria }}">{{ ucfirst($categoria) }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Checkbox para gasto compartido -->
            <div class="formulario-grupo">
                <label>
                    <input type="checkbox" id="es_compartido" name="es_compartido"> Este gasto es compartido
                </label>
            </div>

            <!-- Selección de usuarios con los que se comparte el gasto -->
            <div class="formulario-grupo" id="usuarios_compartidos" style="display:none;">
                <label for="shared_with">Compartido con:</label>
                <div id="usuarios_porcentajes">
                    @foreach ($usuarios as $usuario)
                        <div class="usuario-porcentaje">
                            <label>
                                <input type="checkbox" name="shared_with[]" value="{{ $usuario->id }}">
                                {{ $usuario->name }}
                            </label>
                            <input type="number" name="porcentajes[{{ $usuario->id }}]" placeholder="%" min="0" max="100" class="input-porcentaje">
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="boton-enviar">Guardar Gasto</button>
        </form>
    </div>
</div>

<script>
    // Muestra/oculta el selector de usuarios compartidos según el estado del checkbox
    document.getElementById('es_compartido').addEventListener('change', function() {
        document.getElementById('usuarios_compartidos').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection





