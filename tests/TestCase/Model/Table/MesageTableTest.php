<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MesageTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MesageTable Test Case
 */
class MesageTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MesageTable
     */
    public $Mesage;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.mesage',
        'app.users',
        'app.category',
        'app.subcategory',
        'app.profile',
        'app.photos',
        'app.apikey',
        'app.date',
        'app.directory',
        'app.forms',
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
        $config = TableRegistry::exists('Mesage') ? [] : ['className' => MesageTable::class];
        $this->Mesage = TableRegistry::get('Mesage', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Mesage);

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
