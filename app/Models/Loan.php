<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $table = 'loans';
    protected $fillable = [
        'borrower_id',
        'student_id',
        'book_id',
        'due_date',
        'return_date',
        'load_status'
    ];

    public function borrower() {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

}
