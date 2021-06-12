<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ReleaseNotesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ReleaseNotesTable Test Case
 */
class ReleaseNotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ReleaseNotesTable
     */
    protected $ReleaseNotes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.ReleaseNotes',
        'app.Packages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('ReleaseNotes') ? [] : ['className' => ReleaseNotesTable::class];
        $this->ReleaseNotes = $this->getTableLocator()->get('ReleaseNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->ReleaseNotes);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
