@extends('layouts.app')

@section('title', 'Gastos Compartidos')

@section('content')
<div class="contenedor-gastos">
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
                        <div class="gasto-cell">
                            <form action="{{ route('gastos.destroy', $gastoCompartido->gasto->id) }}" method="POST" >
                                @csrf
                                @method('DELETE')
                            <button type="button" class="boton-eliminar open-delete-modal"> <i class="fa fa-trash"></i>Eliminar</button>
                        </div>
                    </div>

                    <!-- Calcular total pagado y total deuda -->
                    @php
                        // Inicializa las variables para cada gasto compartido
                        $valorPorcentaje = $gastoCompartido->gasto->valor * ($gastoCompartido->porcentaje / 100);

                        if ($gastoCompartido->gasto->user->name === $nombreUsuario) {
                            // Si el otro usuario es el creador del gasto
                            $totalPagadoPorOtro += $valorPorcentaje; // Lo que pagó el otro usuario
                        } elseif ($gastoCompartido->gasto->user->name === auth()->user()->name) {
                            // Si tú eres el creador del gasto
                            $totalDeudaUsuario += $valorPorcentaje; // Lo que te deben del gasto
                        }
                    @endphp

                @endforeach

                                <div class="saldo-mensaje">
                    @if($totalPagadoPorOtro > 0)
                        <p>{{ $nombreUsuario }} ha pagado un total de {{ number_format($totalPagadoPorOtro, 2) }} €.</p>
                        <p>Tú le debes {{ number_format($totalPagadoPorOtro, 2) }} €.</p>
                    @elseif($totalDeudaUsuario > 0)
                        <p>Tú has pagado un total de {{ number_format($totalDeudaUsuario, 2) }} €.</p>
                        <p>{{ $nombreUsuario }} te debe {{ number_format($totalDeudaUsuario, 2) }} €.</p>
                    @endif
                </div>


                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection


<script>
document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".tarjeta-gastos"); // Cambiado a ".tarjeta-gastos"
    const dots = document.querySelectorAll(".scroll-dot");

    function activateDot(index) {
        dots.forEach(dot => dot.classList.remove("active"));
        if (dots[index]) dots[index].classList.add("active");
    }

    function updateDotOnScroll() {
        let currentIndex = 0;
        sections.forEach((section, index) => {
            const rect = section.getBoundingClientRect();
            if (rect.top <= window.innerHeight / 2 && rect.bottom >= window.innerHeight / 2) {
                currentIndex = index;
            }
        });
        activateDot(currentIndex);
    }

    window.addEventListener("scroll", updateDotOnScroll);
    updateDotOnScroll();  // Ejecutar inicialmente
});

</script>




