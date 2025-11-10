<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        $totalLibros = Book::count();
        $librosDisponibles = Book::where('stock', '>', 0)->count();

        $porcentajeDisponibilidad = $totalLibros > 0
            ? round(($librosDisponibles / $totalLibros) * 100, 2)
            : 0;

        return view('books.index', compact('books', 'porcentajeDisponibilidad'));
    }

    public function store(Request $request)
    {

        try {
            // Validación de los campos
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|max:20|unique:books,isbn',
                'summary' => 'required|string',
                'stock' => 'required|integer|min:0',
                'publication_year' => 'required|integer',
            ]);

            // Crear el libro
            Book::create($validated);

            // Redirigir con mensaje de éxito
            return redirect()->route('books.index')->with('success', 'Libro agregado correctamente.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    
    public function update(Request $request)
    {
        try {
            // Validación de los campos
            $validated = $request->validate([
                'id' => 'required|integer',
                'title' => 'required|string|max:255',
                'author' => 'required|string|max:255',
                'isbn' => 'required|string|max:20|unique:books,isbn,' . $request->id,
                'summary' => 'required|string',
                'stock' => 'required|integer|min:0',
                'publication_year' => 'required|integer',
            ]);

            $book = Book::find($request['id']);

            // Actualizar el libro
            $book->update($validated);

            // Redirigir con mensaje de éxito
            return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
