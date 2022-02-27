<?php

namespace App\Http\Livewire\Tables;

use App\Models\Accountholder;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\District;
use App\Models\Market;
use App\Models\Marketvendor;
use App\Models\Placesofwork;
use App\Traits\Figures;

class DistrictsTable extends DataTableComponent
{
    use Figures;
    public function columns(): array
    {
        return [
            Column::make("District", "district")
                ->sortable(),
            Column::make("Work Stations", "districtid")
            ->format(function($value){
                $holders = Placesofwork::select('*')
                                    ->where('placesofwork.districtid', $value)
                                    //->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                    ->count();
                return  $holders;
                // $registeredMarkets = Market::select('*')->where('districtid', $value)->count();
                // return $this->readableThousands($registeredMarkets);
            })
                ->sortable(),
            Column::make("Account Holders", "districtid")
            ->format(function($value){
                $holders = Accountholder::select('*')
                                    ->where('placesofwork.districtid', $value)
                                    ->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                    ->count();
                return  $holders;
                // $registeredVendors = Marketvendor::select('*')->where('markets.districtid', $value)->leftjoin('markets', 'marketvendors.marketid', 'markets.marketid')->count();
                // return  $this->readableThousands($registeredVendors);
            })
                ->sortable(),
            Column::make("Population", "districtid")
                ->format(function($value){
                    $population = Placesofwork::select('prospectivepopulation')
                                     ->where('placesofwork.districtid', $value)
                                     ->sum('prospectivepopulation');
                    if($population) $population = $this->readableThousands($population);
                 return  $population;
                    // $registeredPopulation = Market::select('vendorpopulation')->where('districtid', $value)->sum('vendorpopulation');
                    // return $this->readableThousands($registeredPopulation);
                })
                    ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return District::query();
    }
}
