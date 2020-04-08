
  <div class="form-row">
    <div class="col-3">
      <label for="exampleFormControlFile1">Saldo em Conta</label>

      <input type="text" name="balance" class="form-control" value="{{ $value }}" readonly >
    </div>
    <div class="col-3">
       <label for="exampleFormControlFile1">{{ $label }}</label>
      <input type="number" min="0.00" step="any" name = "value" class="form-control" 
      placeholder="Valor">
    </div>
    <div class="col">
    <br>


    <button role="submit" class="btn btn-primary btn-md">
      <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> {{ $buttonText }}
    </button>
  </div>
  </div>
