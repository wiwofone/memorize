<?php
use Memorize\Memorize;

class MemorizeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Less than 1 repetition should throw an exception.
     *
     * @expectedException        RangeException
     * @expectedExceptionMessage The number of repetitions must be 1 or higher
     */
    public function testTooFewTimes()
    {
        $mem = new Memorize();
        $mem->calcInterval(0);
    } 
    
    /**
     * 1 repetition should always give interval = 1, 2 should give 6 and a test
     * case on 3 with E-factor 2.5 should arithmetically give 15.
     */
    public function testCases()
    {
        $mem = new Memorize();
        $this->assertEquals(1, $mem->calcInterval(1, rand()));
        $this->assertEquals(6, $mem->calcInterval(2, rand()));
        $this->assertEquals(15, $mem->calcInterval(3,2.5));
    }
    
    /**
     * calcInterval should always return a float.
     */
    public function testIntervalIsFloat()
    {
        $mem = new Memorize();
        $this->assertInternalType('float', $mem->calcInterval());
    } 
    
    
    /**
     * Quality should not be able to be higher than 6.
     * 
     * @expectedException        RangeException
     * @expectedExceptionMessage Quality must be between 0 and 5
     */
    public function testQualityTooHigh()
    {
        $mem = new Memorize();
        $mem->calcNewFactor(2.5,6);
    } 
    
    /**
     * Quality should not be able to be lower than 0.
     * 
     * @expectedException        RangeException
     * @expectedExceptionMessage Quality must be between 0 and 5
     */
    public function testQualityTooLow()
    {
        $mem = new Memorize();
        $mem->calcNewFactor(2.5,-1);
    } 
    
    /**
     * A factor of 1.4 with response quality 1 should generate a factor of 0.86.
     * However, 1.3 should always be the minimum factor.
     */
    public function testFactorMinimum()
    {
        $mem = new Memorize();
        $this->assertEquals(1.3, $mem->calcNewFactor(1.4,1));
    }
    
    /**
     * A response of quality 4 should not change the factor
     */
    public function testQuality4() {
        $mem = new Memorize();
        $oldFactor = rand();
        $this->assertEquals($oldFactor,$mem->calcNewFactor($oldFactor,4));
    }
    
    /**
     * calcNewFactor should always return a float.
     */
    public function testFactorIsFloat() {
        $mem = new Memorize();
        $this->assertInternalType('float', $mem->calcNewFactor());
    } 
}