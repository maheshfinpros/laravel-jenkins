<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Auth\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use function PHPUnit\Framework\isEmpty;

/**
 * Class RolesTable.
 */
class RolesTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function builder(): Builder
    {
        return Role::with('permissions:id,name,description')
            ->withCount('users')
            ->when($this->getFilter('search'), fn ($query, $term) => $query->search($term));
    }
    public function getFilter($column): bool
    {
        return !(isEmpty($this->columnSearch[$column] ?? null));
    }
    public function columns(): array
    {
        return [
            Column::make(__('Type'))
                ->sortable(),
            Column::make(__('Name'))
                ->sortable(),
//            Column::make(__('Permissions')),
//            Column::make(__('Number of Users'), 'users_count')
//                ->sortable(),
//            Column::make(__('Actions')),
        ];
    }

    public function rowView(): string
    {
        return 'backend.auth.role.includes.row';
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
}
