<div>
    <x-slot name="title">
        Markets
    </x-slot>
    

    <x-slot name="header">
        <header class="page-header">
            <h2>Markets</h2>
        
            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{-- url('/adminhome') --}}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span>New</span></li>
                    <li><span>Markets</span></li>                     
                </ol>
        
                <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>
    </x-slot>

    <div class="row">
        <div class="container-fluid mb-3">
            <section class="card">
                <header class="card-header card-header-transparent">
                    <div class="card-actions">
                        
                    </div>
    
                    <h2 class="card-title">Market Information</h2>
                    <p class="card-subtitle">{{--$landlord->id--}}</p>
                </header>
                <div class="card-body">
                        <div class="row">
                            <div class="card-body col-lg-8">
                                <form 
                                    @if ($formStatus == 1)
                                    wire:submit.prevent="addMarket"
                                    @else
                                    wire:submit.prevent="updateMarket"
                                    @endif
                                    >
                                        {{ csrf_field() }} 
                                        <div class="row form-group">
                                    <div class="col-lg-8">
                                            <div class="form-group @error('marketName') has-danger @enderror">
                                                <label class="col-form-label" for="marketName">Market Name</label>
                                                <input type="text" class="form-control" id="marketName" placeholder="" wire:model="marketName">
                                                @error('marketName')
                                                    <div>
                                                        <label class="error">                                          
                                                            <strong>{{ $message }}</strong>
                                                        </label>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group @error('district') has-danger @enderror">
                                                <label class="col-form-label" for="district">District</label>
                                                <select name="district"  wire:model="district" class="form-select form-control">
                                                    <option value="">Select District</option>
                                                    @foreach ($districts as $district)
                                                        <option value="{{$district->districtid}}">{{$district->district}}</option> 
                                                    @endforeach
                                                </select>
                                                @error('district')
                                                    <div>
                                                        <label class="error">                                          
                                                            <strong>{{ $message }}</strong>
                                                        </label>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-3">
                                        <div class="form-group @error('vendorPopulation') has-danger @enderror">
                                            <label class="col-form-label" for="vendorPopulation">Vendor Population</label>
                                            <input type="text" class="form-control" id="vendorPopulation" placeholder="" wire:model="vendorPopulation">
                                            @error('vendorPopulation')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-group @error('contactName') has-danger @enderror">
                                            <label class="col-form-label" for="contactName">Contact Name</label>
                                            <input type="text" class="form-control" id="contactName" placeholder="" wire:model="contactName">
                                            @error('contactName')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group @error('contactPhone') has-danger @enderror">
                                            <label class="col-form-label" for="contactPhone">Contact Phone</label>
                                            <input type="text" class="form-control" id="contactPhone" placeholder="" wire:model="contactPhone">
                                            @error('contactPhone')
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
                                    <div class="{{$formStatus == $statusInput ? 'col-lg-6' : 'col-lg-8'}}">
                                                                                  
                                            <button class="btn btn-primary"  style="width: 10em">
                                                @if ($formStatus == $statusInput)
                                                    Add Market
                                                @else
                                                    Update 
                                                @endif </button>
                                                @if ($formStatus == $statusInput)
                                                <a wire:click="clearFields" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Cancel</a>
                                                @else
                                                <a wire:click="cancelUpdate" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Cancel Update</a>
                                                <a wire:click="deleteMarket" class="btn btn-secondary" role="button" style="width: 10em" aria-pressed="true">Delete</a>
                                                @endif 
                                            
                                        
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="card-body col-lg-4">
                                
                            </div>
                        </div>
                    
                        @livewire('tables.markets-table')
                </div>                    
            </section>
        </div>
    </div>

    @section('pagejs')
        <!-- Code to handle Admin Requests-->
        <script>
           
            

        </script>
    @endsection

    
</div>



