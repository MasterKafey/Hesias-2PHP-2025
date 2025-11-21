<?php

namespace App\Tests\Business;

use App\Business\MathBusiness;
use App\Business\TokenBusiness;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TokenBusinessTest extends KernelTestCase
{
    public function testToken(): void
    {
        self::bootKernel();
        $container = self::getContainer();

        $container = static::getContainer();

        // Mock de la dépendance
        $mock = $this->createMock(MathBusiness::class);
        $mock->method('div')->willReturn(16);

        $container->set(MathBusiness::class, $mock);

        $tokenBusiness = $container->get(TokenBusiness::class);

        $this->assertEquals(32, strlen($tokenBusiness->generateTokenValue(32)));
    }
}
