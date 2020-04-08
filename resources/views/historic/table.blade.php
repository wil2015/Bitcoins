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
      <th scope="col">Valor</th>
      <th scope="col">Operacao</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
    @foreach($moviment as $value ) 
    <tr>
      <th scope="row">{{$value -> id}}</th>
      <td>{{$value -> value }}</td>
      <td>{{$value -> operation }}</td>
      <td>{{$value -> created_at}}</td>
    </tr>
    @endforeach 
  </tbody>
</table>
</div>

@endsection