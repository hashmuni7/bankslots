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
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function columns(): array
    {
        return [
            Column::make('Action', 'marketvendorid')
                ->format(function($value, $column, $row) {
                    
                    return '<a class="ws-normal pointer btn btn-xs" onclick="window.scrollTo(0, 0);" wire:click="update('. $value .')"><i class="icons icon-options"></i></a>';
                })
                ->asHtml(),
            Column::make("Name", "holder")
                ->sortable(),
            Column::make("Gender", "gender")
                ->format(function($value){
                    if($value == 1){return "Male";}elseif($value == 0){return "Female";}
                })
                ->sortable(),
            Column::make("Phone", "phonenumber")
                ->sortable(),
            Column::make("NIN", "nin")
                ->sortable(),
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
            Column::make("Account ", "accountnumber")
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
}
