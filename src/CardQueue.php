<?php
/**
 * Flash card queue
 *
 * This class handles queues of flash cards and prioritizes them by next planned 
 * occurrence of repetition.
 *
 * @copyright 2014 Shahin Zarrabi (shahin@wiwo.se)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Memorize;
 
class CardQueue extends \SplPriorityQueue
{

    /**
     * Reverse the default priority comparison to put cards due closer in time
     * at the top.
     * 
     * @param int $priority1 Timestamp of the first node
     * @param int $priority2 Timestamp of the second node
     * 
     * @return int Positive if bigger, 0 if equal or negative if smaller
     */
    public function compare($priority1, $priority2)
    {
        return $priority2 - $priority1;
    }
    
    /**
     * Restrict the insert function to Card objects only, throwing an exception
     * if this restriction is violated. If it is a Card, use the Card's nextTime
     * as priority.
     *
     * @param Card $card
     * @param int $priority
     * @throws InvalidAgumentException when $card is not a Card
     */
    public function insert($card, $priority = null) {
        if (get_class($card) == 'Memorize\Card') {
            parent::insert($card, $card->getNextTime());
        } else {
            throw new \InvalidArgumentException('CardQueue only accepts objects of the type Card');
        }
    }
    
}