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
                        @livewire('tables.places-of-work-table')
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



