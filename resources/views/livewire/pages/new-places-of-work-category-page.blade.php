<div>
    <x-slot name="title">
        Places of Work
    </x-slot>
    

    <x-slot name="header">
        <header class="page-header">
            <h2>Places of Work</h2>
        
            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{-- url('/adminhome') --}}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span>New</span></li>
                    <li><span>Places of Work</span></li>                     
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
    
                    <h2 class="card-title">Places of work Information</h2>
                    <p class="card-subtitle">{{--$landlord->id--}}</p>
                </header>
                <div class="card-body">
                    <div class="row">
                        <div class="card-body col-lg-8">
                            <form 
                                @if ($formStatus == 1)
                                wire:submit.prevent="addPlaceOfWorkCategory"
                                @else
                                wire:submit.prevent="addPlaceOfWorkCategory"
                                @endif
                                >
                                    {{ csrf_field() }} 
                                    <div class="row form-group">
                                <div class="col-lg-8">
                                        <div class="form-group @error('placeOfWorkCategory') has-danger @enderror">
                                            <label class="col-form-label" for="placeOfWorkCategory">Place of Work Category</label>
                                            <input type="text" class="form-control" id="placeOfWorkCategory" placeholder="" wire:model="placeOfWorkCategory">
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




