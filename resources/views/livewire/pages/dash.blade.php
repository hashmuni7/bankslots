<div>
    <div class="row mb-3">
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-primary mb-3">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Account Holders</h4>
                                <div class="info">
                                    <strong class="amount">{{$accountHolders}}</strong>
                                    <span class="text-primary">Registered</span>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <a class="text-muted text-uppercase" href="{{ route('accountholderlistpage')}}">(view all)</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Users</h4>
                                <div class="info">
                                    <strong class="amount">{{$users}}</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-city"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Districts</h4>
                                <div class="info">
                                    <strong class="amount">{{$districts}}</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    
        <div class="col-xl-6">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-building"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary"
                            x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <form action="">
                                    
                                   <!-- <img src="https://mybank.s3.eu-west-2.amazonaws.com/20210219_094848.jpg"> -->
                                    {{ csrf_field() }} 
                                    @if ($testImage)
                                        Photo Preview:
    
                                        <img src="{{ $testImage->temporaryUrl() }}">
                                    @endif
                                    <div wire:loading wire:target="testImage">Uploading...</div>
                                    <input type="file" accept="image/*;capture=camera" wire:model="testImage"/>
                                    <a wire:click="saveImage" class="btn btn-primary" role="button" style="width: 10em; color: white" aria-pressed="true">Save</a>
                                </form>
                            </div>
                            <div class="summary-footer">
                                <div x-show="isUploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-primary mb-3">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-primary">
                                <i class="fas fa-landmark"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Banks</h4>
                                <div class="info">
                                    <strong class="amount">{{$banks}}</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-money-bill-alt"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Total Turn Over</h4>
                                <div class="info">
                                    <strong class="amount">{{$turnOver}}</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-4">
            <section class="card card-featured-left card-featured-secondary">
                <div class="card-body">
                    <div class="widget-summary">
                        <div class="widget-summary-col widget-summary-col-icon">
                            <div class="summary-icon bg-secondary">
                                <i class="fas fa-industry"></i>
                            </div>
                        </div>
                        <div class="widget-summary-col">
                            <div class="summary">
                                <h4 class="title">Work Stations</h4>
                                <div class="info">
                                    <strong class="amount">{{$placesOfWork}}</strong>
                                </div>
                            </div>
                            <div class="summary-footer">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12 col-xl-6">
            <section class="card">
                <header class="card-header card-header-transparent">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>
    
                    <h2 class="card-title">Company Activity</h2>
                </header>
                <div class="card-body">
                    <div class="timeline timeline-simple mt-3 mb-3">
                        <div class="tm-body">
                            <div class="tm-title">
                                <h5 class="m-0 pt-2 pb-2 text-uppercase">January 2022</h5>
                            </div>
                            <ol class="tm-items">
                                <li>
                                    <div class="tm-box">
                                        <p class="text-muted mb-0">1 month ago.</p>
                                        <p>
                                            Start of the project<span class="text-primary">#awesome</span>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="tm-box">
                                        <p class="text-muted mb-0">This month.</p>
                                        <p>
                                            Integration of MaaliPay
                                        </p>
                                        <div class="thumbnail-gallery">
                                            <a class="img-thumbnail lightbox" href="img/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
                                                <img class="img-fluid" width="215" src="img/projects/project-4.jpg">
                                                <span class="zoom">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                            <div class="tm-title">
                                <h5 class="m-0 pt-2 pb-2 text-uppercase">March 2022</h5>
                            </div>
                            <ol class="tm-items">
                                <li>
                                    <div class="tm-box">
                                        <p class="text-muted mb-0">A few Days to the Deadline.</p>
                                        <p>
                                            Completion of the system<span class="text-primary">#awesome</span>
                                        </p>
                                    </div>
                                </li>
                                <li>
                                    <div class="tm-box">
                                        <p class="text-muted mb-0">7 months ago.</p>
                                        <p>
                                            Checkout! How cool is that! Etiam efficitur, sapien eget vehicula gravida, magna neque volutpat risus, vitae tempus odio arcu ac elit. Aenean porta orci eu mi fermentum varius. Curabitur ac sem at nibh egestas. Curabitur ac sem at nibh egestas.
                                        </p>
                                        <div class="thumbnail-gallery">
                                            <a class="img-thumbnail lightbox" href="img/projects/project-4.jpg" data-plugin-options='{ "type":"image" }'>
                                                <img class="img-fluid" width="215" src="img/projects/project-4.jpg">
                                                <span class="zoom">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="col-xl-6">
            <section class="card">
                <header class="card-header card-header-transparent">
                    <div class="card-actions">
                        <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                        <a href="#" class="card-action card-action-dismiss" data-card-dismiss></a>
                    </div>
    
                    <h2 class="card-title">Project Stats</h2>
                </header>
                <div class="card-body">
                    @livewire('tables.districts-summary')
                   
                </div>
            </section>
        </div>
    </div>
</div>

