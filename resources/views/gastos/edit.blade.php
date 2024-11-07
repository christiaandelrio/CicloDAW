@extends('layouts.app')

@section('title', 'Editar Gasto')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h2>Editar Gasto</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('gastos.update', $gasto->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre_gasto">Nombre del Gasto</label>
                    <input type="text" name="nombre_gasto" class="form-control" value="{{ $gasto->nombre_gasto }}" required>
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" name="tipo" class="form-control" value="{{ $gasto->tipo }}" required>
                </div>

                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="number" name="valor" class="form-control" value="{{ $gasto->valor }}" required>
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="{{ $gasto->fecha }}" required>
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ $gasto->descripcion }}</textarea>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" class="form-control">
                        @foreach ($categorias as $categoria => $icono)
                            <option value="{{ $categoria }}" {{ $gasto->categoria == $categoria ? 'selected' : '' }}>
                                {{ ucfirst($categoria) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Gasto</button>
            </form>
        </div>
    </div>
</div>
@endsection

