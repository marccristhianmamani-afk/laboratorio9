<?php

namespace App\Http\Controllers;

// ── IMPORTANTE: Estos cuatro 'use' deben estar aquí arriba para evitar errores ──
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    // Muestra la lista de todos los productos (Vista Administrador / Tabla)
    public function index()
    {
        // Se utiliza 'with' para la carga previa (Eager Loading) evitando el problema N+1
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    // Muestra la galería con los componentes del RETO FINAL (Filtro, buscador y control de stock)
    public function galeria(Request $request)
    {
        // 1. Capturamos el id de la categoría si el usuario seleccionó alguna
        $categoriaSeleccionada = $request->get('categoria');

        // 2. Traemos todas las categorías de la base de datos para llenar el <select>
        $categorias = Categoria::all();

        // 3. Consultamos los productos aplicando el filtro condicional condicionado por 'when'
        $productos = Producto::with('categoria')
            ->when($categoriaSeleccionada, function ($query, $categoriaId) {
                return $query->where('id_categoria', $categoriaId);
            })
            ->get();

        // 4. Retornamos la vista enviando todas las variables necesarias mediante compact
        return view('productos.galeria', compact('productos', 'categorias', 'categoriaSeleccionada'));
    }

    // Muestra el detalle específico de un producto seleccionado
    public function show($id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }
}