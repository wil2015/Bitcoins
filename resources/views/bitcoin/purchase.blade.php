@extends ('layout.master')

@section ('content')

  <header>
    <div class="title">
      <h2>Compra de Bitcoins</h2>
     
    </div>
  </header>
        @include('includes.errors')

        @include('includes.card')

        <br>
        <br>

  <div>
    <form method="POST" action="/bitcoin/purchase/{{$id}}?token={{$token}}" autocomplete="off">
      <input type="hidden" name="_method" value="PUT" autocomplete="off">
      @include ('bitcoin._form', ['buttonText' => 'Compra','label' => 'Quantidade a comprar'])
    </form>
  </div>

@endsection