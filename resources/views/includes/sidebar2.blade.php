

<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

           <li class="nav-item">
             <a class="nav-link active" href="/account/deposit/show/{{$id}}?token={{$token}}">
              <i class="fa fa-money" aria-hidden="true"></i> Deposito</a>
          </li>
          <li class="nav-item">
                  <a class="nav-link" href="/account/withdrawal/show/{{$id}}?token={{$token}}">
                      <i class="fa fa-money" aria-hidden="true"></i> Retirada</a>
            
          </li>
          <li class="nav-item">
                <a class="nav-link" href="/bitcoin/purchase/show/{{$id}}?token={{$token}}">
                 <i class="fa fa-btc" aria-hidden="true"></i> Compra Bitcoin</a>
          
          </li>
          <li class="nav-item">
                <a class="nav-link" href="/bitcoin/sale/show/{{$id}}?token={{$token}}">
              <i class="fa fa-btc" aria-hidden="true"></i> Venda Bitcoin</a>

          </li>
          <li class="nav-item">
              <a class="nav-link" href="/historic/list/{{$id}}?token={{$token}}">
              <i class="fa fa-list" aria-hidden="true"></i> Extrato Conta</a>

          </li>
          <li class="nav-item">
                <a class="nav-link" href="/bitcoin/historic/{{$id}}?token={{$token}}">
                 <i class="fa fa-list" aria-hidden="true"></i> Extrato Bitcoin</a>
           
          </li>
        </ul>
      
      </div>
</nav>