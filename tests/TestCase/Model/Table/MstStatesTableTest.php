<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MstStatesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MstStatesTable Test Case
 */
class MstStatesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MstStatesTable
     */
    protected $MstStates;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.MstStates',
        'app.MstCountries',
        'app.MstCities',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MstStates') ? [] : ['className' => MstStatesTable::class];
        $this->MstStates = $this->getTableLocator()->get('MstStates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MstStates);

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
