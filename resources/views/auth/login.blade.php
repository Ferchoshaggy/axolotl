<x-guest-layout>
    

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <div class="container-fluid fixed-top p-4" style="background: #191e24;">
            <div class="col-12" >
                <div class="d-flex justify-content-end">

                </div>
            </div>
        </div>

        <div class="card-body" style="color: white; font-weight: bold; background-color:#191e24; margin-left: -16px; margin-right: -16px; border-radius: 5px;">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <x-jet-label value="{{ __('EMAIL') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="mb-3">
                    <x-jet-label value="{{ __('CONTRASEÑA') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

             <!--    <div class="mb-3">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('RECORDAR CONTRASEÑA') }}
                        </label>
                    </div>
                </div> -->

                <div class="mb-0">
<div style="display: flex; justify-content: center;">
    <a href="{{ route('register') }}" class="ml-4 btn form-control" style="background:rgb(235, 75, 235); color:white;">REGISTRARSE</a>
                    <x-jet-button class="form-control">
                        {{ __('INGRESAR') }}
                    </x-jet-button>
</div>
       <!-- <div class="text-align: center;">
            @if (Route::has('password.request'))
                <a class="text-muted me-3" href="{{ route('password.request') }}">
                    {{ __('¿OLVIDASTE TU CONTRASEÑA?') }}
                </a>
            @endif

                    
        </div> 
    -->
                    
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>