<?php
class Fibonacci
{
    private array $methods;

    public function __construct()
    {
        $this->methods = ['math', 'loop', 'recursive', 'tailRecursive'];
    }

    public function getFibonacci(string $method, int $position): string
    {
        $result = in_array($method, $this->methods, true) ?
            'The fibonacci number is: ' . $this->{$method}($position) :
            "Unknown method ($method)";

        return $result . PHP_EOL;
    }

    public function getResultSpeedTest(): void
    {
        foreach ($this->speedTest() as $value) {
            echo $value . PHP_EOL;
        }
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    private function speedTest(): array
    {
        $results = [];
        $fastMethod = '';
        $bestTime = 0;

        foreach ($this->methods as $method) {
            $start = microtime(true);
            $x     = 0;

            while ($x <= 1000) {
                $this->{$method}(5);
                $x++;
            }

            $time = (microtime(true) - $start);

            if ($bestTime > $time || $bestTime === 0) {
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
        $first = 0;
        $second = 1;

        for ($i = 1; $i < $position; $i++) {
            $firstSecond = $second;
            $second += $first;
            $first = $firstSecond;
        }

        return $position <= 1 ? $position : $second;
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
//    private function recursive(int $position, int $first = 0, int $second = 1): int
//    {
//        return $position < 1 ? $first : 0 + $this->recursive($position - 1, $second, $second + $first);
//    }

    /* Recursive Tail */
    private function tailRecursive(int $position, int $first = 0, int $second = 1): int
    {
        return $position < 1 ? $first : $this->tailRecursive($position - 1, $second, $second + $first);
    }
}

$fibonacci = new Fibonacci();
echo $fibonacci->getFibonacci('recursive', 6);
echo $fibonacci->getResultSpeedTest();
