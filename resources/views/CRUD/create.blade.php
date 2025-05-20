<html>
<head>
    <title>Crear Alquiler</title>
</head>
<body>
    <h1>Crear Alquiler</h1>
    <form action="{{ route('CRUD.rent') }}" method="POST">
        @csrf
        <label for="book_id">Libro:</label>
        <select name="book_id" id="book_id">
            @foreach ($books as $book)
                <option value="{{ $book->id }}">{{ $book->title }}</option>
            @endforeach
        </select>
        <br>
        <label for="rental_date">Fecha de alquiler:</label>
        <input type="date" name="rental_date" id="rental_date">
        <br>
        <label for="return_date">Fecha de devolución:</label>
        <input type="date" name="return_date" id="return_date">
        <br>
        <button type="submit">Crear alquiler</button>
    </form>
</body>
</html>