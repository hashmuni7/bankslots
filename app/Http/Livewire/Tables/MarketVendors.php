<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Marketvendor;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\Figures;

class MarketVendors extends DataTableComponent
{
    use Figures;
    use LivewireAlert;
    public $activeVendor;
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'checkConfirmation' => 'alertConfirmed'
    ];
    public function columns(): array
    {
        return [
            Column::make('Action', 'marketvendorid')
                ->format(function($value, $column, $row) {
                    
                    return '<a class="ws-normal pointer btn " href="'. url("/updatevendor/$value") .'"><i class="fas fa-edit"></i></a>
                    <a class="ws-normal pointer btn " wire:click="deleteVendor('. $value .')"><i class="fas fa-trash"></i></a>';
                })
                ->asHtml(),
            Column::make("Name", "holder")
                ->sortable()
                ->searchable(),
            Column::make("Residence", "residenceplace")
                ->sortable(),
            Column::make("Market", "marketname")
                ->sortable(),
            Column::make("Business Nature", "businessnature")
                ->sortable(),
            Column::make("Turn Over", "dailyturnover")
                    ->format(function($value){
                        return $this->ugx($value);
                    })
                ->sortable(),
            Column::make("Registered By", "registrar")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Marketvendor::query()
                             ->selectRaw('marketvendorid, marketvendors.name as holder, gender, marketvendors.phonenumber, nin, residenceplace,
                              businessplace, marketvendors.businessnatureid, businessnature.businessnature,
                              dailyturnover, accountnumber, users.name as registrar, markets.marketname')
                             ->leftjoin('businessnature', 'marketvendors.businessnatureid', 'businessnature.businessnatureid')
                             ->leftjoin('markets', 'marketvendors.marketid', 'markets.marketid')
                             ->leftjoin('users', 'marketvendors.registeredby', 'users.id')
                             ->orderBy('marketvendors.marketvendorid', 'desc'); 
    }

    public function update($vendorid)
    {
         $this->emitTo('pages.new-holder','updateVendorInfo', $vendorid);
        // $this->alert('success', "Ready To Update" , [
        //     'position' =>  'top-end', 
        //     'timer' =>  3000,  
        //     'toast' =>  true,  
        // ]);
    }

    public function deleteVendor($vendorid)
    {
        $this->activeVendor = $vendorid;
        $this->alert('question', 'Are you sure about this?' , [
            'position' =>  'center', 
            'toast' => false,
            'showConfirmButton' => true,
            'onConfirmed' => "checkConfirmation"  
        ]);
        
        
        
    }

    public function alertConfirmed()
    {
        $holder = Marketvendor::where('marketvendorid', $this->activeVendor)->delete();
        $this->alert('success', 'Vendor Deleted' , [
            'position' =>  'top-end', 
            'timer' =>  3000,  
            'toast' =>  true,  
        ]);
    }
}
