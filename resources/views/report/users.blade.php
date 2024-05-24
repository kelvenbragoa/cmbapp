<table>
    <thead>
        <tr>
            <th>Registros Total</th>
            <th>Exportado Por</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{count($users)}}</td>
            <td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
            <td>{{date('d-m-Y H:i')}}</td>
        </tr>
    </tbody>
</table>
<br>
<table>
    <thead>
    <tr>
        <th>Data</th>
        <th>Nome</th>
        <th>Apelido</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Codigo</th>
        <th>Nivel</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->mobile }}</td>
            <td>{{ $user->code }}</td>
            <td>{{ $user->role->name }}</td>  
        </tr>
    @endforeach
    </tbody>
</table>