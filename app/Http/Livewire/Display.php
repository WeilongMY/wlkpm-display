<?php

namespace App\Http\Livewire;

use App\Models\Parking1;
use App\Models\Parkgroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Display extends Component
{
    public $times;
    public $count = 0;
    public $datetime;

    public function getTotalLots($groupId)
    {
        return Parkgroup::where('groupid', $groupId)->first();
    }

    public function getTotalOccupied($sids)
    {
        return Parking1::where('state', 0)
            ->where('date1',date('Y-m-d'))
            ->where(function ($query) use ($sids) {
                return $query->whereIn('sid', $sids);
            })
            ->where(function ($query) {
                return $query->where('can', 'LIKE', "M-%%")
                    ->orWhere('can', 'LIKE', "I-%%")
                    ->orWhere('can', 'LIKE', "U0%%")
                    ->orWhere('can', 'LIKE', "E-%%")
                    ->orWhere('can', 'LIKE', "V-%%");
            })->count('sid');
    }

    public function render()
    {
        try {
            $pdo = DB::connection()->getPdo();

            if($pdo) {
                switch(request()->ip()){
                    // South Car(gid 4). 78,79,80,81
                    case "192.168.1.190":
                        $totalLots = $this->getTotalLots(4);
                        $sids = ['78', '79', '80', '81'];
                        $totalOccupied = $this->getTotalOccupied($sids);
                        break;
                    // Rooftop Car(gid 1). 34,35,82,83
                    case "192.168.1.191":
                        $totalLots = $this->getTotalLots(1);
                        $sids = ['34', '35', '82', '83'];
                        $totalOccupied = $this->getTotalOccupied($sids);
                        break;
                    // North Car(gid 2). 30,31,32,33
                    case "192.168.1.192":
                        $totalLots = $this->getTotalLots(2);
                        $sids = ['30', '31', '32', '33'];
                        $totalOccupied = $this->getTotalOccupied($sids);
                        break;
                    default:
                        $totalLots = $this->getTotalLots(0);
                        $sids = [0];
                        $totalOccupied = $this->getTotalOccupied($sids);
                }

                $availableLots = $totalLots->LIMIT1 - $totalOccupied;

                if ($availableLots > 0) {
                    $this->count = $availableLots;
                }
            } else{
                Log::error("Database error");
            }
        } catch (\Exception $e) {
            Log::error("Database error ". $e);
        }

        $this->datetime = Carbon::now()->format('l, d M Y')." | ".Carbon::now()->format('H:i');

        return view('livewire.display');
    }
}
