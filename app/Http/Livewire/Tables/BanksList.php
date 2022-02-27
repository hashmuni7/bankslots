<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Bank;

class BanksList extends DataTableComponent
{

    public function columns(): array
    {
        return [
            Column::make("Bankid", "bankid")
                ->sortable(),
            Column::make("Bank", "bank")
                ->sortable(),
            Column::make("Bankcode", "bankcode")
                ->sortable(),
            Column::make("Address", "address")
                ->sortable(),
            Column::make("Contact", "contact")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return Bank::query();
    }
}
