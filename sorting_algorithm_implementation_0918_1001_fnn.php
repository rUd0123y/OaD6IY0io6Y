<?php
// 代码生成时间: 2025-09-18 10:01:37
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\Autowired;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

/**
 * SortingService class
 *
 * This class provides methods for sorting an array of integers using different algorithms.
 */
# 优化算法效率
class SortingService {
# 扩展功能模块

    /**
# 改进用户体验
     * Sorts an array using bubble sort algorithm.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
# 改进用户体验
     * @throws InvalidArgumentException If the input is not an array.
# 改进用户体验
     */
# FIXME: 处理边界情况
    public function bubbleSort(array $array): array {
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
        }

        $length = count($array);
# 扩展功能模块
        for ($i = 0; $i < $length - 1; $i++) {
# 添加错误处理
            for ($j = 0; $j < $length - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap elements
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
# 优化算法效率
            }
        }

        return $array;
    }

    /**
     * Sorts an array using insertion sort algorithm.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
     * @throws InvalidArgumentException If the input is not an array.
     */
    public function insertionSort(array $array): array {
# 扩展功能模块
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
# 优化算法效率
        }

        for ($i = 1; $i < count($array); $i++) {
# 增强安全性
            $key = $array[$i];
            $j = $i - 1;

            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
            $array[$j + 1] = $key;
        }

        return $array;
    }

    /**
     * Sorts an array using selection sort algorithm.
     *
     * @param array $array The array to sort.
     * @return array The sorted array.
     * @throws InvalidArgumentException If the input is not an array.
     */
# 添加错误处理
    public function selectionSort(array $array): array {
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
        }

        for ($i = 0; $i < count($array) - 1; $i++) {
            $minIndex = $i;
            for ($j = $i + 1; $j < count($array); $j++) {
                if ($array[$j] < $array[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap elements
            if ($minIndex != $i) {
                $temp = $array[$i];
                $array[$i] = $array[$minIndex];
                $array[$minIndex] = $temp;
            }
        }

        return $array;
    }
}

// Usage example
$sortingService = new SortingService();
# NOTE: 重要实现细节
$unsortedArray = [5, 3, 8, 4, 2];
# 增强安全性

try {
    $sortedArray = $sortingService->bubbleSort($unsortedArray);
    print_r($sortedArray);
} catch (InvalidArgumentException $e) {
    echo 'Error: ' . $e->getMessage();
}
