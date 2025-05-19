<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <h2>Lista Letras Cedula</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Letra</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach($letrasCedula as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->letra }}</td>
                <td>{{ $item->nombre }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
