@extends ('layout.master')

@section ('content')

  <header>
    <div class="title">
      <h2>Retirada</h2>
     
    </div>
  </header>
    @include('includes.errors')


  <div>
    <form method="POST" action="/account/withdrawal/{{$id}}?token={{$token}}" 
    autocomplete="off">
      <input type="hidden" name="_method" value="PUT" autocomplete="off">
      @include ('account._form', ['buttonText' => 'Retirar', 'label' => 'Valor a Retirar'])
    </form>
  </div>

@endsection