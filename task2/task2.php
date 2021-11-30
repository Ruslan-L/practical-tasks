<?php
function multipleAddition(int $x): int
{
    $number = array_sum(array_map('intval', str_split(abs($x))));
    return strlen($number) === 1 ? $number : multipleAddition($number);
}
echo multipleAddition(5689);