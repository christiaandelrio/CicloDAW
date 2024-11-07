@extends('layouts.app')

@section('title', 'Gastos Compartidos')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Gastos Compartidos</h2>

    @if($gastosCompartidos->isEmpty())
        <p>No hay gastos compartidos para mostrar.</p>
    @else
        @foreach($gastosCompartidos as $nombreUsuario => $gastos)
            <div class="user-shared-table mt-4">
                <h3>Gastos compartidos con {{ $nombreUsuario }}</h3>
                <table class="table table-hover mt-3">
                    <thead>
                        <tr>
                            <th>Nombre del Gasto</th>
                            <th>Tipo</th>
                            <th>Valor</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Pagado por</th>
                            <th>Porcentaje de Pago</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gastos as $gastoCompartido)
                            <tr>
                                <td>{{ $gastoCompartido->gasto->nombre_gasto }}</td>
                                <td>{{ $gastoCompartido->gasto->tipo }}</td>
                                <td>{{ $gastoCompartido->gasto->valor }} €</td>
                                <td>{{ $gastoCompartido->gasto->fecha }}</td>
                                <td>{{ $gastoCompartido->gasto->descripcion }}</td>
                                <td>{{ $gastoCompartido->gasto->user->name }}</td>
                                <td>{{ $gastoCompartido->porcentaje }}%</td>
                                <td>
                                    <form action="{{ route('gastos.destroy', $gastoCompartido->gasto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este gasto compartido?');">
                                            <i class="fa fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach
    @endif
</div>
@endsection




