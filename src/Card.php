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

    private $question;
    private $answer;
    private $numberOfRepeats;
    private $factor;
    private $nextTime;
    
    /**
     * Constructor
     * 
     * Creates a new flash card with either default or custom settings.
     * 
     * @param int  $numberOfRepeats   How many times the card has been repeated
     * @param int  $factor            The card's current E-factor
     * @param int  $nextTime          The next time the card should be repeated as UNIX timestamp
     */
    public function __construct($numberOfRepeats = 0, $factor = 2.5, $nextTime = null,
                                    $question = null, $answer = null)
    {
        if (is_null($nextTime)) {
            $nextTime = time();
        }
        
        $this->numberOfRepeats = $numberOfRepeats;
        $this->factor = $factor;
        $this->nextTime = $nextTime;
        $this->question = $question;
        $this->answer = $answer;
    }
    
    /**
     * Set flash card question
     * @param string $question
     * @return \Memorize\Card
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }
    
    /**
     * Get flash card question
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }
    
    /**
     * Set flash card answer
     * @param string $answer
     * @return \Memorize\Card
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }
    
    /**
     * Get flash card answer
     * @return string
     */
    public function getAnswer()
    {
        return $this->answer;
    }
    
    /**
     * Set number of repetitions
     * @param int $numberOfRepeats
     * @return \Memorize\Card
     */
    public function setNumberOfRepeats($numberOfRepeats)
    {
        $this->numberOfRepeats = $numberOfRepeats;
        return $this;
    }
    
    /**
     * Get number of repetitions
     * @return int
     */
    public function getNumberOfRepeats()
    {
        return $this->numberOfRepeats;
    } 
    
    /**
     * Set E-factor
     * @param float $factor
     * @return \Memorize\Card
     */
    public function setFactor($factor)
    {
        $this->factor = $factor;
        return $this;
    }
    
    /**
     * Get E-factor
     * @return float
     */
    public function getFactor()
    {
        return $this->factor;
    }
    
    /**
     * Set next repetition occurrence (UNIX timestamp)
     * @param int $nextTime
     * @return \Memorize\Card
     */
    public function setNextTime($nextTime)
    {
        $this->nextTime = $nextTime;
        return $this;
    }
    
    /**
     * Get next repetition occurrence (UNIX timestamp)
     * @return int
     */
    public function getNextTime()
    {
        return $this->nextTime;
    }

    /**
     * Repeat the card
     * 
     * This method takes an instance of SM2 and a quality factor to update
     * the flash card accordingly after a repetition.
     * 
     * @param \Memorize\SM2 $memorize   An instance of an SM2 object
     * @param int           $quality    The quality of the answer
     */
    public function repeat($SM2, $quality)
    {
        if ($quality >= 3) {
            $this->numberOfRepeats++;
        } else {
            $this->numberOfRepeats = 1;
        }
                
        $newFactor = $SM2->calcNewFactor($this->factor, $quality);
        $this->factor = $newFactor;
        
        $interval = $SM2->calcInterval($this->numberOfRepeats, $newFactor);
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
            'question' => $this->question,
            'answer' => $this->answer,
            'numberOfRepeats' => $this->numberOfRepeats,
            'factor' => $this->factor,
            'nextTime' => $this->nextTime
        ];
    }

}