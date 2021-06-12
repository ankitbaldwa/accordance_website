<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PackageBenefitsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PackageBenefitsTable Test Case
 */
class PackageBenefitsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PackageBenefitsTable
     */
    protected $PackageBenefits;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PackageBenefits',
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
        $config = $this->getTableLocator()->exists('PackageBenefits') ? [] : ['className' => PackageBenefitsTable::class];
        $this->PackageBenefits = $this->getTableLocator()->get('PackageBenefits', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PackageBenefits);

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
