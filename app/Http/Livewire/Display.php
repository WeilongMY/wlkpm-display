<?php

namespace App\Http\Livewire;

use App\Integrations\PrayerTimes\PrayerTimes;
use App\Models\Parking1;
use App\Models\Parkgroup;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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

        try {
            while (1) {
                $connect = DB::connection()->getPdo();

                if ($connect) {
                    break;
                }
            }
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }

        switch($_SERVER['REMOTE_ADDR']){
            // South Car(gid 4). 78,79,80,81
            case "192.168.1.190":
                $totalLots = Parkgroup::where('groupid',4)->first();
                $totalOccupied = Parking1::where('state', 0)
                    ->where('date1',date('Y-m-d'))
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
                            ->orWhere('can', 'LIKE', "E-%%")
                            ->orWhere('can', 'LIKE', "V-%%");
                    })->count('sid');
                break;
            // Rooftop Car(gid 1). 34,35,82,83
            case "192.168.1.191":
                $totalLots = Parkgroup::where('groupid',1)->first();
                $totalOccupied = Parking1::where('state', 0)
                    ->where('date1',date('Y-m-d'))
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
                            ->orWhere('can', 'LIKE', "E-%%")
                            ->orWhere('can', 'LIKE', "V-%%");
                    })->count('sid');
                break;
            // North Car(gid 2). 30,31,32,33
            case "192.168.1.192":
                $totalLots = Parkgroup::where('groupid',2)->first();
                $totalOccupied = Parking1::where('state', 0)
                    ->where('date1',date('Y-m-d'))
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
                            ->orWhere('can', 'LIKE', "E-%%")
                            ->orWhere('can', 'LIKE', "V-%%");
                    })->count('sid');
                break;
            default:
                $totalLots = Parkgroup::where('groupid',0)->first();
                $totalOccupied = Parking1::where('state', 0)
                    ->where('date1',date('Y-m-d'))
                    ->where(function ($query) {
                        return $query->where('can', 'LIKE', "M-%%")
                            ->orWhere('can', 'LIKE', "I-%%")
                            ->orWhere('can', 'LIKE', "U0%%")
                            ->orWhere('can', 'LIKE', "E-%%")
                            ->orWhere('can', 'LIKE', "V-%%");
                    })->count('sid');
        }

        $availableLots = $totalLots->LIMIT1 - $totalOccupied;
        if ($availableLots < 0) {
            $this->count = 0;
        } else {
            $this->count = $availableLots;
        }
//        $pt = new PrayerTimes('ISNA');
//        $times = $pt->getTimesForToday(2.9264, 101.6964, 'Asia/Kuala_Lumpur', $elevation = null, $latitudeAdjustmentMethod = PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE, $midnightMode = PrayerTimes::MIDNIGHT_MODE_STANDARD, $format = PrayerTimes::TIME_FORMAT_24H);
//
//        $this->times = Arr::except($times, ['Imsak', 'Sunrise', 'Sunset', 'Midnight']);

        return view('livewire.display');
    }
}
