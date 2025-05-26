<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            [
                'title' => 'Cien años de soledad',
                'author' => 'Gabriel García Márquez',
                'stock' => 5,
            ],
            [
                'title' => 'El señor de los anillos',
                'author' => 'J.R.R. Tolkien',
                'stock' => 3,
            ],
            [
                'title' => 'Don Quijote de la Mancha',
                'author' => 'Miguel de Cervantes',
                'stock' => 4,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'stock' => 6,
            ],
            [
                'title' => 'El principito',
                'author' => 'Antoine de Saint-Exupéry',
                'stock' => 7,
            ],
            [
                'title' => 'Rayuela',
                'author' => 'Julio Cortázar',
                'stock' => 3,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
