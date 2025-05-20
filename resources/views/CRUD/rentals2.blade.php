<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Alquileres</title>
</head>
<body>
    <x-crud-navbar></x-crud-navbar>
    
    <section>
        <table>
            <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Categoria</th>
                    <th>Fecha de alquiler</th>
                    <th>Fecha de fin de alquiler</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alquileres as $alquiler)
                    <tr>
                        <td>{{ $alquiler->titulo }}</td>
                        <td>{{ $alquiler->autor }}</td>
                        <td>{{ $alquiler->categoria }}</td>
                        <td>{{ $alquiler->fecha_alquiler }}</td>
                        <td>{{ $alquiler->fecha_fin_alquiler }}</td>
                        <td>
                            <a href="{{ route('CRUD.edit', $alquiler->id) }}" class="text-blue-500">Editar</a>
                            <form action="{{ route('CRUD.destroy', $alquiler->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
</body>
</html>