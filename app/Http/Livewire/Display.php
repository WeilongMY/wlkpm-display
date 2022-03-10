<?php

namespace App\Http\Livewire;

use App\Integrations\PrayerTimes\PrayerTimes;
use App\Models\Parking1;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Display extends Component
{
    public $times;
    public $greeting;
    public $count;

    public function render()
    {
        $jsonString = Storage::disk('public')->get('config.json');
        $data = json_decode(trim($jsonString));

        $this->greeting = $data->greeting;

        $this->count = Parking1::where('state', 0)
            ->where(function ($query) {
                return $query->where('can', 'LIKE', 'M-%%')
                    ->orWhere('can', 'LIKE', 'I-%%')
                    ->orWhere('can', 'LIKE', 'U0%%')
                    ->orWhere('can', 'LIKE', 'E0%%');
            })->count('id');

        $pt = new PrayerTimes('ISNA');
        $times = $pt->getTimesForToday(2.9264, 101.6964, 'Asia/Kuala_Lumpur', $elevation = null, $latitudeAdjustmentMethod = PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE, $midnightMode = PrayerTimes::MIDNIGHT_MODE_STANDARD, $format = PrayerTimes::TIME_FORMAT_24H);

        $this->times = Arr::except($times, ['Imsak', 'Sunrise', 'Sunset', 'Midnight']);

        return view('livewire.display');
    }
}
