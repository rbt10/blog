<?php

namespace App\Tests\Units;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BasicsTest extends KernelTestCase
{
    public function testEnvironnementOk() : void{

        $this->assertTrue(true);
    }
}