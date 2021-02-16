@extends('base')

@section('title')
  Gift Tracker
@endsection

@section('navbar')
  @include('public.public_navbar')
@endsection


@section('body')

  <div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
          <img src="https://img.icons8.com/nolan/96/question-mark.png"/>
          Hai mai avuto problemi nel fare regali od acquisti personali che richiedessero una spesa comune? E' difficile tener traccia di chi 
          ha già saldato il suo debito e chi no? Se la risposta è si, allora sei nel posto giusto!
          <br>
          Gift Traker è il sito che ti permette di seguire ogni passaggio dalla creazione di una lista di oggetti all'acquisto degli stessi
          in modo facile e veloce. Ogni membro dovrà registrarsi e potrà cosi nell'apposita sezione gestire tutte le transazioni per suddividere la 
          spesa.
          
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <img src="https://img.icons8.com/nolan/96/wedding-gift.png"/>
            Crea un nuovo catalogo ed aggiungi quante più opzioni regalo desideri. 
        </div>
        <div class="col-lg-4">
          <img src="https://img.icons8.com/dusk/64/000000/coins.png"/>
          Acquista da una tua lista o da quella di un amico con cui vuoi dividere la spesa
        </div>

        <div class="col-lg-4">
          <img src="https://img.icons8.com/nolan/100/combo-chart.png"/>
          Salda i tuoi debiti o controlla i tuoi creditori con un click
        </div>
    </div>

    <div class="row">
      <button class="btn btn-secondary" action="{{ route('login:page') }}" >
        Login
      </button>
      <button class="btn btn-secondary" action="{{ route('register:page') }}" >
        Registrazione
      </button>
    </div>

  </div>

@endsection
