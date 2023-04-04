<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    public function testReservation()
    {
        $client = static::createClient();

        // Simulate authentication as a user
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Se connecter')->form();
        $form['username'] = 'john_doe';
        $form['password'] = 'password123';
        $client->submit($form);

        // Make a reservation
        $crawler = $client->request('GET', '/reservation');
        $form = $crawler->selectButton('Réserver')->form();
        $form['reservation[name]'] = 'John Doe';
        $form['reservation[dateStart]'] = '2023-04-05 10:00:00';
        $form['reservation[dateEnd]'] = '2023-04-05 11:00:00';
        $form['reservation[statut]'] = 1;
        $client->submit($form);

        // Check if the reservation was successful
        $this->assertResponseRedirects('/reservation/success');
        $client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Réservation effectuée avec succès');
    }
}

