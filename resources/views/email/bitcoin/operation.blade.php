@component('mail::panel')
# Investimento 
 
@component('mail::table')

| Valor		   | Quantidade    | Operacao 	   | Cotacao  |
|:------------:|:-------------:|:-------------:|:--------:|
| {{ $value }} | {{ $amount }} | {{$operation}}|{{$price}}|

@endcomponent


 
@endcomponent