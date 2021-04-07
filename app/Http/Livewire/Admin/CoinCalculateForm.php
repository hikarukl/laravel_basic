<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CoinCalculateForm extends Component
{
    const LIST_PERCENT_TOP_THREE = [
        161.8,
        261.8,
        461.8
    ];
    public $bottomOne;
    public $topOne;
    public $bottomTwo;
    public $topThree;

    public function render()
    {
        return view('livewire.admin.coin-calculate-form');
    }

    public function calculateCoin()
    {
        try {
            $response = [
                'status'  => 1,
                'message' => 'Calculated',
                'data'    => []
            ];

            $subOfPointOne = $this->topOne - $this->bottomOne;

            foreach (self::LIST_PERCENT_TOP_THREE as $val) {
                $response['data'][$val] = $this->bottomTwo + ($val * $subOfPointOne/100);
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $response = [
                'status'  => 0,
                'message' => $e->getMessage()
            ];
        }

        $this->dispatchBrowserEvent('calculate-coin', $response);

    }
}
