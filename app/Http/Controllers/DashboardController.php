<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $loans = Loan::orderBy('created_at')->get();
        
        // Total de préstamos
        $totalLoans = $loans->count();
        
        // Total de libros 
        $totalBooks = $books->count();

        // Total de usuarios
        $totalUsers = User::count();
        
        // Libros disponibles (stock > 0)
        $availableBooks = Book::where('stock', '>', 0)->count();

        // Préstamos activos (Pendiente o Atrasado)
        $activeLoans = Loan::whereIn('loan_status', ['Pendiente', 'Atrasado'])->count();

        // Préstamos retrasados
        $lateLoans = Loan::where('loan_status', 'Atrasado')->count();

        return view('dashboard', compact(
            'books',
            'loans',
            'totalLoans',
            'totalBooks',
            'totalUsers',
            'availableBooks',
            'activeLoans',
            'lateLoans',
        ));
    }
}
