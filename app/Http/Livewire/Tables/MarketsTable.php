<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Market;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\Figures;

class MarketsTable extends DataTableComponent
{
    use Figures;
    use LivewireAlert;
    protected $listeners = ['refreshComponent' => '$refresh'];
    public function columns(): array
    {
        return [
            Column::make("Market", "marketname")
                ->sortable(),
            Column::make("District", "district")
                ->sortable(),
            Column::make("Vendors", "vendorpopulation")
                ->format(function($value){
                    return $this->reableThousands($value);
                })
                ->sortable(),
            Column::make("Contact", "contactname")
                ->sortable(),
            Column::make("Phone", "contactphone")
                ->sortable(),
            Column::make("Market Code", "marketcode")
                ->sortable(),
            Column::make('Action', 'marketid')
                ->format(function($value, $column, $row) {
                    
                    return '<a class="ws-normal pointer btn btn-xs" onclick="window.scrollTo(0, 0);" wire:click="update('. $value .')"><i class="icons icon-options"></i></a>';
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Market::query()
                        ->leftjoin('districts', 'markets.districtid', 'districts.districtid')
                        ->orderBy('marketid', 'desc');
    }

    public function update($marketid)
    {
         $this->emitTo('pages.markets','updateMarketInfo', $marketid);
        // $this->alert('success', "Ready To Update" , [
        //     'position' =>  'top-end', 
        //     'timer' =>  3000,  
        //     'toast' =>  true,  
        // ]);
    }
}
