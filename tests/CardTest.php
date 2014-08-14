<?php
/**
 * Memorize test cases
 *
 * @copyright     Shahin Zarrabi 2014 (shahin@wiwo.se)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
 
use Memorize\SM2;
use Memorize\Card;

class CardTest extends \PHPUnit_Framework_TestCase
{

    /**
     * A repetition with a factor 3 or above should always increment the number
     * of repetitions.
     */
    public function testGoodRepeat()
    {
        $card = new Card();
        $memorize = new SM2();
        $card->repeat($memorize, rand(3,5));
        $card->repeat($memorize, rand(3,5));
        $card->repeat($memorize, rand(3,5));
        $this->assertEquals(3, $card->getNumberOfRepeats());
    }
    
    /**
     * A repetition with a factor lower than 3 should reset the number of
     * repetitions, regardless of previous performance.
     */
     
    public function testBadRepeat()
    {
        $card = new Card();
        $memorize = new SM2();
        $card->repeat($memorize, rand(3,5));
        $card->repeat($memorize, rand(3,5));
        $card->repeat($memorize, rand(0,2));
        $this->assertEquals(1, $card->getNumberOfRepeats());
    }
    
}