<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\District;
use App\Models\Accountholder;
use App\Models\Placesofwork;
use App\Traits\Figures;

class DistrictsSummary extends DataTableComponent
{
    use Figures;
    public function columns(): array
    {
        return [
            Column::make("District", "district")
                ->sortable(),
            Column::make("Account Holders", "districtid")
            ->format(function($value){
               $holders = Accountholder::select('*')
                                    ->where('placesofwork.districtid', $value)
                                    ->leftjoin('placesofwork', 'accountholders.placesofworkid', 'placesofwork.placesofworkid')
                                    ->count();
                return  $holders; //$this->readableThousands($registeredVendors);
            })
                ->sortable(),
            Column::make("Prospective", "districtid")
            ->format(function($value){
                $population = Placesofwork::select('prospectivepopulation')
                                     ->where('placesofwork.districtid', $value)
                                     ->sum('prospectivepopulation');
                 return $this->readableThousands($population);
             })
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return District::query();
    }
}
