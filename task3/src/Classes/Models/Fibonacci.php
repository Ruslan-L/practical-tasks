<?php

namespace App\Models;

class Fibonacci
{
    private string $first;
    private string $second;

    public function __construct()
    {
        $this->first = 0;
        $this->second = 1;
    }

    public function get(): string
    {
        if (strlen($this->second) >= 100) {
            return $this->second;
        }

        $this->first = $this->second;
        $this->second = $this->sum($this->first, $this->second);

        return $this->get();
    }

    private function sum(string $first, string $second, string $enhance = '', string $result = ''): string
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
}