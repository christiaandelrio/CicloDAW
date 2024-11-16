@extends('layouts.app')

@section('title', 'Editar Gasto')

@section('content')
<div class="contenedor-formulario">
<div class="formulario">
    <h2>Editar Gasto</h2>
            <form action="{{ route('gastos.update', $gasto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="formulario-grupo">
                    <label class="formulario-label" for="nombre_gasto">Nombre del Gasto</label>
                    <input type="text" name="nombre_gasto" class="formulario-input" value="{{ $gasto->nombre_gasto }}" required>
                </div>

                <div class="formulario-grupo">
                    <label class="formulario-label" class="formulario-label"for="tipo">Tipo</label>
                    <input type="text" name="tipo" class="formulario-input" value="{{ $gasto->tipo }}" required>
                </div>

                <div class="formulario-grupo">
                    <label class="formulario-label" for="valor">Valor</label>
                    <input type="number" name="valor" class="formulario-input" value="{{ $gasto->valor }}" required>
                </div>

                <div class="formulario-grupo">
                    <label class="formulario-label" for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="formulario-input" value="{{ $gasto->fecha }}" required>
                </div>

                <div class="formulario-grupo">
                    <label class="formulario-label" for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="formulario-input">{{ $gasto->descripcion }}</textarea>
                </div>

                <div class="formulario-grupo">
                    <label class="formulario-label" for="categoria">Categoría</label>
                    <select name="categoria" class="formulario-select">
                        @foreach ($categorias as $categoria => $icono)
                            <option value="{{ $categoria }}" {{ $gasto->categoria == $categoria ? 'selected' : '' }}>
                                {{ ucfirst($categoria) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="boton-enviar">Actualizar Gasto</button>
            </form>
    </div>
</div>
@endsection


