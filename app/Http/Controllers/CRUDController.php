<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CRUDController extends Controller
{
    public function index()
    {
        return view('CRUD.index');
    }
    
    //* Controladores de crud
    public function create()
    {
        $books = Book::all();
        return view('CRUD.create', compact('books'));
    }

    public function rent(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rental_days' => 'required|integer|min:1|max:30',
        ]);

        $book = Book::findOrFail($request->book_id);
        
        if ($book->stock <= 0) {
            return redirect()->back()->withErrors(['error' => 'El libro no está disponible para renta.']);
        }

        $rental_date = Carbon::now();
        $return_date = $rental_date->copy()->addDays($request->rental_days);

        $rental = Rental::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'rental_date' => $rental_date,
            'return_date' => $return_date,
        ]);

        // Actualizar el stock del libro
        $book->decrement('stock');

        return redirect()->route('CRUD.rentals')->withSuccess('¡Libro rentado exitosamente!');
    }

    public function rentals(Request $request)
    {
        $rentals = Rental::with(['book', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('CRUD.rentals', compact('rentals'));
    }

    public function catalogo()
    {
        $books = Book::all();
        return view('CRUD.catalogo', compact('books'));
    }

    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        return view('CRUD.edit', compact('rental'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rental_days' => 'required|integer|min:1|max:30',
        ]);

        $rental = Rental::findOrFail($id);
        $return_date = Carbon::parse($rental->rental_date)->addDays($request->rental_days);
        
        $rental->update([
            'return_date' => $return_date
        ]);

        return redirect()->route('CRUD.rentals')->withSuccess('¡Alquiler actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $rental = Rental::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        // Devolver el libro al stock
        $book = Book::findOrFail($rental->book_id);
        $book->increment('stock');
        
        $rental->delete();
        return redirect()->route('CRUD.rentals')->withSuccess('¡Alquiler eliminado exitosamente!');
    }
}
