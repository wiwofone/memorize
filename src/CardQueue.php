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

    public function compare($priority1, $priority2)
    {
        return $priority1 - $priority2;
    }
    
    public function insert($card, $priority) {
        if (get_class($card) == 'Memorize\Card') {
            parent::insert($card, $card->getNextTime());
        } else {
            throw new \InvalidArgumentException('CardQueue only accepts objects of the type Card');
        }
    }
    
}