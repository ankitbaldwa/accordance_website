<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MstCountriesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MstCountriesTable Test Case
 */
class MstCountriesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\MstCountriesTable
     */
    protected $MstCountries;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.MstCountries',
        'app.MstCities',
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
        $config = $this->getTableLocator()->exists('MstCountries') ? [] : ['className' => MstCountriesTable::class];
        $this->MstCountries = $this->getTableLocator()->get('MstCountries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->MstCountries);

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
