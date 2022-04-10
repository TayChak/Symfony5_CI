<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FunctionalTest extends WebTestCase
{
    public function testShouldDisplayDemoIndex(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/demo');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Demo index');
    }

    public function testShouldDisplayCreateNewDemo(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/demo/new');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Create new Demo');
    }

    public function testShouldAddNewDemo(): void
    {
        $client = static::createClient();
        $client->followRedirects();
        $crawler = $client->request('GET', '/demo/new');

        $buttonCrawlerNode = $crawler->selectButton('Save');

        if (!empty($buttonCrawlerNode)) {
            $form = $buttonCrawlerNode->form();
        }

        $uuid = uniqid('', true);

        $form = $buttonCrawlerNode->form([
            'demo[demo]'    => 'Add Demo For Test' . $uuid,
        ]);

        $client->submit($form);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('body', 'Add Demo For Test' . $uuid);
    }
}
