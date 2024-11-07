@extends('layouts.app')

@section('title', 'Mis Gastos')

@section('content')
<div class="table-wrapper">
<div class="py-4">
    <div class="container" style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
        @if($gastos->isEmpty())
            <div class="card">
                <div class="description">
                    <h2>No tienes gastos registrados.</h2>
                    <p>Agrega un nuevo gasto para empezar a llevar tu control.</p>
                </div>
            </div>
        @else
            <table class="table table-striped table-hover" id="tablaGastos" style="width: 100%; max-width: 1000px; border-collapse: collapse; background-color: #FFFFFF; color: #3B4013; border-radius: 10px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
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
                <a href="{{ route('gasto.exportarGastos') }}" class="btn btn-success">Exportar Gastos a Excel</a>

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
                                    <button class="btn btn-light options-icon" title="Opciones" style="border: none; background: none; padding: 0;">
                                        <i class="fa-solid fa-ellipsis-v" style="font-size: 18px; cursor: pointer;"></i>
                                    </button>
                                    <!-- Menú de opciones -->
                                    <div class="options-menu" style="display: none;">
                                        <ul>
                                            <li><a href="{{ route('gastos.edit', $gasto->id) }}">Editar</a></li>
                                            <li>
                                                <form action="{{ route('gastos.destroy', $gasto->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background: none; border: none; color: #4CAF50;" onclick="return confirm('¿Estás seguro de que quieres eliminar este gasto?');">Eliminar</button>
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







