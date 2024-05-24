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
            <td>{{count($fees)}}</td>
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
        <th>Valor</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($fees as $fee)
        <tr>
            <td>{{ $fee->created_at->format('d-m-Y H:i') }}</td>
            <td>{{ $fee->name }}</td>
            <td>{{ $fee->amount }} MT</td>
            
        </tr>
    @endforeach
    </tbody>
</table>