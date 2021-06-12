<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentsLogErrorsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentsLogErrorsTable Test Case
 */
class PaymentsLogErrorsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentsLogErrorsTable
     */
    protected $PaymentsLogErrors;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PaymentsLogErrors',
        'app.PaymentLogs',
        'app.Payments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaymentsLogErrors') ? [] : ['className' => PaymentsLogErrorsTable::class];
        $this->PaymentsLogErrors = $this->getTableLocator()->get('PaymentsLogErrors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PaymentsLogErrors);

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
