<?php

namespace OSProjectSkeletonBundle\Component\Sodoku\Helper;

class StrToArray
{
    /**
     * @param string $contents
     *
     * @return array
     */
    public static function process(string $contents): array
    {
        $grid = [];
        $rows = explode(PHP_EOL, $contents.PHP_EOL);
        $rowCount = count(explode(',', $rows[0]));
        for ($i = 0; $i < $rowCount; ++$i) {
            $row = explode(',', $rows[$i]);
            foreach ($row as $case) {
                $grid[$i][] = (int) $case;
            }
        }

        return $grid;
    }
}
