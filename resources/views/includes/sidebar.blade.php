<!-- sidebar nav -->
    


<ul class="nav flex-column" style="background-color: #e3f2fd;">
  <li class="nav-item">
    <a class="nav-link active" href="/account/deposit/show/{{$id}}?token={{$token}}">Deposito</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/account/withdrawal/show/{{$id}}?token={{$token}}">Retirada</a>
  </li>  <li class="nav-item">
    <a class="nav-link" href="/bitcoin/purchase/show/{{$id}}?token={{$token}}">Compra Bitcoin</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/bitcoin/sale/show/{{$id}}?token={{$token}}">Venda Bitcoin</a>
  </li>
   <li class="nav-item">
    <a class="nav-link" href="/historic/list/{{$id}}?token={{$token}}">Extrato Conta</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/bitcoin/historic/{{$id}}?token={{$token}}">Extrato Bitcoin</a>
  </li>
</ul>