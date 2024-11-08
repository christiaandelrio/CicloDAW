@extends('layouts.app')

@section('title', 'Crear Nuevo Gasto')

@section('content')
<div class="py-4">
    <div class="formulario">
        <div class="card-body">
            <h2 class="card-title">Crear Nuevo Gasto</h2>
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
                    <label for="valor"class="formulario-label">Valor (€)</label>
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
                    <select id="categoria" name="categoria" required class="formulario-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;">
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categorias as $categoria => $icono)
                            <option value="{{ $categoria }}">{{ ucfirst($categoria) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Checkbox para gasto compartido -->
                <div class="form-group" style="margin-bottom: 15px;">
                    <label>
                        <input type="checkbox" class="formulario-input" id="es_compartido" name="es_compartido"> Este gasto es compartido
                    </label>
                </div>

                <!-- Selección de usuarios con los que se comparte el gasto -->
                <div id="usuarios_compartidos" style="display:none;">
                    <label for="shared_with" style="color: #0D0D0D;">Compartido con:</label>
                    <select id="shared_with" name="shared_with[]" multiple class="form-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;">
                        <!-- Aquí puedes cargar los usuarios desde la base de datos -->
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="boton-enviar">Guardar Gasto</button>
            </form>
        </div>
    </div>
</div>

<script>
    // Muestra/oculta el selector de usuarios compartidos según el estado del checkbox
    document.getElementById('es_compartido').addEventListener('change', function() {
        document.getElementById('usuarios_compartidos').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endsection






