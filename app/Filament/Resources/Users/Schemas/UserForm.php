<?php

namespace App\Filament\Resources\Users\Schemas;

//use Filament\Forms\Components\DateTimePicker;

use App\Models\City;
use App\Models\State;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Collection;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->description('Information about the user')
                    ->columnSpan('full')
                    ->columns(3)

                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required(),
                        //DateTimePicker::make('email_verified_at'),
                        TextInput::make('password')
                            ->hiddenOn('edit')
                            ->password()
                            ->required(),
                    ]),
                Section::make('Address Information')
                    ->columnSpan('full')
                    ->columns(3)

                    ->schema([
                        Select::make('country_id')
                            ->label('Country')
                            ->relationship('country', 'name')
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => [
                                $set('state_id', null),
                                $set('city_id', null),
                            ])
                            ->required(),
                        Select::make('state_id')
                            ->label('State')
                            ->options(fn (Get $get): Collection => State::query()
                                ->where('country_id', $get('country_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(fn (Set $set) => [$set('city_id', null)])
                            ->required(),
                        Select::make('city_id')
                            ->label('City')
                            ->options(fn (Get $get): Collection => City::query()
                                ->where('state_id', $get('state_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('address')
                            ->required(),
                        TextInput::make('postal_code')
                            ->required(),
                    ]),
            ]);
    }
}
