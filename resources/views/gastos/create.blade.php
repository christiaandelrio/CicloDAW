@extends('layouts.app')

@section('title', 'Crear Nuevo Gasto')

@section('content')
<div class="py-4">
    <div class="card shadow-sm" style="background-color: #FFFFFF; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); margin: 0 auto; max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title" style="color: #3B4013; text-align: center;">Crear Nuevo Gasto</h2>
            <form action="{{ route('gastos.store') }}" method="POST" style="display: flex; flex-direction: column;">
                @csrf
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="nombre_gasto" style="color: #0D0D0D;">Nombre del Gasto</label>
                    <input type="text" id="nombre_gasto" name="nombre_gasto" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="tipo" style="color: #0D0D0D;">Tipo de Gasto</label>
                    <input type="text" id="tipo" name="tipo" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="valor" style="color: #0D0D0D;">Valor (€)</label>
                    <input type="number" step="0.01" id="valor" name="valor" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="fecha" style="color: #0D0D0D;">Fecha</label>
                    <input type="date" id="fecha" name="fecha" required class="form-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="descripcion" style="color: #0D0D0D;">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="form-input" style="width: 100%; padding: 10px; border: 1px solid #BFD1C9; border-radius: 5px; background-color: #F2EFDF;"></textarea>
                </div>
                <button type="submit" class="btn-submit" style="background-color: #4CAF50; color: #FFFFFF; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%; transition: background-color 0.3s;">Guardar Gasto</button>
            </form>
        </div>
    </div>
</div>
@endsection




