<?php

use PHPUnit\Framework\TestCase;
use Carbon\Carbon;
use exception\GlobalException;

class BanquierTest extends TestCase
{
    public function testClientAContacter()
    {
        $compteBancaireMock = $this->createMock(CompteBancaire::class);
        $compteBancaireMock->method('estValide')->willReturn(false);

        $clientMock = $this->createMock(Client::class);
        $clientMock->method('getCompteBancaires')->willReturn([$compteBancaireMock]);

        $banquier = new Banquier("email@example.com", "Prenom", "Nom", Carbon::now(), Carbon::now()->subYears(1), [$clientMock]);

        $this->assertEquals([$clientMock], $banquier->clientAContacter());
    }

    public function testClientAContacterThrowsException()
    {
        $this->expectException(GlobalException::class);

        $banquier = new Banquier("email@example.com", "Prenom", "Nom", Carbon::now(), Carbon::now()->subDays(1), []);

        $banquier->clientAContacter();
    }
}
