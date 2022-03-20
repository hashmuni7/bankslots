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
                        <a href="{{ url('/dashboard') }}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li><span>New</span></li>
                    <li><span>Account Holder</span></li>                     
                </ol>
        
                <a class="sidebar-right-toggle" ><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>
    </x-slot>

    <div class="row" x-data="{idCardFront = false, idCardBack = false}">
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
                                    <div class="col-lg-8">
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
                                        <div class="col-lg-4">
                                            <div class="form-group @error('dob') has-danger @enderror">
                                                <label class="col-form-label" for="dob">Date of Birth</label>
                                                <input type="date" class="form-control" id="dob" placeholder="" wire:model="dob">
                                                @error('dob')
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
                                                <input type="number" class="form-control" id="phoneNumber" placeholder="705949874" wire:model="phoneNumber">
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
                                    <div class="col-lg-6">
                                        <div class="form-group @error('nin') has-danger @enderror">
                                            <label class="col-form-label" for="nin">NIN no</label>
                                            <input type="text" class="form-control" id="nin" placeholder="" wire:model="nin" >
                                            @error('nin')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
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
                                    <div class="col-lg-4 hidden">
                                        <div class="form-group @error('placeOfWorkCategory') has-danger @enderror">
                                            <label class="col-form-label" for="placeOfWork">Work Station Category</label>
                                            <select name="placeOfWorkCategory"  wire:model="placeOfWorkCategory" class="form-select form-control">
                                                <option value="">Select Work Station Category</option>
                                                @foreach ($placesOfWorkCategorys as $placeOfWorkCategory)
                                                    <option value="{{$placeOfWorkCategory->placesofworkcategoryid}}">{{$placeOfWorkCategory->placecategory}}</option> 
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
                                    <div class="col-lg-8">
                                        <div class="form-group @error('placeOfWork') has-danger @enderror">
                                            <label class="col-form-label" for="placeOfWork">Market</label>
                                            <select name="placeOfWork"  wire:model="placeOfWork" class="form-select form-control">
                                                <option value="">Select Work Station</option>
                                                @foreach ($placesOfWork as $placeOfWork)
                                                    <option value="{{$placeOfWork->placesofworkid}}">{{$placeOfWork->placeofwork}}</option> 
                                                @endforeach
                                            </select>
                                            @error('placeOfWork')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group @error('businessNatureCategory') has-danger @enderror">
                                            <label class="col-form-label" for="businessNatureCategory">Business Nature</label>
                                            <select name="businessNatureCategory"  wire:model="businessNatureCategory" class="form-select form-control">
                                                <option value="">Select Business Nature</option>
                                                @foreach ($businessNatureCategorys as $businessNatureCategory)
                                                    <option title="{{$businessNatureCategory->description}}" value="{{$businessNatureCategory->businessnaturecategoryid}}">{{$businessNatureCategory->category}}</option> 
                                                @endforeach
                                            </select>
                                            @error('businessNatureCategory')
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
                                        <div class="form-group @error('dailyTurnOver') has-danger @enderror">
                                            <label class="col-form-label" for="dailyTurnOver">Daily Turnover</label>
                                            <input type="number" class="form-control" id="dailyTurnOver" placeholder="" wire:model="dailyTurnOver">
                                            @error('dailyTurnOver')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
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
                                    <div class="col-lg-2">
                                        <div class="form-group @error('alreadyBanked') has-danger @enderror">
                                            <label class="col-form-label" for="alreadyBanked">Already Banked</label>
                                            <select name="alreadyBanked"  wire:model="alreadyBanked" class="form-select form-control">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            @error('alreadyBanked')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group @error('bankName') has-danger @enderror">
                                            <label class="col-form-label" for="bankName">Bank Name</label>
                                            <input type="name" class="form-control" id="bankName" placeholder="" wire:model="bankName">
                                            @error('bankName')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group @error('accountNumber') has-danger @enderror">
                                            <label class="col-form-label" for="accountNumber">Account Number</label>
                                            <input type="text" class="form-control" id="accountNumber" placeholder=""  wire:model="accountNumber">
                                            @error('accountNumber')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group @error('accountType') has-danger @enderror">
                                            <label class="col-form-label" for="accountType">Account Type</label>
                                            <input type="text" class="form-control" id="accountType" placeholder="" wire:model="accountType">
                                            @error('accountType')
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
                                        <div class="form-group @error('nextOfKinName') has-danger @enderror">
                                            <label class="col-form-label" for="nextOfKinName">Name of Next Of Kin</label>
                                            <input type="name" class="form-control" id="nextOfKinName" placeholder="" wire:model="nextOfKinName">
                                            @error('nextOfKinName')
                                                <div>
                                                    <label class="error">                                          
                                                        <strong>{{ $message }}</strong>
                                                    </label>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group @error('nextOfKinContact') has-danger @enderror">
                                            <label class="col-form-label" for="nextOfKinContact">Phone Of Next Of Kin</label>
                                            <input type="tel" class="form-control" id="nextOfKinContact" placeholder="" wire:model="nextOfKinContact">
                                            @error('nextOfKinContact')
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
                                        <div class="form-group @error('profilePhoto') has-danger @enderror">
                                            <label class="col-form-label control-label text-lg-right pt-2">Passport Photo</label>
                                            <div wire:ignore class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                        @if ($profilePhoto)
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{$profilePhoto->temporaryUrl()}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{$profilePhoto->temporaryUrl()}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            
                                                        @else
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{ Illuminate\Support\Facades\Storage::disk('s3')->url("noimage.png") }}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{ Illuminate\Support\Facades\Storage::disk('s3')->url("noimage.png") }}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div x-data="{ isUploading: false, progress: 0,  }"
                                                    x-on:livewire-upload-start="isUploading = true"
                                                    x-on:livewire-upload-finish="isUploading = false"
                                                    x-on:livewire-upload-error="isUploading = false"
                                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                                    >
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            
                                                            <input  type="file" 
                                                                accept="image/*;capture=camera" 
                                                                
                                                                id="profilePhotoInput"
                                                                @change="
                                                                //console.log('Success callback');
                                                                isUploading = true;
                                                                const file = $event.target.files[0];
                                                                if (!file) {
                                                                    return;
                                                                }
                                                                
                                                                compFile = new Compressor(file, {
                                                                    quality: 0.2,
                                                                    success(result) {
                                                                    @this.upload('profilePhoto', result, (uploadedFilename) => {
                                                                        // Success callback.
                                                                        alert('How is this!');
                                                                        isUploading = false;
                                                                        //console.log('Success callback');
                                                                        
                                                                    }, () => {
                                                                        // Error callback.
                                                                    }, (event) => {
                                                                        // Progress callback.
                                                                        // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                                                                        console.log(event.detail.progress);
                                                                    })

                                                                    },
                                                                    error(err) {
                                                                        alert(err.message);
                                                                    }
                                                                });
                                                                "
                                                            />
                                                        </span>
                                                      <a href="#" class="btn btn-secondary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                      <div x-show="isUploading">
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            @error('profilePhoto')
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
                                        <div class="form-group @error('holderCardFront') has-danger @enderror">
                                            <label class="col-form-label control-label text-lg-right pt-2">Identity Card Front</label>
                                            <div wire:ignore class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    
                                                        @if ($holderCardFront)
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{$holderCardFront->temporaryUrl()}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{$holderCardFront->temporaryUrl()}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            
                                                        @else
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{Illuminate\Support\Facades\Storage::disk('s3')->url("idcard.jpg")}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{Illuminate\Support\Facades\Storage::disk('s3')->url("idcard.jpg")}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div x-data="{ isUploadingCardFront: false, progress: 0,  }"
                                                            x-on:livewire-upload-start="
                                                                if(idCardFront)
                                                                    alert('It is working')
                                                                    isUploadingCardFront = true
                                                                    "
                                                            x-on:livewire-upload-finish="isUploadingCardFront = false"
                                                            x-on:livewire-upload-error="isUploadingCardFront = false"
                                                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file" 
                                                            accept="image/*;capture=camera" 
                                                                
                                                                id="idCardFrontInput"
                                                                @change="
                                                                //console.log('Success callback');
                                                                isUploadingCardFront = true;
                                                                const file = $event.target.files[0];
                                                                if (!file) {
                                                                    return;
                                                                }
                                                                
                                                                compFile = new Compressor(file, {
                                                                    quality: 0.2,
                                                                    success(result) {
                                                                    @this.upload('holderCardFront', result, (uploadedFilename) => {
                                                                        // Success callback.
                                                                        alert('How is this!');
                                                                        isUploadingCardFront = false;
                                                                        //console.log('Success callback');
                                                                        
                                                                    }, () => {
                                                                        // Error callback.
                                                                    }, (event) => {
                                                                        // Progress callback.
                                                                        // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                                                                        console.log(event.detail.progress);
                                                                    })

                                                                    },
                                                                    error(err) {
                                                                        alert(err.message);
                                                                    }
                                                                });
                                                                "
                                                                />
                                                        </span>
                                                      <a href="#" class="btn btn-secondary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                      <div x-show="isUploadingCardFront">
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            @error('holderCardFront')
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
                                        <div class="form-group @error('holderCardBack') has-danger @enderror">
                                            <label class="col-form-label control-label text-lg-right pt-2">Identity Card Back</label>
                                            <div wire:ignore class="">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                    
                                                        @if ($holderCardBack)
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{$holderCardBack->temporaryUrl()}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{$holderCardBack->temporaryUrl()}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                            
                                                        @else
                                                            <div class="fileupload-new thumbnail-gallery">
                                                                <a class="img-thumbnail lightbox" href="{{Illuminate\Support\Facades\Storage::disk('s3')->url("idcard.jpg")}}" data-plugin-options='{ "type":"image" }'>
                                                                    <img class="img-fluid" width="215" src="{{Illuminate\Support\Facades\Storage::disk('s3')->url("idcard.jpg")}}">
                                                                    <span class="zoom">
                                                                        <i class="fas fa-search"></i>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div x-data="{ isUploadingCardBack: false, progress: 0,  }"
                                                        x-on:livewire-upload-start="
                                                            if(idCardBack)
                                                                alert('It is working')
                                                                isUploadingCardBack = true
                                                                "
                                                        x-on:livewire-upload-finish="isUploadingCardBack = false"
                                                        x-on:livewire-upload-error="isUploadingCardBack = false"
                                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                        <span class="btn btn-file btn-primary">
                                                            <span class="fileupload-new">Select image</span>
                                                            <span class="fileupload-exists">Change</span>
                                                            <input type="file"
                                                            
                                                            accept="image/*;capture=camera" 
                                                                
                                                                id="idCardBackInput"
                                                                @change="
                                                                //console.log('Success callback');
                                                                isUploadingCardBack = true;
                                                                const file = $event.target.files[0];
                                                                if (!file) {
                                                                    return;
                                                                }
                                                                
                                                                compFile = new Compressor(file, {
                                                                    quality: 0.2,
                                                                    success(result) {
                                                                    @this.upload('holderCardBack', result, (uploadedFilename) => {
                                                                        // Success callback.
                                                                        alert('How is this!');
                                                                        isUploadingCardBack = false;
                                                                        //console.log('Success callback');
                                                                        
                                                                    }, () => {
                                                                        // Error callback.
                                                                    }, (event) => {
                                                                        // Progress callback.
                                                                        // event.detail.progress contains a number between 1 and 100 as the upload progresses.
                                                                        console.log(event.detail.progress);
                                                                    })

                                                                    },
                                                                    error(err) {
                                                                        alert(err.message);
                                                                    }
                                                                });
                                                                "/>
                                                        </span>
                                                      <a href="#" class="btn btn-secondary fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                      <div x-show="isUploadingCardBack">
                                                        <progress max="100" x-bind:value="progress"></progress>
                                                    </div>
                                                    </div>
                                                  </div>
                                            </div>
                                            @error('holderCardBack')
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
                                                <a wire:click="addHolder" class="btn btn-primary " wire:loading.class="disabled" role="button" style="width: 10em; color: white" aria-pressed="true">
                                                    <i class="fa fa-spinner fa-spin" wire:loading wire:target="addHolder"></i> Save
                                                    
                                                </a>
                                                @else
                                                    Update 
                                                @endif 
                                                @if ($formStatus == $statusInput)
                                                <a wire:click="saveAndNew" class="btn btn-default" role="button" style="width: 10em" aria-pressed="true">Save & New</a>
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



