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

    const LIST_PERCENT_BOT_TWO = [
        23.6,
        50,
        61.8,
        76.4
    ];

    const LIST_PERCENT_BOT_FOUR = [
        23.6,
        38.2,
        50,
        61.8
    ];

    const LIST_PERCENT_TOP_FIVE = [
        38.2,
        61.8,
        161.8
    ];

    const BTC_PRICE_USD = 60527.30;

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

            // Calculate range between bottom 1 and top 1
            $subOfPointOne = $this->topOne - $this->bottomOne;

            // Calculate range between top 1 and bottom 2
            $subOfPointTow = $this->topOne - $this->bottomTwo;

            $response['data']['bottom_2']['percent'] =  $subOfPointTow/$subOfPointOne * 100;

            foreach (self::LIST_PERCENT_TOP_THREE as $val) {
                $response['data']['bottom_3'][$val] = $this->bottomTwo + ($val * $subOfPointOne/100);
            }

            // Extend
            $response['data']['bottom_2']['future'] = $this->calculateBottomTwo($subOfPointOne, $this->bottomOne);

            $response['data']['future_list'] = $this->generateTemplateFuture($response['data']['bottom_2']['future']);


        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());

            $response = [
                'status'  => 0,
                'message' => $e->getMessage()
            ];
        }

        $this->dispatchBrowserEvent('calculate-coin', $response);

    }

    /**
     * Calculate bottom 2 base on bottom 1 and top 1 sub range
     *
     * @param float $rangeValue = top 1 - bot 1
     *
     * @return array $result
     *
     */
    private function calculateBottomTwo($rangeValue, $bottomOne)
    {
        $result = [];
        foreach (self::LIST_PERCENT_BOT_TWO as $val) {
            $value = $bottomOne + $rangeValue - ($rangeValue * $val/100);
            $result[$val] = [
                'value'    => $value,
                'name'     => 'bot_2',
                'sub_list' => $this->calculateTopThree($rangeValue, $value)
            ];
        }

        return $result;
    }

    /**
     * Calculate top 3 base on bottom 2 and sub of bottom 1 and top 1
     *
     * @param float $rangeValue = top 1 - bot 1
     * @param float $bottomTwo
     *
     * @return array $result
     *
     */
    private function calculateTopThree($rangeValue, $bottomTwo)
    {
        $result = [];
        foreach (self::LIST_PERCENT_TOP_THREE as $val) {
            $distance = ($bottomTwo + ($rangeValue * $val/100)) - $bottomTwo;

            $result[$val] = [
                'value'    => $bottomTwo + ($rangeValue * $val/100),
                'name'     => 'top_3',
                'sub_list' => $this->calculateBotFour($distance, $bottomTwo)
            ];
        }

        return $result;
    }

    /**
     * Calculate bottom 4 base on bottom 2 and top 3 sub range
     *
     * @param float $rangeValue = top 3 - bot 2
     *
     * @return array $result
     *
     */
    private function calculateBotFour($rangeValue, $bottomTwo)
    {
        $result = [];
        foreach (self::LIST_PERCENT_BOT_FOUR as $val) {
            $rangeValueOne = ($this->topOne - $this->bottomOne);
            $value = $bottomTwo + $rangeValue - ($rangeValue * $val/100);

            $result[$val] = [
                'value'    => $bottomTwo + $rangeValue - ($rangeValue * $val/100),
                'name'     => 'bot_4',
                'sub_list' => $this->calculateTopFive($rangeValueOne, $rangeValue, $value)
            ];
        }

        return $result;
    }

    /**
     * Calculate top 5 base on bottom 4 and sub of bottom 1 and top 1 && sub of bottom 2 and top 3
     *
     * @param float $rangeValueOne = top 1 - bot 1
     * @param float $rangeValueThree = top 3 - bot 2
     * @param float $bottomFour
     *
     * @return array $result
     *
     */
    private function calculateTopFive($rangeValueOne, $rangeValueThree, $bottomFour)
    {
        $result = [];
        foreach (self::LIST_PERCENT_TOP_FIVE as $key => $val) {
            $sumOneThree = ($rangeValueOne + $rangeValueThree);

            $result[$val] = [
                'value'    => $bottomFour + ($sumOneThree * $val/100),
                'name'     => 'top_5',
                'sub_list' => []
            ];
        }

        return $result;
    }

    private function generateTemplateFuture($list)
    {

        $result = [];
        foreach ($list as $key => $info) {
            if (is_array($info)) {
                $result[$key] = response()->view("admin.coin.list_sub_child_value", $info)->content();
            }
        }

        return $result;
    }
}
