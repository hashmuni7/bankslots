<div>
    <x-slot name="title">
        Work Stations
    </x-slot>
    

    <x-slot name="header">
        <header class="page-header">
            <h2>Work Stations</h2>
        
            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{-- url('/adminhome') --}}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span>New</span></li>
                    <li><span>Work Stations</span></li>                     
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
    
                    <h2 class="card-title">Work Station Information</h2>
                    <p class="card-subtitle">{{--$landlord->id--}}</p>
                </header>
                <div class="card-body">
                        <div class="row">
                            <div class="card-body col-lg-8">
                                <form 
                                    @if ($formStatus == 1)
                                    wire:submit.prevent="addWorkStation"
                                    @else
                                    wire:submit.prevent="updateWorkStation"
                                    @endif
                                    >
                                        {{ csrf_field() }} 
                                        <div class="row form-group">
                                    <div class="col-lg-8">
                                            <div class="form-group @error('placeOfWork') has-danger @enderror">
                                                <label class="col-form-label" for="placeOfWork">Work Station Name</label>
                                                <input type="text" class="form-control" id="placeOfWork" placeholder="" wire:model="placeOfWork">
                                                @error('placeOfWork')
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
                                        <div class="col-lg-4">
                                            <div class="form-group @error('placeOfWorkCategory') has-danger @enderror">
                                                <label class="col-form-label" for="placeOfWorkCategory">Work Station Category</label>
                                                <select name="placeOfWorkCategory"  wire:model="placeOfWorkCategory" class="form-select form-control">
                                                    <option value="">Select Category</option>
                                                    @foreach ($placesOfWorkCategorys as $category)
                                                        <option value="{{$category->placesofworkcategoryid}}">{{$category->placecategory}}</option> 
                                                    @endforeach
                                                </select>
                                                @error('placeOfWorkCategory')
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
                                        <div class="form-group @error('prospectivePopulation') has-danger @enderror">
                                            <label class="col-form-label" for="prospectivePopulation">Prospective Population</label>
                                            <input type="number" class="form-control" id="prospectivePopulation" placeholder="" wire:model="prospectivePopulation">
                                            @error('prospectivePopulation')
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
                                                    Save
                                                @else
                                                    Update 
                                                @endif </button>
                                                @if ($formStatus == $statusInput)
                                                <a wire:click="clearFields" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Cancel</a>
                                                @else
                                                <a wire:click="cancelUpdate" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Cancel Update</a>
                                                <a wire:click="deleteRecord" class="btn btn-secondary" role="button" style="width: 10em" aria-pressed="true">Delete</a>
                                                @endif 
                                            
                                        
                                    </div>
                                </div>
                            </form>
                            </div>
                            <div class="card-body col-lg-4">
                                
                            </div>
                        </div>
                    
                        @livewire('tables.places-of-work-stations-table')
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



