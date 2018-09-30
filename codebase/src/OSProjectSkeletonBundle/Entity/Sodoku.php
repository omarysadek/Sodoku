<?php

namespace OSProjectSkeletonBundle\Entity;

class Sodoku
{
    private $grid;

    private $gridSize;

    private $sqrt;

    /*
     * @param array $grid
     */
    public function __construct(array $grid)
    {
        $this->grid = $grid;
        $this->gridSize = count($grid[0]);
        $this->sqrt = sqrt($this->gridSize);
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $usedNumbers = $lineBuffer = $toName = [];

        for ($x = 0; $x < $this->gridSize; ++$x) {
            $condition = $this->sqrt;
            $toName['tmp'] = 0;
            for ($y = 0; $y < $this->gridSize; ++$y) {
                $usedNumbers[$this->grid[$x][$y]] = true;

                $lineBuffer['x'.$x] = isset($lineBuffer['x'.$x]) ? $lineBuffer['x'.$x] + $this->grid[$x][$y] : $this->grid[$x][$y];
                $lineBuffer['y'.$y] = isset($lineBuffer['y'.$y]) ? $lineBuffer['y'.$y] + $this->grid[$x][$y] : $this->grid[$x][$y];

                if ($y == ($this->gridSize - 1)) {
                    $toName[$x][] = $toName['tmp'];
                } elseif ($y < $condition) {
                    $toName['tmp'] = $toName['tmp'] + $this->grid[$x][$y];
                } else {
                    $toName[$x][] = $toName['tmp'];
                    $toName['tmp'] = $this->grid[$x][$y];

                    if ($x === ($condition - 1)) {
                    }

                    $condition += $this->sqrt;
                }
            }
        }

        if (1 !== count(array_flip($lineBuffer))) {
            return false;
        }

        if (count($usedNumbers) !== $this->gridSize) {
            return false;
        }

        return true;
    }
}
