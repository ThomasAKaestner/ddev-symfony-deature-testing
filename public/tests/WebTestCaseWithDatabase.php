<?php

namespace App\Tests;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Loader;


class WebTestCaseWithDatabase extends WebTestCase
{
    protected KernelBrowser $client;

    protected EntityManager $em;

    protected SchemaTool $schemaTool;

    /**
     * @var ClassMetadata[]
     */
    protected $metaData;


    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();

        if ('test' !== self::$kernel->getEnvironment()) {
            throw new \LogicException('Tests cases with fresh database must be executed in the test environment');
        }

        $this->em = self::$kernel->getContainer()->get('doctrine')->getManager();

        $this->metaData = $this->em->getMetadataFactory()->getAllMetadata();
        $this->schemaTool = new SchemaTool($this->em);
        $this->schemaTool->updateSchema($this->metaData);
    }

    public function addFixture($className)
    {
        $loader = new Loader();
        $loader->addFixture(new $className);

        $purger = new ORMPurger($this->em);
        $executor = new ORMExecutor($this->em, $purger);
        $executor->execute($loader->getFixtures());
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $purger = new ORMPurger($this->em);
        $purger->setPurgeMode(2);
        $purger->purge();
    }
}