@extends('layouts.app')

@section('title', 'Mis Gastos')

@section('content')
<div class="py-4">
    <div class="container card-container">
        @if($gastos->isEmpty())
            <div class="card">
                <div class="description">
                    <h2>No tienes gastos registrados.</h2>
                    <p>Agrega un nuevo gasto para empezar a llevar tu control.</p>
                </div>
            </div>
        @else
            <div class="table-wrapper">
                <div class="table-container">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="tablaGastos">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nombre del Gasto</th>
                                    <th>Tipo</th>
                                    <th>Valor</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gastos as $gasto)
                                    <tr>
                                        <td>{{ $gasto->nombre_gasto }}</td>
                                        <td>{{ $gasto->tipo }}</td>
                                        <td>{{ number_format($gasto->valor, 2, ',', '.') }} €</td>
                                        <td>{{ \Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y') }}</td>
                                        <td>{{ $gasto->descripcion ?? 'N/A' }}</td>
                                        <td>
                                            @switch($gasto->categoria)
                                                @case('comida')
                                                    <i class="fas fa-utensils" title="Comida"></i>
                                                    @break
                                                @case('mascota')
                                                    <i class="fas fa-paw" title="Mascota"></i>
                                                    @break
                                                @case('transporte')
                                                    <i class="fas fa-bus" title="Transporte"></i>
                                                    @break
                                                @case('ropa')
                                                    <i class="fas fa-shirt" title="Ropa"></i>
                                                    @break
                                                @case('decoracion')
                                                    <i class="fas fa-couch" title="Decoración"></i>
                                                    @break
                                                @default
                                                    <span>No definido</span>
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection



