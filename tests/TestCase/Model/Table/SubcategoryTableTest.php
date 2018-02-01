<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubcategoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubcategoryTable Test Case
 */
class SubcategoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SubcategoryTable
     */
    public $Subcategory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.subcategory',
        'app.users',
        'app.category',
        'app.subcategories',
        'app.profiles',
        'app.apikey',
        'app.date',
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
        $config = TableRegistry::exists('Subcategory') ? [] : ['className' => SubcategoryTable::class];
        $this->Subcategory = TableRegistry::get('Subcategory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Subcategory);

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
