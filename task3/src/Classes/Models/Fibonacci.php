<?php

namespace App\Models;

class Fibonacci
{
    private function sum($first, $second, $enhance = '', $result = ''): string
    {
        $nextValueFirst = strlen($first) > 1 ? substr($first, 0, -1) : '';
        $nextValueSecond = strlen($second) > 1 ? substr($second, 0, -1) : '';

        $currentValuesFirst = substr($first, -1);
        $currentValuesSecond = substr($second, -1);

        if ($currentValuesFirst) {
            $sum = +$currentValuesSecond + +$currentValuesFirst;
        } else {
            $sum = $currentValuesSecond;
        }

        if ($enhance) {
            $sum += $enhance;
        }

        if ($nextValueSecond && strlen($sum) > 1) {
            $enhance = substr($sum, 0, -1);
            $result =  substr($sum, -1) . $result;
        } else {
            $enhance = '';
            $result = $sum . $result;
        }

        if ($nextValueSecond) {
            return $this->sum($nextValueFirst, $nextValueSecond, $enhance, $result);
        }

        return $result;
    }

    public function get($first = '0', $second = '1'): string
    {
        return strlen($second) >= 100 ? $second : $this->get($second, $this->sum($first, $second));
    }
}