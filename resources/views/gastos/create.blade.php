@extends('layouts.app')

@section('title', 'Crear Nuevo Gasto')

@section('content')
<div class="py-4">
    <div class="container card-container">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Crear Nuevo Gasto</h2>
                <form action="{{ route('gastos.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_gasto" class="form-label">Nombre del Gasto</label>
                        <input type="text" class="form-control" id="nombre_gasto" name="nombre_gasto" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Gasto</label>
                        <input type="text" class="form-control" id="tipo" name="tipo" required>
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor (€)</label>
                        <input type="number" step="0.01" class="form-control" id="valor" name="valor" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción (Opcional)</label>
                        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select class="form-select" id="categoria" name="categoria" required>
                            <option value="">Selecciona una categoría</option>
                            <option value="comida">Comida</option>
                            <option value="mascota">Mascota</option>
                            <option value="transporte">Transporte</option>
                            <option value="ropa">Ropa</option>
                            <option value="decoracion">Decoración</option>
                            <!-- Agrega más opciones según sea necesario -->
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Gasto</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


