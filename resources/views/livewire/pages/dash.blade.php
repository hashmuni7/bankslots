<div class="row mb-3">
    <div class="col-xl-6">
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
                            <h4 class="title">Market Vendors</h4>
                            <div class="info">
                                <strong class="amount">{{$accountHolders}}</strong>
                                <span class="text-primary">Registered</span>
                            </div>
                        </div>
                        <div class="summary-footer">
                            <a class="text-muted text-uppercase" href="{{ route('newholders')}}">(view all)</a>
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
</div>
