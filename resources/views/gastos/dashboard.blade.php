@extends('layouts.app')

@section('title', 'Mis Gastos')

@section('content')
<div class="py-4">
    <div class="card-body">
    <h2 class="card-title">Mis gastos</h2>
        @if($gastos->isEmpty())
            <div class="card">
                <div class="description">
                    <h2>No tienes gastos registrados.</h2>
                    <p>Agrega un nuevo gasto para empezar a llevar tu control.</p>
                </div>
            </div>
        @else
            <table class="tabla-gastos">
                <thead>
                    <tr>
                        <th>Nombre del Gasto</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <a href="{{ route('gasto.exportarGastos') }}" class="boton-enviar">Exportar Gastos a Excel</a>

                    @foreach ($gastos as $gasto)
                        <tr style="text-align: center; border-bottom: 1px solid #BFD1C9;">
                            <td data-label="Nombre del Gasto">{{ $gasto->nombre_gasto }}</td>
                            <td data-label="Tipo">{{ $gasto->tipo }}</td>
                            <td data-label="Valor">{{ $gasto->valor }} €</td>
                            <td data-label="Fecha">{{ $gasto->fecha }}</td>
                            <td data-label="Descripción">{{ $gasto->descripcion }}</td>
                            <td data-label="Categoría">
                                @php
                                    $icono = $categorias[$gasto->categoria] ?? 'fas fa-question-circle';
                                @endphp
                                <i class="{{ $icono }}" aria-hidden="true"></i>
                            </td>
                            <td>
                                <div class="btn-container" style="position: relative;">
                                    <button class="btn btn-light options-icon" title="Opciones">
                                        <i class="fa-solid fa-ellipsis-v"></i>
                                    </button>
                                    <!-- Menú de opciones -->
                                    <div class="options-menu" style="display: none;">
                                        <ul>
                                            <li><a href="{{ route('gastos.edit', $gasto->id) }}">Editar</a></li>
                                            <li>
                                                <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('¿Estás seguro de que quieres eliminar este gasto?');">Eliminar</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
     </div>
</div>
@endsection

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.options-icon').forEach(function(icon) {
        icon.addEventListener("click", function(event) {
            event.stopPropagation();

            // Cierra todos los menús abiertos
            document.querySelectorAll('.options-menu').forEach(function(menu) {
                menu.style.display = "none";
            });

            // Toggle el menú de opciones correspondiente
            const optionsMenu = this.nextElementSibling;
            optionsMenu.style.display = optionsMenu.style.display === "block" ? "none" : "block";
        });
    });

    // Cerrar el menú al hacer clic fuera
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.btn-container')) {
            document.querySelectorAll('.options-menu').forEach(function(menu) {
                menu.style.display = 'none';
            });
        }
    });
});

</script>







