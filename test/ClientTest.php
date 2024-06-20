<?php 
use PHPUnit\Framework\TestCase;
use Carbon\Carbon;
use exception\GlobalException;

class ClientTest extends TestCase
{
    public function testVerifierSiCompteValide()
    {
        $compteBancaireMock = $this->createMock(CompteBancaire::class);
        $compteBancaireMock->method('getId')->willReturn(1);
        $compteBancaireMock->method('estValide')->willReturn(true);

        $client = new Client("email@example.com", "Prenom", "Nom", Carbon::now(), [$compteBancaireMock], false);

        $this->assertTrue($client->verifierSiCompteValide(1));
    }

    public function testVerifierSiCompteNonValide()
    {
        $compteBancaireMock = $this->createMock(CompteBancaire::class);
        $compteBancaireMock->method('getId')->willReturn(1);

        $client = new Client("email@example.com", "Prenom", "Nom", Carbon::now(), [$compteBancaireMock], true);

        $this->assertFalse($client->verifierSiCompteValide(1));
    }
}
