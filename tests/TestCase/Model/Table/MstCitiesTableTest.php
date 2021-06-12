<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MstCitiesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MstCitiesTable Test Case
 */
class MstCitiesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MstCitiesTable
     */
    protected $MstCities;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.MstCities',
        'app.MstCountries',
        'app.MstStates',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('MstCities') ? [] : ['className' => MstCitiesTable::class];
        $this->MstCities = $this->getTableLocator()->get('MstCities', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MstCities);

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
