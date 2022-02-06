<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\District;
use App\Models\Market;
use App\Models\Marketvendor;
use App\Traits\Figures;

class DistrictsTable extends DataTableComponent
{
    use Figures;
    public function columns(): array
    {
        return [
            Column::make("District", "district")
                ->sortable(),
            Column::make("Markets", "districtid")
            ->format(function($value){
                $registeredMarkets = Market::select('*')->where('districtid', $value)->count();
                return $this->reableThousands($registeredMarkets);
            })
                ->sortable(),
            Column::make("Vendors", "districtid")
            ->format(function($value){
                $registeredVendors = Marketvendor::select('*')->where('markets.districtid', $value)->leftjoin('markets', 'marketvendors.marketid', 'markets.marketid')->count();
                return  $this->reableThousands($registeredVendors);
            })
                ->sortable(),
            Column::make("Population", "districtid")
                ->format(function($value){
                    $registeredPopulation = Market::select('vendorpopulation')->where('districtid', $value)->sum('vendorpopulation');
                    return $this->reableThousands($registeredPopulation);
                })
                    ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return District::query();
    }
}
