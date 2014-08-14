<?php
/**
 * Memorize
 *
 * A PHP implementation of the SM-2 algorithm.
 * Algorithm SM-2, © Copyright SuperMemo World, 1991.
 * http://www.supermemo.com
 * http://www.supermemo.eu
 *
 * @copyright 2014 Shahin Zarrabi (shahin@wiwo.se)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Memorize;
 
class SM2
{

    /**
     * Calculate interval for an item
     * 
     * Calculates the interval (in days) in which to repeat the item after the
     * n:th repetition given the item's current E-factor.
     * 
     * @param int $time   How many times the item has been repeated
     * @param int $factor The item's current E-factor
     *
     * @throws RangeException if the number of repetitions is lower than 1
     * @return float A ceiled value of the interval (in days)
     */
    public function calcInterval($time = 1, $factor = 2.5)
    {
        if ($time < 1) {
            throw new \RangeException('The number of repetitions must be 1 or higher');
        }
        
        if ($time == 1) {
            $interval = 1;
        } elseif ($time == 2) {
            $interval = 6;
        } else {
            $interval = self::calcInterval($time - 1, $factor) * $factor;
        }
        
        return ceil($interval);
    }
    
    /**
     * Calculate the new factor of an item
     * 
     * Calculates the new factor of an item based on the item's old E-factor and
     * the quality of the latest response to the item.
     * 
     * @param int $oldFactor The item's old E-factor
     * @param int $quality   The quality of the response to the item
     *
     * @throws RangeException if the quality is not between 0 and 5
     * @return float The item's new E-factor
     */
    public function calcNewFactor($oldFactor = 2.5, $quality = 4)
    {
        if ($quality > 5 || $quality < 0) {
            throw new \RangeException('Quality must be between 0 and 5');
        }
        
        $newFactor = $oldFactor+(0.1-(5-$quality)*(0.08+(5-$quality)*0.02));
        
        return $newFactor > 1.3 ? ($newFactor < 2.5 ? $newFactor : 2.5) : 1.3;
    }

}