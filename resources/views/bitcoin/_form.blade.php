
  <div class="form-row">
    <div class="col-3">
      <label for="exampleFormControlFile1">Saldo em Conta</label>
      <input type="text" name="balance" class="form-control" value={{$balance}} readonly >
    </div>
    <div class="col-3">
    <label for="exampleFormControlFile1">Quant. de Bitcoins</label>

      <input type="text" name="amount" class="form-control" value="{{$amount}}" readonly >
    </div>
    <div class="col-3">
     <label for="exampleFormControlFile1">{{ $label }}</label>

      <input type="number" min="1"  name="qtd"  class="form-control" placeholder="Quantidade">
    </div>

    <div class="col-3">
              <br>

      <button role="submit" class="btn btn-primary btn-md">
         {{ $buttonText }}
      </button>
    </div>
  </div>
