<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CustomPagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CustomPagesTable Test Case
 */
class CustomPagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CustomPagesTable
     */
    protected $CustomPages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CustomPages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CustomPages') ? [] : ['className' => CustomPagesTable::class];
        $this->CustomPages = $this->getTableLocator()->get('CustomPages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CustomPages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CustomPagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
