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
    public $message;
    public $info;
    public $count;

    public function render()
    {
        $jsonString = Storage::disk('public')->get('config.json');
        $data = json_decode($jsonString);

        $this->greeting = $data->greeting;
        $this->message = $data->message;
        $this->info = $data->info;

        switch($_SERVER['REMOTE_ADDR']){
            // South Car. 78,79,80,81
            case "192.168.1.190":
                $this->count = Parking1::where('state', 0)
                    ->where(function ($query) {
                        return $query->where('sid', 78)
                            ->orWhere('sid', 79)
                            ->orWhere('sid', 80)
                            ->orWhere('sid', 81);
                    })
                    ->where(function ($query) {
                        return $query->where('can', 'LIKE', "M-%%")
                            ->orWhere('can', 'LIKE', "I-%%")
                            ->orWhere('can', 'LIKE', "U0%%")
                            ->orWhere('can', 'LIKE', "E0%%");
                    })->count('sid');
                break;
            // Rooftop Car. 34,35,82,83
            case "192.168.1.191":
                $this->count = Parking1::where('state', 0)
                    ->where(function ($query) {
                        return $query->where('sid', 34)
                            ->orWhere('sid', 35)
                            ->orWhere('sid', 82)
                            ->orWhere('sid', 83);
                    })
                    ->where(function ($query) {
                        return $query->where('can', 'LIKE', "M-%%")
                            ->orWhere('can', 'LIKE', "I-%%")
                            ->orWhere('can', 'LIKE', "U0%%")
                            ->orWhere('can', 'LIKE', "E0%%");
                    })->count('sid');
                break;
            // North Car. 30,31,32,33
            case "192.168.1.192":
                $this->count = Parking1::where('state', 0)
                    ->where(function ($query) {
                        return $query->where('sid', 30)
                            ->orWhere('sid', 31)
                            ->orWhere('sid', 32)
                            ->orWhere('sid', 33);
                    })
                    ->where(function ($query) {
                        return $query->where('can', 'LIKE', "M-%%")
                            ->orWhere('can', 'LIKE', "I-%%")
                            ->orWhere('can', 'LIKE', "U0%%")
                            ->orWhere('can', 'LIKE', "E0%%");
                    })->count('sid');
                break;
            default:
                $this->count = Parking1::where('state', 0)
                    ->where(function ($query) {
                        return $query->where('can', 'LIKE', "M-%%")
                            ->orWhere('can', 'LIKE', "I-%%")
                            ->orWhere('can', 'LIKE', "U0%%")
                            ->orWhere('can', 'LIKE', "E0%%");
                    })->count('sid');
        }

//        $pt = new PrayerTimes('ISNA');
//        $times = $pt->getTimesForToday(2.9264, 101.6964, 'Asia/Kuala_Lumpur', $elevation = null, $latitudeAdjustmentMethod = PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE, $midnightMode = PrayerTimes::MIDNIGHT_MODE_STANDARD, $format = PrayerTimes::TIME_FORMAT_24H);
//
//        $this->times = Arr::except($times, ['Imsak', 'Sunrise', 'Sunset', 'Midnight']);

        return view('livewire.display');
    }
}
