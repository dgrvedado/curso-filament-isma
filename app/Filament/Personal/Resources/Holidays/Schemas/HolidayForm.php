<?php

namespace App\Filament\Personal\Resources\Holidays\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class HolidayForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('calendar_id')
                    ->relationship('calendar', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                DatePicker::make('day')
                    ->required(),
                Select::make('type')
                    ->options(['decline' => 'Decline', 'approved' => 'Approved', 'pending' => 'Pending'])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
