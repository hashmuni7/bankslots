<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Placesofworkcategory;

class PlacesOfWorkTable extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Placesofworkcategoryid", "placesofworkcategoryid")
                ->sortable(),
            Column::make("Placecategory", "placecategory")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Placesofworkcategory::query();
    }
}
