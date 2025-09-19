@extends('layouts.auth')

@section('content')
<div class="container row">
 
    <div class=" col-lg-5 offset-1 mt-lg-4 row justify-content-center">
        <div class="">
            <div class="card  border-0 shadow-sm bg-white rounded-3">
                <div class="card-header fw-bold bg-white"  style="font-size:1.2rem;color: dark;">{{ __('Se connecter') }}</div>
                <div class="card-body offset-1 bg-white ">
                    <form method="POST" action="{{ route('login') }}" >
                        @csrf

                        <div class="row mb-3">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Adresse e-mail') }}</label> --}}

                            <div class=" row input-container">
                                <div class="col-lg-1">
                                    <svg width="28"   id="mail" xmlns="http://www.w3.org/2000/svg"  fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>

                                </div>

                                  <div class="col-lg-10">

                                      <input id="email" type="email" placeholder="E-mail" class="form-control-plaintext form-control-sm  bg-white border border ps-2 rounded-3  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required  autocomplete="email" autofocus>
      
                                      @error('email')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-end fw-bold">{{ __('Mot de passe') }}</label> --}}

                            <div class="col-lg-12 row">
                                <div class="col-lg-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="" width="28" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                      </svg>
                                      

                                </div>
                                <div class="col-lg-10">

                                    
                                    <input id="password" type="password" placeholder="Mot de passe" class="form-control-sm w-100 form-plaintext bg-white border border ps-2 rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 ">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Enregistrer mes informations') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 ">
                                <button type="submit" class="btn  btn-sm rounded-3 border fw-bold"  style="color: #55dd24;">
                                    {{ __('Se connecter') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-info" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
