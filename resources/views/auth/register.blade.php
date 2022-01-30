<x-guest-layout>
    <section class="body-sign">
        <div class="center-sign">
            <a href="#" class="logo float-left">
                <img src="{{ URL::asset('img/landlod.png') }}" height="54"  alt="Landlod logo" />
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign Up</h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('status') }}
                        </div>
                    @endif
                    
                    <form class="form-horizontal" method="POST" action="{{route('register')}}"> <!-- action="route('login')" -->
                                {{ csrf_field() }}
                               <!--<x-jet-validation-errors class="mb-4" />--> 
                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-sm-12 mb-3 @error('first_name') has-danger @enderror">
                                    <label>Name</label>
                                    <input name="first_name" type="name" class="form-control form-control-lg" value="{{ old('first_name') }}" required autocomplete="name"/>
                                    @error('first_name')
                                        <div>
                                            <label class="error">                                          
                                                <strong>{{ $message }}</strong>
                                            </label>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-sm-12 mb-3 @error('phone_number') has-danger @enderror" >
                                    <label>Phone Number</label>
                                    <input name="phone_number" type="name" class="form-control form-control-lg" value="{{ old('phone_number') }}" required autocomplete="phone"/>
                                    @error('phone_number')
                                        <div>
                                            <label class="error">                                          
                                                <strong>{{ $message }}</strong>
                                            </label>
                                        </div>
                                    @enderror
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group mb-3{{ $errors->has('Email') ? ' has-error' : '' }}">
                            <label for="Email">Email</label>
                            <div class="input-group">
                                <input id="email" name="email" type="email" class="form-control form-control-lg" value="{{ old('email') }}" required autofocus />
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>
                                </span>
                            </div>
                                
                                @if ($errors->has('email'))
                                    <div>
                                        <label class="error">                                          
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </label>
                                    </div>
                                @endif
                            
                        </div>
                        

                        <div class="form-group mb-0">
                            <div class="row">
                                <div class="col-sm-6 mb-3 @error('password') has-danger @enderror">
                                    <label>Password</label>
                                    <input name="password" type="password" value="{{ old('password') }}" class="form-control form-control-lg" required autocomplete="new-password"/>
                                    @error('password')
                                        <div>
                                            <label class="error">                                          
                                                <strong>{{ $message }}</strong>
                                            </label>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3  @error('password_confirmation') has-danger @enderror">
                                    <label>Password Confirmation</label>
                                    <input  name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" class="form-control form-control-lg" required autocomplete="new-password"/>
                                    @error('password_confirmation')
                                        <div>
                                            <label class="error">                                          
                                                <strong>{{ $message }}</strong>
                                            </label>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                    

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <x-jet-button class="btn btn-primary mt-2 w-100">
                                    {{ __('Sign Up') }}
                                </x-jet-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-3 mb-3">&copy; Copyright {{date('Y')}}. All Rights Reserved.</p>
        </div>
    </section>
</x-guest-layout>
