<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getBooks() {
        $books = Book::all();
        return response()->json([
            'message' => 'Libros encontrados',
            'data' => $books
        ]);
    }

    public function getBook(string $id) {
        $book = Book::find($id);
        return response()->json([
            'message' => 'Libro encontrado',
            'data' => $book
        ]);
    }

    public function create(Request $request) {
        $validate = $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'summary' => 'nullable|string',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:20',
            'publication_year' => 'required|integer|digits:4',
            'stock' => 'required|integer|min:0',
        ]);

        $book = Book::create($validate);
        return response()->json([
            'message' => 'libro creado',
            'data' => $book
        ]);
    }

    public function update(Request $request, string $id) {
        $book = Book::find($id);
        $validate = $request->validate([
            'title' => 'sometimes|string|max:255|unique:books,title,'. $id,
            'summary' => 'sometimes|string',
            'author' => 'sometimes|string|max:255',
            'isbn' => 'sometimes|string|max:20|unique:books,isbn,'.$id,
            'publication_year' => 'sometimes|integer|digits:4',
            'stock' => 'sometimes|integer|min:0',
        ]);

        $book->update($validate);
        return response()->json([
            'message' => 'libro actualizado',
            'data' => $book
        ]);
    }

    public function destroy(string $id) {
        $book = Book::find($id);
        $book->delete();
        return response()->json([
            'message' => 'libro eliminado exitosamente.',
        ], 200);
    }
}
