<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Book;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

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
        'rental_date' => 'required|date|after_or_equal:today',
        'return_date' => 'required|date|after:rental_date',
    ]);

    Rental::create([
        'user_id' => Auth::user()->id,
        'book_id' => $request->book_id,
        'rental_date' => $request->rental_date,
        'return_date' => $request->return_date,
    ]);
    return redirect()->route('CRUD.rentals')->withSuccess('Alquiler exitoso!');
    }

    public function rentals(Request $request)
    {
        $rentals = Rental::with('book')->where('user_id', Auth::id())->latest()->get();
        return view('CRUD.rentals', compact('rentals'));
    }


    public function catalogo()
    {
        return view('CRUD.catalogo');
    }



    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        return view('CRUD.edit', compact('rental'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rental_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:rental_date',
        ]);
        $rental = Rental::findOrFail($id);
        $rental->update($request->all());
        return redirect()->route('CRUD.rentals')->withSuccess('Alquiler actualizado exitosamente!');
    }

    public function destroy($id)
    {
        $rental = Rental::where('id', $id)->where('user_id', Auth::user()->id)->firstOrFail();
        $rental->delete();
        return redirect()->route('CRUD.rentals')->withSuccess('Alquiler eliminado exitosamente!');
    }
}
