@extends('layouts.app')

@section('title', 'Editar Gasto')

@section('content')
<div class="container py-4">
    <div class="shadow-sm" style="background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); margin: 0 auto; max-width: 600px;">
    <div class="card-body">
    <h2 class="card-title" style="color: #3B4013; text-align: center;">Editar Gasto</h2>
            <form action="{{ route('gastos.update', $gasto->id) }}" method="POST" style="display: flex; flex-direction: column;">
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


