@extends('layouts.app')

@section('title', 'Mis Gastos')

@section('content')
<div class="contenedor-gastos" id="contenedor-dashboard">
    <h2 class="titulo-tabla">Mis gastos</h2>
    @if ($mostrarTutorial)
    <div id="tutorial-modal" class="modal-overlay active">
        <div class="modal-content">
            <div class="carousel-container">
                <!-- Slide 1 -->
                <div class="carousel-slide active">
                    <h3>Bienvenido a Huchapp</h3>
                    <p>Esta aplicación te ayudará a gestionar tus gastos de manera eficiente.</p>
                    <button class="boton-siguiente">Siguiente</button>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-slide">
                    <h3>Registro de Gastos</h3>
                    <p>En esta sección puedes añadir, visualizar y editar tus gastos.</p>
                    <button class="boton-anterior">Anterior</button>
                    <button class="boton-siguiente">Siguiente</button>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-slide">
                    <h3>Resumen de Presupuesto</h3>
                    <p>Obtén un resumen visual de tu presupuesto y gastos.</p>
                    <button class="boton-anterior">Anterior</button>
                    <button id="finalizar-tutorial">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($gastos->isEmpty())
    <div class="tabla-gastos">
        <div class="description">
            <h2>No tienes gastos registrados.</h2>
            <p>Agrega un nuevo gasto para empezar a llevar tu control.</p>
        </div>
    </div>
    @else


    <div class="tabla-gastos">
        <a href="{{ route('gasto.exportarGastos') }}" class="export-button">Exportar Gastos a Excel</a>

        <div class="contenedor-graficas">
            <div class="grafica">
                <canvas id="graficaPie" title="Gráfica de Quesitos"></canvas>
            </div>
            <div class="grafica">
                <canvas id="graficaBar" title="Gráfica de Barras"></canvas>
            </div>
            <div class="grafica">
                <canvas id="graficaLine" title="Gráfica de Líneas"></canvas>
            </div>
        </div>

        <!-- Encabezado de la "tabla" -->
        <div class="gasto-row header">
            <div class="gasto-cell" title="Nombre">Nombre del Gasto</div>
            <div class="gasto-cell" title="Tipo">Tipo</div>
            <div class="gasto-cell" title="Valor">Valor</div>
            <div class="gasto-cell" title="Fecha">Fecha</div>
            <div class="gasto-cell" title="Descripción">Descripción</div>
            <div class="gasto-cell" title="Acciones">Acciones</div>
        </div>

        <div class="tarjeta-gastos">
            @foreach ($gastos as $gasto)
            <div class="gasto-row">
                <div class="gasto-cell categoria">
                    @php
                    $icono = $categorias[$gasto->categoria] ?? 'fas fa-question-circle';
                    @endphp
                    <i class="{{ $icono }}" aria-hidden="true"></i>
                </div>
                <div class="gasto-cell nombre-gasto">{{ $gasto->nombre_gasto }}</div>
                <div class="gasto-cell tipo">{{ $gasto->tipo }}</div>
                <div class="gasto-cell valor">{{ $gasto->valor }} €</div>
                <div class="gasto-cell fecha">{{ $gasto->fecha }}</div>
                <div class="gasto-cell descripcion">{{ $gasto->descripcion }}</div>
                <div class="gasto-cell acciones">
                    <div class="btn-container">
                        <button class="btn btn-light options-icon" title="Opciones">
                            <i class="fa-solid fa-ellipsis-v"></i>
                        </button>
                        <!-- Menú de opciones -->
                        <div class="options-menu" style="display: none;">
                            <!-- Formulario para editar -->
                            <form action="{{ route('gastos.edit', $gasto->id) }}" method="GET" class="edit-form" data-id="{{ $gasto->id }}">
                                @csrf
                                <button type="submit" class="boton-enviar" title="Editar Gasto">Editar</button>
                            </form>
                            <!-- Formulario para eliminar -->
                            <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST" class="delete-form" data-id="{{ $gasto->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="boton-eliminar open-delete-modal" title="Eliminar Gasto">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>


    @endif
</div>
@endsection