<?php
/**
 * Repeater
 *
 * This class handles actual repetition of a queue of cards.
 *
 * @copyright 2014 Shahin Zarrabi (shahin@wiwo.se)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Memorize;
 
class Repeater
{

    private $queue;
    
    /**
     * Construct the repeater with an initial queue of cards.
     *
     * @param CardQueue $queue
     */
    public function __construct(CardQueue $queue)
    {
        $this->queue = $queue;
    }
    
    /**
     * Remove the current Card from the queue.
     */
    private function removeCard()
    {
        return $this->queue->extract();
    }
    
    /**
     * Insert a Card object in the queue.
     *
     * @param Card $card
     */
    private function reinsertCard(Card $card)
    {
        $this->queue->insert($card);
    }
    
    /**
     * Get the current Card in the queue.
     */
    public function getCard()
    {
        return $this->queue->current();
    }
    
    /**
     * Register an answer on a card and handle the card accordingly.
     *
     * @param SM2 $SM2 An instance of SM2
     * @param int $quality The quality of the answer
     */
    public function answer($SM2, $quality)
    {
        /* Get the current card and call its repeat method */
        $this->getCard()->repeat($SM2, $quality);
        
        /* Remove the card from the queue */
        $card = $this->removeCard();
        
        /* If the quality was below 4, or the card is set to be repeated again
         * in less than a day, reinsert it to the queue. */
        if ($quality < 4 || $card->getNextTime() - time() < 60*60*24) {
            $this->reinsertCard($card);
        }
    }
        
}