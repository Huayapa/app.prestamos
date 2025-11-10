<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $loans = Loan::all();

        return view('loans.index', compact('loans', 'books'));
    }

    public function store(Request $request)
    {

        try {
            // Validación de los campos
            $validated = $request->validate([
                'student_id' => 'required|string|max:255',
                'book_id' => 'required|integer',
                'due_date' => 'required|date|after:today',
            ]);

            $validated['borrower_id'] = Auth::id();
            $validated['loan_status'] = 'Pendiente';

            // Crear el Préstamo
            Loan::create($validated);

            // Redirigir con mensaje de éxito
            return redirect()->route('loans.index')->with('success', 'Préstamo creado correctamente.');
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
                'student_id' => 'required|string|max:255',
                'book_id' => 'required|integer',
                'due_date' => 'required|date|after:today',
                'loan_status' => 'required|string|in:Pendiente,Devuelto,Atrasado,Perdido',
            ]);

            $loan = Loan::find($request['id']);

            if ($validated['loan_status'] === 'Devuelto' && $loan->return_date == null) {
                $validated['return_date'] = now()->format('Y-m-d');
            }

            // Actualizar el Préstamo
            $loan->update($validated);

            // Redirigir con mensaje de éxito
            return redirect()->route('loans.index')->with('success', 'Préstamo actualizado correctamente.');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function registerReturn(Loan $loan)
    {
        if ($loan->loan_status !== 'Devuelto') {
            $loan->update([
                'loan_status' => 'Devuelto',
                'return_date' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Devolución registrada correctamente.');
    }
}
