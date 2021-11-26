<?php
function multipleAddition(int $x): int
{
    $number = array_sum(array_map('intval', str_split($x)));
    return count($number) !== 1 ? multipleAddition($number) : $number;
}
echo multipleAddition(5689);