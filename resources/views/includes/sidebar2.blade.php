
<br>
<br>
<br>

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Dashboard <span class="sr-only">(current)</span>
            </a>
          </li>
           <li class="nav-item">
             <a class="nav-link active" href="/account/deposit/show/{{$id}}?token={{$token}}">Deposito</a>
          </li>
          <li class="nav-item">
                  <a class="nav-link" href="/account/withdrawal/show/{{$id}}?token={{$token}}">Retirada</a>
            
          </li>
          <li class="nav-item">
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
      
      </div>
</nav>