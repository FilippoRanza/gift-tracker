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
        </br>
          <div class="jumbotron">
            <div class="col-lg-10">
              <h1 class="display-4 main_title">Gift Tracker</h1>
              <p class="lead">Hai mai avuto problemi nel fare regali od acquisti personali che richiedessero una spesa comune? È difficile tener traccia di chi 
              ha già saldato il suo debito e chi no? Se la risposta è si, allora sei nel posto giusto!</p>
            </div>
            <div class="col-lg-1 text-center">
              <img src="https://img.icons8.com/nolan/96/question-mark.png"/> 
            </div>
            <hr class="my-4">
            <p>Gift Traker è il sito che ti permette di seguire ogni passaggio dalla creazione di una lista di oggetti all'acquisto degli stessi
            in modo facile e veloce. Ogni membro dovrà registrarsi e potrà cosi nell'apposita sezione gestire tutte le transazioni per suddividere la spesa.</p>
            <p class="lead text-center">
              <button class="btn btn-secondary btn-lg" action="{{ route('login:page') }}" > Login </button>
              <button class="btn btn-secondary btn-lg" action="{{ route('register:page') }}" > Registrazione </button>
            </p>
          </div>
        </div>
        

    </div>
    </br></br></br>
    <div class="row">

      <div class="col-lg-4">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            
            <h1 class="display-4 main_title"> <img class="width=90% height=auto" src="https://img.icons8.com/nolan/96/wedding-gift.png"/> Catalogo</h1>
            <p class="lead">Crea un nuovo catalogo ed aggiungi quante più opzioni regalo desideri. Tu ed i tuoi amici potrete poi scegliere quale acquistare.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            
            <h1 class="display-4 main_title"> <img src="https://img.icons8.com/dusk/64/000000/coins.png"/> Acquisti</h1>
            <p class="lead">Acquista da una tua lista o da quella di un amico con cui vuoi dividere la spesa. Ci penserà Gift Tracker a gestire tutto</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="jumbotron jumbotron-fluid">
          <div class="container">
            
            <h1 class="display-4 main_title"> <img class="width=90% height=auto" src="https://img.icons8.com/nolan/100/combo-chart.png"/> Debitore o Creditore?</h1>
            <p class="lead">Salda i tuoi debiti o controlla i tuoi creditori con un click</p>
          </div>
        </div>
      </div>
          
    </div>

  </div>

@endsection
