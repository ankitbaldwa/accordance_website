<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MailBodiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MailBodiesTable Test Case
 */
class MailBodiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MailBodiesTable
     */
    protected $MailBodies;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.MailBodies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MailBodies') ? [] : ['className' => MailBodiesTable::class];
        $this->MailBodies = $this->getTableLocator()->get('MailBodies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MailBodies);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
