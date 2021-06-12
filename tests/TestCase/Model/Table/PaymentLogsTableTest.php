<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaymentLogsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaymentLogsTable Test Case
 */
class PaymentLogsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PaymentLogsTable
     */
    protected $PaymentLogs;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.PaymentLogs',
        'app.Users',
        'app.Packages',
        'app.Orders',
        'app.Payments',
        'app.PaymentsLogErrors',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PaymentLogs') ? [] : ['className' => PaymentLogsTable::class];
        $this->PaymentLogs = $this->getTableLocator()->get('PaymentLogs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PaymentLogs);

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
