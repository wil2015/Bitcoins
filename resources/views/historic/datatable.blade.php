@extends ('layout.master')

@section ('content')

<header>
    <div class="title">
      <h2>Extrato</h2>
     
    </div>
  </header>

<div>
<table id='users-table' class="table table-striped">
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
   

@push('scripts')
<script>
$(document).ready(function() {
    var table = $('#users-table').DataTable( {
      //  "ajax": "{!! route('datatables.data') !!}",
        "ajax": "{!! route('datatables'.?.'token='.$token,[id => $id]) !!}",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            { data: 'id', name: 'id' },
            { data: 'operation', name: 'operation' },
            { data: 'value', name: 'value' }
            { data: 'amount', name: 'amount' }
            { data: 'quote', name: 'quote' }
            { data: 'data', name: 'data' }
            { data: 'variation', name: 'variation' }
            { data: 'resultado', name: 'resultado' }


          
        ],
        "order": [[1, 'asc']]
    } );

</script>
@endpush