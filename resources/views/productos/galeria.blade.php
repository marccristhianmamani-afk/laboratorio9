{{-- resources/views/productos/galeria.blade.php --}}
@extends('layouts.app')
@section('titulo', 'Galeria de Productos')

@section('contenido')

<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; flex-wrap:wrap; gap:1rem;">
    <h1 style="color:var(--primary-dk); margin:0">
        Galeria de Productos
        <span style="font-size:1rem; font-weight:normal; color:var(--text-light)">
            ({{ $productos->count() }} productos)
        </span>
    </h1>
    <a href="{{ route('productos.index') }}" class="btn btn-outline btn-sm">Ver como tabla</a>
</div>

{{-- COMPONENTE DEL RETO: Filtros (Categoría y Barra de Búsqueda) --}}
<div class="card" style="padding: 1.2rem; margin-bottom: 2rem; display: flex; flex-wrap: wrap; align-items: center; gap: 1.5rem; background: #fff;">
    
    {{-- Filtro 1: Buscador por Nombre --}}
    <div style="flex: 1; min-width: 260px; display: flex; flex-direction: column; gap: .4rem;">
        <label for="buscador-nombre" style="font-weight: 600; color: var(--text); font-size: .9rem;">Buscar Producto:</label>
        <input type="text" id="buscador-nombre" placeholder="Escribe el nombre de un producto..." 
               style="padding: .55rem 1rem; border: 1px solid var(--border); border-radius: 6px; font-size: .95rem; color: var(--text); outline: none; width: 100%;">
    </div>

    {{-- Filtro 2: Selector de Categoría --}}
    <div style="min-width: 240px; display: flex; flex-direction: column; gap: .4rem;">
        <label for="filtro-categoria" style="font-weight: 600; color: var(--text); font-size: .9rem;">Filtrar por Categoría:</label>
        <select id="filtro-categoria" style="padding: .55rem 1rem; border: 1px solid var(--border); border-radius: 6px; font-size: .95rem; color: var(--text); background: #fff; cursor: pointer; outline: none; width: 100%;">
            <option value="">-- Mostrar Todos --</option>
            @foreach($categorias as $cat)
                <option value="{{ $cat->id_categoria }}" {{ isset($categoriaSeleccionada) && $categoriaSeleccionada == $cat->id_categoria ? 'selected' : '' }}>
                    {{ $cat->descripcion }}
                </option>
            @endforeach
        </select>
    </div>
    
    {{-- Botón para limpiar si se usó el filtro del controlador --}}
    @if(isset($categoriaSeleccionada) && $categoriaSeleccionada)
        <div style="padding-top: 1.3rem;">
            <a href="{{ route('productos.galeria') }}" style="font-size: .85rem; color: var(--accent); font-weight: 600;">Limpiar Filtros</a>
        </div>
    @endif
</div>

@if($productos->isEmpty())
    <div class="alert alert-info">No hay productos registrados aun.</div>
@else
    {{-- Contenedor de la cuadrícula --}}
    <div class="galeria-grid" id="contenedor-galeria">
        @foreach($productos as $producto)
        {{-- Guardamos el nombre en minúsculas en un atributo data-nombre para el buscador JS --}}
        <div class="producto-card" data-nombre="{{ strtolower($producto->nombre) }}">

            {{-- Imagen del producto --}}
            @if($producto->foto && file_exists(public_path('img/productos/' . $producto->foto)))
                <img src="{{ asset('img/productos/' . $producto->foto) }}" alt="{{ $producto->nombre }}">
            @else
                <div class="no-foto">Sin imagen</div>
            @endif

            <div class="card-body">
                <h3>{{ $producto->nombre }}</h3>
                <p class="marca">{{ $producto->marca }}</p>

                {{-- Badge de Gestión de Stock --}}
                @if($producto->stock == 0)
                    <span class="badge-categoria badge-stock-low" style="background: #E74C3C; color: white;">AGOTADO</span>
                @elseif($producto->stock > 20)
                    <span class="badge-categoria badge-stock-ok">Stock: {{ $producto->stock }}</span>
                @elseif($producto->stock > 5)
                    <span class="badge-categoria badge-stock-warn">Stock: {{ $producto->stock }}</span>
                @else
                    <span class="badge-categoria badge-stock-low">Stock bajo: {{ $producto->stock }}</span>
                @endif

                <p class="precio">S/. {{ number_format($producto->precio, 2) }}</p>
            </div>

            <div class="card-footer">
                <span class="badge-categoria">{{ $producto->categoria->descripcion ?? 'Sin cat.' }}</span>
                <div style="display:flex; gap:.4rem">
                    <a href="{{ route('productos.show', $producto->id_producto) }}" class="btn btn-outline btn-sm">Ver</a>
                    
                    {{-- COMPONENTE DEL RETO: Deshabilitar el botón si no hay stock --}}
                    @if($producto->stock == 0)
                        <button type="button" class="btn btn-sm" style="background: #BDC3C7; color: #7F8C8D; cursor: not-allowed;" disabled>
                            Agotado
                        </button>
                    @else
                        <form action="{{ route('carrito.agregar', $producto->id_producto) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">+ Carrito</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Div de aviso por si la búsqueda con JS no encuentra coincidencias --}}
    <div id="busqueda-vacia" class="alert alert-info" style="display: none; margin-top: 1rem;">
        No se encontraron productos que coincidan con tu búsqueda.
    </div>
@endif

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filtroCategoria = document.getElementById('filtro-categoria');
        const buscadorNombre = document.getElementById('buscador-nombre');
        const tarjetas = document.querySelectorAll('.producto-card');
        const avisoVacio = document.getElementById('busqueda-vacia');

        // 1. LÓGICA DEL RETO: Filtro por categoría (Recarga la página)
        if (filtroCategoria) {
            filtroCategoria.addEventListener('change', function() {
                const idCategoria = this.value;
                const url = new URL(window.location.href);
                
                if (idCategoria) {
                    url.searchParams.set('categoria', idCategoria);
                } else {
                    url.searchParams.delete('categoria');
                }
                window.location.href = url.toString();
            });
        }

        // 2. LÓGICA DEL RETO: Barra de búsqueda por nombre en tiempo real (Keyup con JavaScript)
        if (buscadorNombre) {
            buscadorNombre.addEventListener('keyup', function() {
                const textoBusqueda = this.value.toLowerCase().trim();
                let coincidencias = 0;

                tarjetas.forEach(tarjeta => {
                    const nombreProducto = tarjeta.getAttribute('data-nombre');
                    
                    if (nombreProducto.includes(textoBusqueda)) {
                        tarjeta.style.display = 'flex'; // Muestra la tarjeta
                        coincidencias++;
                    } else {
                        tarjeta.style.display = 'none'; // Oculta la tarjeta
                    }
                });

                // Si no hay ningún resultado visible, muestra el mensaje de alerta
                if (coincidencias === 0 && tarjetas.length > 0) {
                    avisoVacio.style.display = 'block';
                } else {
                    avisoVacio.style.display = 'none';
                }
            });
        }
    });
</script>
@endpush