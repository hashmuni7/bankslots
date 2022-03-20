<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Placesofwork;
use App\Models\Accountholder;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Traits\Figures;

class PlacesOfWorkStationsTable extends DataTableComponent
{
    use Figures;
    use LivewireAlert;
    protected $listeners = ['refreshComponent' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Market", "placeofwork")
                ->searchable()
                ->sortable(),
            Column::make("Districtid", "district")
                ->sortable(),
            Column::make("Population", "prospectivepopulation") // $this->readableThousands(
                ->format(function($value){
                    return $this->readableThousands($value);
                })
                ->sortable(),
            Column::make("Account Holders", "placesofworkid")
                ->format(function($value, $column, $row){
                    $registeredVendors = Accountholder::select('*')->where('placesofworkid', $value)->count();
                    return $registeredVendors;
                })
                ->sortable(),
            Column::make("Percentage", "placesofworkid")
                ->format(function($value, $column, $row){
                    $registeredVendors = Accountholder::select('*')->where('placesofworkid', $value)->count();
                    $percentage = $registeredVendors ? round((($registeredVendors / $row->prospectivepopulation)* 100)) .'%' : '0%';
                    return $percentage;
                })
                ->sortable(),
            Column::make("Contact", "contactname")
                ->sortable(),
            Column::make("Phone", "contactphone")
                ->sortable(),
            Column::make('Action', 'placesofworkid')
                ->format(function($value, $column, $row) {
                    return '<a class="ws-normal pointer btn btn-xs" onclick="window.scrollTo(0, 0);" wire:click="update('. $value .')"><i class="icons icon-options"></i></a>';
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        return Placesofwork::query()
                            ->leftjoin('placesofworkcategory', 'placesofwork.placesofworkcategoryid', 'placesofworkcategory.placesofworkcategoryid')
                            ->leftjoin('districts', 'placesofwork.districtid', 'districts.districtid')
                            ->orderBy('placesofworkid', 'desc');
    }

    public function update($placesofworkid)
    {
         $this->emitTo('pages.places-of-work-page','updatePlaceOfWorkInfo', $placesofworkid);
    }
}
