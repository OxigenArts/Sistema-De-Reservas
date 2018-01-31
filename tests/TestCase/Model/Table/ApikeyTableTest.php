<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ApikeyTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ApikeyTable Test Case
 */
class ApikeyTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ApikeyTable
     */
    public $Apikey;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.apikey',
        'app.users',
        'app.category',
        'app.subcategories',
        'app.profiles',
        'app.date',
        'app.directory',
        'app.forms',
        'app.photos',
        'app.profile',
        'app.reservation',
        'app.routines',
        'app.subcategory'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Apikey') ? [] : ['className' => ApikeyTable::class];
        $this->Apikey = TableRegistry::get('Apikey', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Apikey);

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
