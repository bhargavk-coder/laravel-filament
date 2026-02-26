<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use App\Models\Customer;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Enums\IconPosition;
use Illuminate\Database\Eloquent\Builder;

class ListCustomers extends ListRecords
{
    protected static string $resource = CustomerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make()->iconPosition(IconPosition::Before)
                ->icon('heroicon-o-users')->badge(fn() => Customer::count())->badgeColor('primary'),
            'active' => Tab::make()->badge(fn() => Customer::where('status', true)->count())->badgeColor('success')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', true)),
            'inactive' => Tab::make()->badge(fn() => Customer::where('status', false)->count())->badgeColor('danger')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', false)),
        ];
    }
    public function getDefaultActiveTab(): string | int | null
    {
        return 'active';
    }
}
