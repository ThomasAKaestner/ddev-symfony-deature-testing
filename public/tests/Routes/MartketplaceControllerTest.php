<?php
declare(strict_types=1);

namespace App\Tests\Routes;

use App\DataFixtures\MarketplaceFixures;
use App\Tests\WebTestCaseWithDatabase;

class MartketplaceControllerTest extends WebTestCaseWithDatabase
{

    protected function setUp(): void
    {
        parent::setUp();

        $this->addFixture(MarketplaceFixures::class);
    }

    public function testIndex()
    {
        $crawler = $this->client->request('GET', '/marketplace');
        $this->assertResponseIsSuccessful();
        $this->assertResponseHeaderSame('Content-Type', 'application/json');

        $responseContent = $this->client->getResponse()->getContent();
        $data = json_decode($responseContent, true);

        $this->assertArrayHasKey('marketplaces', $data);
        $this->assertIsArray($data['marketplaces']);

        $this->assertEquals($data['marketplaces'][0], 'Otto');
        $this->assertEquals($data['marketplaces'][1], 'Zalando');
        $this->assertEquals($data['marketplaces'][2], 'About You');
    }
}