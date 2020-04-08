@extends ('layout.master')

@section ('content')

  <header>
    <div class="title">
      <h2>Deposito</h2>
     
    </div>
  </header>



  <div>
    <form method="POST" action="/account/deposit/{{$id}}?token={{$token}}"
     autocomplete="off">
      <input type="hidden" name="_method" value="PUT" autocomplete="off">
      @include ('account._form', ['buttonText' => 'Depositar', 'label' => 'Valor a Depositar'])
    </form>
  </div>

@endsection