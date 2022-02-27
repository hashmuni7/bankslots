<div>
    <x-slot name="title">
        New Account Holder
    </x-slot>
    

    <x-slot name="header">
        <header class="page-header">
            <h2>New Account Holder</h2>
        
            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{-- url('/adminhome') --}}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span>New</span></li>
                    <li><span>User</span></li>                     
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
    
                    <h2 class="card-title">New Account Holder Information</h2>
                    <p class="card-subtitle">{{--$landlord->id--}}</p>
                </header>
                <div class="card-body">
                        <div class="row">
                            <div class="card-body col-lg-8">
                                <form>
                                        {{ csrf_field() }} 
                                        <div class="row form-group">
                                    <div class="col-lg-12">
                                            <div class="form-group @error('name') has-danger @enderror">
                                                <label class="col-form-label" for="name">Name</label>
                                                <input type="text" class="form-control" id="name" placeholder="" wire:model="name">
                                                @error('name')
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
                                        <div class="form-group @error('phoneNumber') has-danger @enderror">
                                            <label class="col-form-label" for="phoneNumber">Phone Number</label>
                                            
                                            <div class="input-group mb-3">
                                                <span class="input-group-prepend">
                                                    <span class="input-group-text">+256</span>
                                                </span>
                                                <input type="text" class="form-control" id="phoneNumber" placeholder="705949874" wire:model="phoneNumber">
                                            </div>
                                            @error('phoneNumber')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group @error('nin') has-danger @enderror">
                                            <label class="col-form-label" for="nin">NIN no</label>
                                            <input type="text" class="form-control" id="nin" placeholder="" wire:model="nin">
                                            @error('nin')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group @error('gender') has-danger @enderror">
                                            <label class="col-form-label" for="gender">Gender</label>
                                            <select name="gender"  wire:model="gender" class="form-select form-control">
                                                <option value="">Gender</option>
                                                <option value="1">Male</option>
                                                <option value="0">Female</option>
                                            </select>
                                            @error('gender')
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
                                    <div class="col-lg-4">
                                        <div class="form-group @error('market') has-danger @enderror">
                                            <label class="col-form-label" for="market">Market</label>
                                            <select name="market"  wire:model="market" class="form-select form-control">
                                                <option value="">Select Market</option>
                                                @foreach ($markets as $market)
                                                    <option value="{{$market->marketid}}">{{$market->marketname}}</option> 
                                                @endforeach
                                            </select>
                                            @error('market')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group @error('residencePlace') has-danger @enderror">
                                            <label class="col-form-label" for="residencePlace">Place of Residence</label>
                                            <input type="text" class="form-control" id="residencePlace" placeholder="" wire:model="residencePlace">
                                            @error('residencePlace')
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
                                    <div class="col-lg-6">
                                        <div class="form-group @error('businessNature') has-danger @enderror">
                                            <label class="col-form-label" for="businessNature">Business Nature</label>
                                            <select name="businessNature"  wire:model="businessNature" class="form-select form-control">
                                                <option value="">Select</option>
                                                @foreach ($businessNatureCategorys as $businessNatureCategory)
                                                    <option value="{{$businessNatureCategory->businessnatureid}}">{{$businessNatureCategory->businessnature}}</option> 
                                                @endforeach
                                            </select>
                                            @error('businessNature')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group @error('dailyTurnOver') has-danger @enderror">
                                            <label class="col-form-label" for="dailyTurnOver">Daily Turnover</label>
                                            <input type="input" class="form-control" id="dailyTurnOver" placeholder="" wire:model="dailyTurnOver">
                                            @error('dailyTurnOver')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group @error('profilePhotoUrl') has-danger @enderror">
                                            <label class="col-form-label control-label text-lg-right pt-2">Vendor Passport Photo</label>
                                            <div wire:ignore class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        @if ($vendorPhoto)
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{Storage::disk('s3')->url("photos/goodName09.jpg")}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{Storage::disk('s3')->url("photos/goodName09.jpg")}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            
                                                        @else
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{Storage::disk('s3')->url("noimage.png")}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{Storage::disk('s3')->url("noimage.png")}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div>
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" accept="image/*;capture=camera" wire:model="vendorPhoto"/>
                                                        </span>
                                                      <a href="#" class="btn btn-secondary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                  </div>
                                            </div>
                                            @error('profilePhotoUrl')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group @error('vendorCardFront') has-danger @enderror">
                                            <label class="col-form-label control-label text-lg-right pt-2">Identity Card Front</label>
                                            <div wire:ignore class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    
                                                        @if ($vendorPhoto)
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{asset('storage/test1.jpg')}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{asset('storage/test1.jpg')}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            
                                                        @else
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{Storage::disk('s3')->url("idcard.jpg")}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{Storage::disk('s3')->url("idcard.jpg")}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div>
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" accept="image/*;capture=camera" wire:model="vendorCardFront"/>
                                                        </span>
                                                      <a href="#" class="btn btn-secondary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                  </div>
                                            </div>
                                            @error('profilePhotoUrl')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>    
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <div class="form-group @error('vendorCardBack') has-danger @enderror">
                                            <label class="col-form-label control-label text-lg-right pt-2">Identity Card Back</label>
                                            <div wire:ignore class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    
                                                        @if ($vendorPhoto)
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{asset('storage/test1.jpg')}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{asset('storage/test1.jpg')}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            
                                                        @else
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{Storage::disk('s3')->url("idcard.jpg")}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{Storage::disk('s3')->url("idcard.jpg")}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div>
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" accept="image/*;capture=camera" wire:model="vendorCardBack"/>
                                                        </span>
                                                      <a href="#" class="btn btn-secondary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                    </div>
                                                  </div>
                                            </div>
                                            @error('vendorCardBack')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                    </div>    
                                </div>                              
                                <div class="row">
                                    <div class="{{$formStatus == $statusInput ? 'col-lg-6' : 'col-lg-8'}}">
                                                                                  
                                            
                                                @if ($formStatus == $statusInput)
                                                <a wire:click="addHolder" class="btn btn-primary" role="button" style="width: 10em; color: white" aria-pressed="true">Save</a>
                                                @else
                                                    Update 
                                                @endif 
                                                @if ($formStatus == $statusInput)
                                                <a wire:click="saveAndNew" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Save & New</a>
                                                @else
                                                <a wire:click="cancelUpdate" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Cancel Update</a>
                                                <a wire:click="deleteHolder" class="btn btn-secondary" role="button" style="width: 10em" aria-pressed="true">Delete</a>
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
           $('.fileupload').fileupload();
            

        </script>
    @endsection

    
</div>


