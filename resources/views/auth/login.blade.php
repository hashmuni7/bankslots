<x-guest-layout>
    <section class="body-sign">
        <div class="center-sign">
            <a href="#" class="logo float-left">
                <img src="{{ URL::asset('img/salesmanager.jpg') }}" height="54"  alt="Landlod logo" />
            </a>

            <div class="panel card-sign">
                <div class="card-title-sign mt-3 text-right">
                    <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-user mr-1"></i> Sign In</h2>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('status') }}
                        </div>
                    @endif
                    
                    <form class="form-horizontal" method="POST" action="{{route('login')}}"> <!-- action="route('login')" -->
                                {{ csrf_field() }}

                        <div class="form-group mb-3{{ $errors->has('Email') ? ' has-error' : '' }}">
                            <label for="Email">Email</label>
                            <div class="input-group">
                                <input id="email" name="email" type="email" class="form-control form-control-lg" value="{{ old('username') }}" required autofocus />
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
                        

                        <div class="form-group mb-3{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="clearfix">
                                <label for="password" class="float-left">Password</label>									
                            </div>
                            <div class="input-group">
                                <input id="password" name="password" type="password" class="form-control form-control-lg" required/>
                                <span class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </span>
                            </div>  
                                @if ($errors->has('password'))
                                    <div>
                                        <label class="error">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </label>
                                    </div>
                                @endif						
                        </div>
                        
                    

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <x-jet-button class="btn btn-primary mt-2 w-100">
                                    {{ __('Login') }}
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
