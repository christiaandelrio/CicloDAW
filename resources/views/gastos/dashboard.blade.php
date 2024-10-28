@extends('layouts.app')

@section('title', 'Mis Gastos')

@section('content')
<div class="py-4">
    <div class="container card-container" style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
        @if($gastos->isEmpty())
            <div class="card">
                <div class="description">
                    <h2>No tienes gastos registrados.</h2>
                    <p>Agrega un nuevo gasto para empezar a llevar tu control.</p>
                </div>
            </div>
        @else
            <div class="table-wrapper" style="overflow-x: auto; width: 100%; max-width: 1000px;">
                <div class="table-container" style="display: flex; justify-content: center;">
                    <table class="table table-striped table-hover" id="tablaGastos" style="width: 100%; border-collapse: collapse; background-color: #FFFFFF; color: #3B4013; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
                        <thead style="background-color: #4CAF50; color: #FFFFFF;">
                            <tr>
                                <th>Nombre del Gasto</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Acciones</th> <!-- Nueva columna de Acciones -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gastos as $gasto)
                                <tr style="text-align: center; border-bottom: 1px solid #BFD1C9;">
                                    <td>{{ $gasto->nombre_gasto }}</td>
                                    <td>{{ $gasto->tipo }}</td>
                                    <td>{{ $gasto->valor }} €</td>
                                    <td>{{ $gasto->fecha }}</td>
                                    <td>{{ $gasto->descripcion }}</td>
                                    <td>
                                        @php
                                            // Obtiene el icono de la categoría o usa un icono por defecto
                                            $icono = $categorias[$gasto->categoria] ?? 'fas fa-question-circle';
                                        @endphp
                                        <i class="{{ $icono }}" aria-hidden="true"></i>
                                    </td>
                                    <td>
                                    <!-- agregados a un contenedor para alinearlos horizontalmente -->
                                    <div class="btn-container">
                                        <a href="{{ route('gastos.edit', $gasto->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i> Editar
                                        </a>
                                        <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este gasto?');">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection






