<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Tabs\Tab;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),

            'active' => Tab::make('Active')
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('is_active', 1)
                ),

            'inactive' => Tab::make('Inactive')
                ->modifyQueryUsing(
                    fn(Builder $query) =>
                    $query->where('is_active', 0)
                ),
        ];
    }
}
