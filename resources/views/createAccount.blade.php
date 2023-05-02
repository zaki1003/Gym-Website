@extends('layouts.home-layout')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>REJOIGNEZ NOUS</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact-section spad">
        <div class="container">
            <div class="">
                <div class="col-lg-6">
                    <div class="section-title contact-title">
                        <span>INSCRIVEZ-VOUS</span>
                        <h2>Sans Attendre</h2>
                    </div>

                </div>



                



                <div class="col-lg-12">
                    <div class="leave-comment">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nom"  autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>

                            @enderror 
                            </div>
                      








                            <div>
                 
                 
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email"  value="{{ old('email') }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                      
    
                        
                                <div >
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe"  required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                          
    
                            <div >
                                 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-tapez le mot de passe"  required autocomplete="new-password">
                         
                            </div>
    






                      
                      
                      
                         <button type="submit">Continuer</button>
                      
                      
                      
                      
                      
                        </form>
                    </div>
                </div>








            </div>
        </div>
    </section>
    <!-- Contact Section End -->

  
  
</div>

@endsection