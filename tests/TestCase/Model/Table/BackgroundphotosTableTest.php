<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BackgroundphotosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BackgroundphotosTable Test Case
 */
class BackgroundphotosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BackgroundphotosTable
     */
    public $Backgroundphotos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.backgroundphotos',
        'app.users',
        'app.category',
        'app.subcategory',
        'app.profile',
        'app.photos',
        'app.gallery',
        'app.apikey',
        'app.date',
        'app.directory',
        'app.forms',
        'app.reservation',
        'app.routines',
        'app.mesage'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Backgroundphotos') ? [] : ['className' => BackgroundphotosTable::class];
        $this->Backgroundphotos = TableRegistry::get('Backgroundphotos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Backgroundphotos);

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
