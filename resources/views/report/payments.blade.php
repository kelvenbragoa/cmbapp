<table>
    <thead>
        <tr>
            <th>Registros Total</th>
            <th>Valor Total</th>
            <th>Exportado Por</th>
            <th>Data Exportação</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{count($payments)}}</td>
            <td>{{$payments->sum('total')}} MT</td>
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
        <th>Valor</th>
        <th>Quantidade</th>
        <th>Total</th>
        <th>Licença</th>
        <th>Titulo</th>
        <th>Operador</th>
        <th>Obs</th>
        
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->created_at->format('d-m-Y H:i') }}</td>
            <td>{{ $payment->amount }} MT</td>
            <td>{{ $payment->quantity }}</td>
            <td>{{ $payment->total }} MT</td>
            <td>{{ $payment->fee->name }}</td>
            <td>{{ $payment->title }}</td>
            <td>{{ $payment->user->first_name }} {{ $payment->user->last_name }}</td>
            <td>{{ $payment->obs }}</td>
            
            
        </tr>
    @endforeach
    </tbody>
</table>