<?php

namespace App\Tests\Service;

use App\Service\Service;
use PHPUnit\Framework\TestCase;

class PrimeNumberServiceTest extends TestCase{
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new Service();
    }
    public function testGetPrimeNumbersWithValidRange()
    {
        
        $primeNumbers = $this->service->prime(1, 20);
        $expectedPrimeNumbers = [2, 3, 5, 7, 11, 13, 17, 19];
        $this->assertEquals($expectedPrimeNumbers, $primeNumbers);
    }
}