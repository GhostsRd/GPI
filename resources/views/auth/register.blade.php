@extends('layouts.auth')

@section('content')
<div class="container ">
   
    <div class=" row ">
       
        <div class="col-md-8 mt-lg-4 col-lg-6">
            <div class="card border-0 shadow-sm bg-white">
                <div class="card-header bg-white fw-bold" style="font-size:1.2rem;color: dark;">{{ __("S'identifier") }}</div>

                <div class="card-body bg-white">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class=" row input-container">
                            <div class="col-lg-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                  </svg>
                                  

                            </div>

                           

                                <div class="col-md-6 col-lg-10">
                                    <input id="name" type="text" placeholder="Nom d'utilisateur" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              </div>
                        

                       

                        <div class=" row input-container">
                            <div class="col-lg-1">
                                <svg width="24"   id="mail" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>

                            </div>

                              <div class="col-lg-10">

                                <input id="email" type="email" placeholder="Votre e-mail" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            
                            <div class="col-lg-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                  </svg>
                                  

                            </div>
                            <div class="col-lg-10">
                                <input id="password" type="password" placeholder="Mot de passe" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="" width="24" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                  </svg>
                                  

                            </div>
                            <div class="col-lg-10">
                                <input id="password-confirm" placeholder="Confirmer mot de passe" type="password" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn  btn-sm rounded-3 border fw-bold"  style="color: #55dd24;">
                                    {{ __('Enregistrer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
