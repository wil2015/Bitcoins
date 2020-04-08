@extends ('layout.master')

@section ('content')

<header>
    <div class="title">
      <h2>Extrato</h2>
     
    </div>
  </header>

<div>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Operacao</th>
      <th scope="col">Valor</th>
      <th scope="col">Quantidade Bitcoins</th>
      <th scope="col">Cotacao</th>
      <th scope="col">Data da Operação</th>
      <th scope="col">Percentagem de L/P</th>
      <th scope="col">Resultado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($moviment as $value ) 
    <tr>
      <th scope="row">{{$value['id']}}</th>
      <td>{{$value['operation'] }}</td>
      <td>{{$value['value'] }}</td>
      <td>{{$value['amount'] }}</td>
      <td>{{$value['quote'] }}</td>
      <td>{{$value['data']}}</td>
      <td>{{$value['variation']}}</td>
      <td>{{$value['resultado']}}</td>

    </tr>
    @endforeach 
  </tbody>
</table>
</div>

@endsection
   