<?php

namespace OSProjectSkeletonBundle\Entity;

class Sodoku
{
    private $grid;

    private $gridSize;

    private $sqrt;

    private $pathIndexing = [];

    private $uniqueIndexing = [];

    /*
     * @param array $grid
     */
    public function __construct(array $grid)
    {
        $this->grid = $grid;
        $this->gridSize = (int) count($grid[0]);
        $this->sqrt = (int) sqrt($this->gridSize);

        $this->pathIndexing();
        $this->uniqueIndexing();
    }

    public function uniqueIndexing()
    {
        for ($coord = 0; $coord < $this->gridSize; ++$coord) {
            for ($number = 1; $number <= $this->gridSize; ++$number) {
                $this->uniqueIndexing['x'.$coord.'-'.$number] = 0;
                $this->uniqueIndexing['y'.$coord.'-'.$number] = 0;
            }
        }
    }

    /**
     * @return array
     */
    public function getUniqueIndexing(): array
    {
        return $this->uniqueIndexing;
    }

    public function pathIndexing()
    {
        $yWall = $this->sqrt;
        $xWall = $this->sqrt;
        $yCoor = 0;
        $xCoor = 0;
        while (!($xCoor === ($this->gridSize - 1) && $yCoor === $this->gridSize)) {
            // int new line square
            if (($xCoor === ($xWall - 1)) && ($yCoor === $this->gridSize)) {
                $yWall = $this->sqrt;
                $xWall += $this->sqrt;
                $yCoor = 0;
                $xCoor = ($xWall - $this->sqrt);
                $this->pathIndexing[] = $pathIndexing;
                $pathIndexing = [];
            // right wall && down wall (1 square) init new square
            } elseif (($xCoor === ($xWall - 1)) && ($yCoor === $yWall)) {
                $yWall += $this->sqrt;
                $yCoor = ($yWall - $this->sqrt);
                $xCoor = ($xWall - $this->sqrt);
                $this->pathIndexing[] = $pathIndexing;
                $pathIndexing = [];
            // right wall inside square
            } elseif ($yCoor === $yWall) {
                $yCoor = ($yWall - $this->sqrt);
                ++$xCoor;
            }
            $pathIndexing[] = [$xCoor => $yCoor];
            ++$yCoor;
        }
        $this->pathIndexing[] = $pathIndexing;
    }

    /**
     * @return array
     */
    public function getPathIndexing(): array
    {
        return $this->pathIndexing;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        $lineAdditionBuffer = [];

        foreach ($this->pathIndexing as $key => $squares) {
            $squareAdditionBuffer = 0;
            $squareUniqueBuffer = [];

            foreach ($squares as $square) {
                $x = key($square);
                $y = current($square);
                $value = $this->grid[$x][$y];

                $squareAdditionBuffer += $value;
                $squareUniqueBuffer[$value] = true;

                $this->uniqueIndexing['x'.$x.'-'.$value] = 1;
                $this->uniqueIndexing['y'.$y.'-'.$value] = 1;

                $lineAdditionBuffer['x'.$x] = isset($lineAdditionBuffer['x'.$x]) ? $lineAdditionBuffer['x'.$x] + $value : $value;
                $lineAdditionBuffer['y'.$y] = isset($lineAdditionBuffer['y'.$y]) ? $lineAdditionBuffer['y'.$y] + $value : $value;
            }

            if (count($squareUniqueBuffer) !== $this->gridSize) {
                return false;
            }

            if ($squareAdditionBuffer !== array_sum(range(1, $this->gridSize))) {
                return false;
            }
        }

        if (1 !== count(array_flip($lineAdditionBuffer))) {
            return false;
        }

        if (isset($this->uniqueIndexing[0])) {
            return false;
        }

        return true;
    }
}
