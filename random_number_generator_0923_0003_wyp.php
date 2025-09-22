<?php
// 代码生成时间: 2025-09-23 00:03:25
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class RandomNumberGenerator
{
    // Minimum and maximum range for generated numbers
    private int $minRange;
    private int $maxRange;

    /**
     * Constructor to initialize minimum and maximum range.
     *
     * @param int $minRange Minimum value range.
     * @param int $maxRange Maximum value range.
     */
    public function __construct(int $minRange = 1, int $maxRange = 100)
    {
        $this->minRange = $minRange;
        $this->maxRange = $maxRange;
    }

    /**
     * Generate a random number within the defined range.
     *
     * @return int Random number between minRange and maxRange.
     */
    public function generate(): int
    {
        if ($this->minRange > $this->maxRange) {
            throw new \Exception('Minimum range cannot be greater than maximum range.');
        }

        return random_int($this->minRange, $this->maxRange);
    }
}

// Example usage
try {
    $randomNumberGenerator = new RandomNumberGenerator();
    $randomNumber = $randomNumberGenerator->generate();
    echo "Generated Random Number: {$randomNumber}";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
