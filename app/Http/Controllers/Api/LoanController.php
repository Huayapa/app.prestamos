<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function getLoans() {
        $loans = Loan::all();
        return response()->json([
            'message' => 'Libros encontrados',
            'data' => $loans
        ]);
    }

    public function getLoan(string $id) {
        $loan = Loan::find($id);
        return response()->json([
            'message' => 'Libros encontrados',
            'data' => $loan
        ]);
    }

    public function create(Request $request) {
        $validate = $request->validate([
            'student_id' => 'required|string|max:50',
            'book_id' => 'nullable|integer|exists:books,id',
            'due_date' => 'required|date|after_or_equal:today',
            'loan_status' => 'sometimes|required|string|in:Pendiente,Devuelto,Atrasado,Perdido'
        ]);
        $validate['borrower_id'] = auth()->id();
        $loan = Loan::create($validate);
        return response()->json([
            'message' => 'Prestamo realizado',
            'data' => $loan
        ]);
    }

    public function update(Request $request, string $id) {
        $loan = Loan::find($id);
        $validate = $request->validate([
            'borrower_id' => 'sometimes|required|integer|exists:users,id',
            'student_id' => 'sometimes|required|string|max:50',
            'book_id' => 'nullable|integer|exists:books,id',
            'due_date' => 'sometimes|required|date|after_or_equal:today',
            'return_date' => 'nullable|date|after_or_equal:due_date',
            'loan_status' => 'sometimes|required|string|in:Pendiente,Devuelto,Atrasado,Perdido',
        ]);
        $loan->update($validate);
        return response()->json([
            'message' => 'Prestamo actualizado',
            'data' => $loan
        ]);
    }

    // public function destroy(string $id) {
    //     $loan = Loan::find($id);
    //     $loan->delete();
    //     return response()->json([
    //         'message' => 'prestamo eliminado exitosamente.',
    //     ], 200);
    // }
}
