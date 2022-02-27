<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AppInfoTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AppInfoTable Test Case
 */
class AppInfoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\AppInfoTable
     */
    protected $AppInfo;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.AppInfo',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('AppInfo') ? [] : ['className' => AppInfoTable::class];
        $this->AppInfo = $this->getTableLocator()->get('AppInfo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AppInfo);

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
