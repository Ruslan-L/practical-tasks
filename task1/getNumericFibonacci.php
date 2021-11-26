<?php
class Fibonacci
{
    public const MATCH = 'math';
    public const LOOP = 'loop';
    public const RECURSIVE = 'recursive';
    public const TAIL_RECURSIVE = 'tailRecursive';

    private static array $methods = [self::MATCH, self::LOOP, self::RECURSIVE, self::TAIL_RECURSIVE];

    public function getFibonacci(string $method, int $position): string
    {
        if (in_array($method, self::$methods, true)) {
            return 'The fibonacci number is: ' . $this->{$method}($position);
        }

        return "Unknown method ($method)";
    }

    public function getSpeedTest(): array
    {
        $results = [];
        $fastMethod = '';
        $bestTime = INF;

        foreach (self::$methods as $key => $method) {
            $start = microtime(true);
            $x     = 0;

            while ($x <= 1000) {
                $this->{$method}(5);
                $x++;
            }

            $time = (microtime(true) - $start);

            if ($bestTime > $time) {
                $fastMethod = $method;
                $bestTime = $time;
            }

            $results += [
                $method => "Lead time($method): $time s."
            ];
        }

        $results['fast'] = $fastMethod . ' - fastest way, execution time (' . $bestTime . ' s.)';

        return $results;
    }

    /* Math */
    private function math(int $position): int
    {
        return round(pow((sqrt(5)+1)/2, $position) / sqrt(5));
    }

    /* Loop */
    private function loop(int $position): int
    {
        if ($position <= 1) {
            return $position;
        }

        $first = 0;
        $second = 1;

        for ($i = 1; $i < $position; $i++) {
            $firstSecond = $second;
            $second += $first;
            $first = $firstSecond;
        }

        return $second;
    }

    /* Recursive */
    public function recursive(int $position): int
    {
        if ($position === 0) {
            return 0;
        }

        if ($position === 1) {
            return 1;
        }

        return $this->recursive($position - 1) + $this->recursive($position - 2);
    }

    /* Recursive Tail */
    private function tailRecursive(int $position, int $first = 0, int $second = 1): int
    {
        return $position < 1 ? $first : $this->tailRecursive($position - 1, $second, $second + $first);
    }

//    private function recursive(int $position, int $first = 0, int $second = 1): int
//    {
//        return $position < 1 ? $first : 0 + $this->recursive($position - 1, $second, $second + $first);
//    }
}

$fibonacci = new Fibonacci();
echo $fibonacci->getFibonacci(Fibonacci::RECURSIVE, 6) . PHP_EOL;
echo implode(PHP_EOL, $fibonacci->getSpeedTest());
