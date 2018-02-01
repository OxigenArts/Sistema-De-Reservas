<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DateTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DateTable Test Case
 */
class DateTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DateTable
     */
    public $Date;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.date',
        'app.users',
        'app.category',
        'app.subcategory',
        'app.subcategories',
        'app.profiles',
        'app.apikey',
        'app.directory',
        'app.forms',
        'app.photos',
        'app.profile',
        'app.reservation',
        'app.routines'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Date') ? [] : ['className' => DateTable::class];
        $this->Date = TableRegistry::get('Date', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Date);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
