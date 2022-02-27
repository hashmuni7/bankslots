<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Market;
use App\Models\Marketvendor;
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
                    return $this->readableThousands($value);
                })
                ->sortable(),
            Column::make("Contact", "contactname")
                ->sortable(),
            Column::make("Phone", "contactphone")
                ->sortable(),
            
            Column::make("Registered", "marketid")
                ->format(function($value){
                    $registeredVendors = Marketvendor::select('*')->where('marketid', $value)->count();
                    return $registeredVendors;
                })
                ->sortable(),
            Column::make("Percentage", "marketid")
                ->format(function($value, $column, $row){
                    $registeredVendors = Marketvendor::select('*')->where('marketid', $value)->count();
                    $percentage = $registeredVendors ? (($registeredVendors / $row->vendorpopulation)* 100) .'%' : '0%';
                    return $percentage;
                })
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
        $query = Market::query()
                        ->leftjoin('districts', 'markets.districtid', 'districts.districtid')
                        ->orderBy('marketid', 'desc');
        // $query = Market::selectRaw('markets.marketid, markets.marketname, districts.district, markets.vendorpopulation, markets.contactname,
        //                             markets.contactphone, markets.marketcode, (select count(*) where marketvendors.marketid = markets.marketid) As vendors_count ')
        //                 ->leftjoin('districts', 'markets.districtid', 'districts.districtid')
        //                  ->orderBy('marketid', 'desc');
        //dd($query);
        return $query;
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
