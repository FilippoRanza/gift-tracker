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
    
        <div class="col-lg-12 ">
        </br>
          <div class="jumbotron jumbotron-color">
        
                
              <h1 class="display-4 main_title">Gift Tracker</h1>
              
              <p class="lead">{{ __('public_home.lead') }}</p>
          
         
            <hr class="my-4">
            <p>{{ __('public_home.info') }}</p>
            <p class="lead text-center">
        
              <a class="btn btn-secondary btn-lg " type="button" data-toggle="tooltip" data-placement="top" title="{{ __('public_home.login_tooltip') }}" href="{{ route('login:page') }}" > {{ __('public_home.login_button') }} </a>
              <a class="btn btn-secondary btn-lg " type="button" data-toggle="tooltip" data-placement="top" title="{{ __('public_home.register_tooltip') }}" href="{{ route('register:page') }}" > {{ __('public_home.register_button') }} </a>
            </p>
          </div>
        </div>
        

    </div>
    <div class="row">

      <div class="col-lg-4 pb-5">
        <div class="jumbotron jumbotron-fluid jumbotron-color h-100">
          <div class="container">
            
            <h1 class="display-4 main_title"> <img class="icon_home" src="https://img.icons8.com/nolan/96/wedding-gift.png"/> {{ __('public_home.catalog') }}</h1>
            <p class="lead">{{ __('public_home.catalog_lead') }}</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 pb-5">
        <div class="jumbotron jumbotron-fluid jumbotron-color h-100">
          <div class="container">
            
            <h1 class="display-4 main_title"> <img class="icon_home" src="https://img.icons8.com/dusk/64/000000/coins.png"/> {{ __('public_home.shopping') }}</h1>
            <p class="lead">{{ __('public_home.shopping_lead') }}</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 pb-5">
        <div class="jumbotron jumbotron-fluid jumbotron-color h-100">
          <div class="container">
            <!-- -->
            <h1 class="display-4 main_title"> <img class="icon_home" src="https://img.icons8.com/nolan/100/combo-chart.png"/> {{ __('public_home.debtor_creditor') }}</h1>
            <p class="lead">{{ __('public_home.debtor_creditor_lead') }}</p>
          </div>
        </div>
      </div>
          
    </div>

  </div>

  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>


@endsection
