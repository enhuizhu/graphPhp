<?php
class usCallTests extends PHPUnit_Framework_TestCase
{
	public $usCall;

	public function setUp() {
		$this->usCall = new usCall();
	}

	public function testGetSumOfTaxRate() {
		$this->usCall->taxMap = array(
			"A" => 0.05,
			"B" => 0.04
		);

		$sum = $this->usCall->getSumOfTaxRate(array("A", "B"));
		
		$this->assertEquals($sum, 0.09);
	}
}
