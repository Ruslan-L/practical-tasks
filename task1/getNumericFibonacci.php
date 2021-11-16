<?php
class Fibonacci
{
    private array $methods;

    public function __construct()
    {
        $this->methods = ['loop', 'recursive', 'tailRecursive', 'math'];
    }

    public function getNumeric(string $method, int $position): string
    {
        $key = array_search($method, $this->methods, true);

        return $method ? 'Число фибоначи равно: ' . $this->{$this->methods[$key]}($position) : "Неизвестный метод ($method)";
    }

    public function speedTest(): array
    {
        $results = [];

        foreach ($this->methods as $method) {
            $start = microtime(true);
            $x     = 0;

            while ($x <= 1000) { $this->{$method}(5); $x++; }

            $speed = (microtime(true) - $start);

            if (!array_key_exists('fast', $results) || $results['fast']['speed'] > $speed) {
                $results['fast'] = [
                    'method' => $method,
                    'speed'  => $speed
                ];
            }

            $results += [
                $method => "Скорость выполения($method): $speed c."
            ];
        }

        $results['fast'] = $results['fast']['method'] . ' - самый быстрый метод, скорость выполнения (' . $results['fast']['speed'] . ' c.)';

        return $results;
    }

    /* Math */
    private function math(int $position): int
    {
        return round((((sqrt(5) + 1) / 2) ** --$position) / sqrt(5));
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

        return $first;
    }

    /* Recursive */
    private function recursive(int $position, int $first = 0, int $second = 1): int
    {
        if ($position <= 1) { return $first; }

        return 0 + $this->recursive($position - 1, $second, $second + $first);
    }

    /* Recursive Tail */
    private function tailRecursive(int $position, int $first = 0, int $second = 1): int
    {
        return $position <= 1 ? $first : $this->tailRecursive($position - 1, $second, $second + $first);
    }
}

$fibonacci = new Fibonacci();

echo $fibonacci->getNumeric('math', 10);
echo var_dump($fibonacci->speedTest());
