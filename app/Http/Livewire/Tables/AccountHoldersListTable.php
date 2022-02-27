<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Accountholder;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\Figures;



class AccountHoldersListTable extends DataTableComponent
{
    use Figures;
    use LivewireAlert;
    public $activeHolder;
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'checkConfirmation' => 'alertConfirmed'
    ];
    public function columns(): array
    {
        return [
            Column::make('Action', 'accountholderid')
                ->format(function($value, $column, $row) {
                    
                    return '<a class="ws-normal pointer btn " href="'. url("/accountholderupdatepage/$value") .'"><i class="fas fa-edit"></i></a>
                    <a class="ws-normal pointer btn " wire:click="deleteRecord('. $value .')"><i class="fas fa-trash"></i></a>';
                })
                ->asHtml(),
            // Column::make("Accountholderid", "accountholderid")
            //     ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Work Station", "placeofwork")
                ->sortable(),
            Column::make("Business Nature", "category")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Turn Over", "dailyturnover")
                ->sortable(),
            Column::make("Registered By", "registrar")
                ->sortable(),
            Column::make("Registered", "dateregistered")
                ->format(function($value){
                    
                    return  $value->diffForHumans();
                })
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        $query = Accountholder::selectRaw('accountholderid, accountholders.name, placesofwork.placeofwork, businessnaturecategory.category,
                                            accountholders.address, accountholders.dailyturnover, users.name as registrar, 
                                            accountholders.dateregistered')
                                ->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                ->leftjoin('businessnaturecategory', 'accountholders.businessnaturecategoryid', 'businessnaturecategory.businessnaturecategoryid')
                                ->leftjoin('users', 'accountholders.registeredby', 'users.id')
                                ->orderBy('accountholders.accountholderid', 'desc'); 
        return $query;
    }


    public function deleteRecord($accountholderid)
    {
        $this->activeVendor = $accountholderid;
        $this->alert('question', 'Are you sure about this?' , [
            'position' =>  'center', 
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => "checkConfirmation"  
        ]);
        
        
        
    }

    public function alertConfirmed()
    {
        $holder = Accountholder::where('accountholderid', $this->activeVendor)->delete();
        $this->alert('success', 'Account Holder Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
    }
}
