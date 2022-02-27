<div>
    <x-slot name="title">
        Registered Banks
    </x-slot>
    

    <x-slot name="header">
        <header class="page-header">
            <h2>Registered Banks</h2>
        
            <div class="right-wrapper text-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard')}}">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>                     
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
    
                    <h2 class="card-title">Banks Registered</h2>
                    <p class="card-subtitle">{{--$landlord->id--}}</p>
                </header>
                <div class="card-body">
                    @livewire('tables.banks-list')
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




