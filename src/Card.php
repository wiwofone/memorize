<?php
/**
 * Flash card
 *
 * This class handles a single flash card, its properties and its repetition
 * functionality.
 *
 * @copyright 2014 Shahin Zarrabi (shahin@wiwo.se)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
namespace Memorize;
 
class Card implements \JsonSerializable
{

    public $numberOfRepeats;
    public $factor;
    public $nextTime;
    
    /**
     * Constructor
     * 
     * Creates a new flash card with either default or custom settings.
     * 
     * @param int  $numberOfRepeats   How many times the card has been repeated
     * @param int  $factor            The card's current E-factor
     * @param date $nextTime         The next time the card should be repeated
     */
    public function __construct($numberOfRepeats = 0, $factor = 2.5, $nextTime = null)
    {
        if (is_null($nextTime)) {
            $nextTime = time();
        }
        
        $this->numberOfRepeats = $numberOfRepeats;
        $this->factor = $factor;
        $this->nextTime = $nextTime;
    }
    
    /**
     * Repeat the card
     * 
     * This method takes an instance of Memorize and a quality factor to update
     * the flash card accordingly after a repetition.
     * 
     * @param Memorize  $memorize   An instance of a Memorize object
     * @param int       $quality    The quality of the answer
     */
    public function repeat($memorize, $quality)
    {
        if ($quality >= 3) {
            $this->numberOfRepeats++;
        } else {
            $this->numberOfRepeats = 1;
        }
                
        $newFactor = $memorize->calcNewFactor($this->factor, $quality);
        $this->factor = $newFactor;
        
        $interval = $memorize->calcInterval($this->numberOfRepeats, $newFactor);
        $this->nextTime = time() + $interval*24*60*60;
    }
    
    /**
     * Encode the card in JSON
     *
     * @return String The JSON encoded Card object
     */
    public function jsonSerialize()
    {
        return [
            'numberOfRepeats' => $this->numberOfRepeats,
            'factor' => $this->factor,
            'nextTime' => $this->nextTime
        ];
    }

}