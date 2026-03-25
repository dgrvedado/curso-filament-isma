<?php

namespace App\Filament\Personal\Resources\Holidays\Pages;

use App\Filament\Personal\Resources\Holidays\HolidayResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHoliday extends CreateRecord
{
    protected static string $resource = HolidayResource::class;
}
