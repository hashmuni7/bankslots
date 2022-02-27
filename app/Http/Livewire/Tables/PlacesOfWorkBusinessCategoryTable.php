<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Businessnaturecategory;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Carbon\Carbon;
use App\Traits\Figures;

class PlacesOfWorkBusinessCategoryTable extends DataTableComponent
{
    use LivewireAlert;
    use Figures;
    public $placeOfWorkCategoryID;
    protected $listeners = ['refreshComponent' => '$refresh'];
    

    public function mount($placeOfWorkCategoryID)
    {
        $this->placeOfWorkCategoryID = $placeOfWorkCategoryID;
    }

    public function columns(): array
    {
        return [
            // Column::make("Businessnaturecategoryid", "businessnaturecategoryid")
            //     ->sortable(),
            // Column::make("Placesofworkcategoryid", "placesofworkcategoryid")
            //     ->sortable(),
            Column::make("Category", "category")
                ->sortable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make('Action', 'businessnaturecategoryid')
                ->format(function($value, $column, $row) {
                    
                    return '<a class="ws-normal pointer btn btn-xs" onclick="window.scrollTo(0, 0);" wire:click="update('. $value .')"><i class="icons icon-options"></i></a>';
                })
                ->asHtml(),
        ];
    }

    public function query(): Builder
    {
        //$query = Businessnaturecategory::selectRaw('')
        $query = Businessnaturecategory::query()->where('placesofworkcategoryid', $this->placeOfWorkCategoryID)
                                        ->orderBy('businessnaturecategoryid', 'desc');
        return $query;
    }

    public function update($businessnaturecategoryid)
    {
         $this->emitTo('pages.new-business-nature-category-page','updateBusinessCategoryInfo', $businessnaturecategoryid);
        
    }
}
