@extends('layouts.app')

@section('title', 'Gastos Compartidos')

@section('content')
<div class="contenedor-gastos" id="contenedor-compartidos">
    <h2 class="card-title">Mis gastos compartidos</h2>

    @if($gastosCompartidos->isEmpty())
    <p>No hay gastos compartidos para mostrar.</p>
    @else
    <div class="scroll-indicator">
        @foreach($gastosCompartidos as $nombreUsuario => $gastos)
        <span class="scroll-dot"></span>
        @endforeach
    </div>

    @foreach($gastosCompartidos as $nombreUsuario => $gastos)
    <div class="tarjeta-gastos">
        <h3>Gastos compartidos con {{ $nombreUsuario }}</h3>

        <!-- Encabezado de la "tabla" -->
        <div class="gasto-row header">
            <div class="gasto-cell">Nombre del Gasto</div>
            <div class="gasto-cell">Tipo</div>
            <div class="gasto-cell">Valor</div>
            <div class="gasto-cell">Fecha</div>
            <div class="gasto-cell">Descripción</div>
            <div class="gasto-cell">Pagado por</div>
            <div class="gasto-cell">Porcentaje de Pago</div>
            <div class="gasto-cell">Acciones</div>
        </div>

        <!-- Filas de gastos -->
        @php
        $totalPagadoPorOtro = 0;
        $totalDeudaUsuario = 0;
        @endphp

        @foreach($gastos as $gastoCompartido)
        <div class="gasto-row">
            <div class="gasto-cell">{{ $gastoCompartido->gasto->nombre_gasto }}</div>
            <div class="gasto-cell">{{ $gastoCompartido->gasto->tipo }}</div>
            <div class="gasto-cell">{{ $gastoCompartido->gasto->valor }} €</div>
            <div class="gasto-cell">{{ $gastoCompartido->gasto->fecha }}</div>
            <div class="gasto-cell">{{ $gastoCompartido->gasto->descripcion }}</div>
            <div class="gasto-cell">{{ $gastoCompartido->gasto->user->name }}</div>
            <div class="gasto-cell">{{ $gastoCompartido->porcentaje }}%</div>
            <!-- Menú de opciones -->
            <div class="btn-container">
                <!-- Botón para mostrar/ocultar el menú -->
                <button class="btn btn-light options-icon" title="Opciones">
                    <i class="fa-solid fa-ellipsis-v"></i>
                </button>

                <!-- Menú de opciones -->
                <div class="options-menu" style="display: none;">
                    <!-- Formulario para editar -->
                    <form action="{{ route('gastos.compartidos.edit', $gastoCompartido->id) }}" method="GET" class="edit-form" data-id="{{ $gastoCompartido->id }}">
                        @csrf
                        <button type="submit" class="boton-enviar">Editar</button>
                    </form>

                    <!-- Formulario para eliminar -->
                    <form action="{{ route('gastos.destroy', $gastoCompartido->id) }}" method="POST" class="delete-form" data-id="{{ $gastoCompartido->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="boton-eliminar open-delete-modal">Eliminar</button>
                    </form>
                </div>
            </div>

            <!-- Calcular total pagado y total deuda -->
            @php
            $valorPorcentaje = $gastoCompartido->gasto->valor * ($gastoCompartido->porcentaje / 100);

            if ($gastoCompartido->gasto->user->name === $nombreUsuario) {
            $totalPagadoPorOtro += $valorPorcentaje;
            } elseif ($gastoCompartido->gasto->user->name === auth()->user()->name) {
            $totalDeudaUsuario += $valorPorcentaje;
            }
            @endphp
        </div> <!-- Fin de gasto-row -->
        @endforeach

        <!-- Mostrar saldo debajo de cada tabla -->
        <div class="saldo-mensaje">
            @if($totalPagadoPorOtro > 0)
            <p>{{ $nombreUsuario }} ha pagado un total de {{ number_format($totalPagadoPorOtro, 2) }} €.</p>
            <p>Tú le debes {{ number_format($totalPagadoPorOtro, 2) }} €.</p>
            @elseif($totalDeudaUsuario > 0)
            <p>Tú has pagado un total de {{ number_format($totalDeudaUsuario, 2) }} €.</p>
            <p>{{ $nombreUsuario }} te debe {{ number_format($totalDeudaUsuario, 2) }} €.</p>
            @endif
        </div>
    </div> <!-- Fin de tarjeta-gastos -->
    @endforeach
    @endif
</div>
@endsection