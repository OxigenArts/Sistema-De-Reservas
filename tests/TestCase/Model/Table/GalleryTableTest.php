<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\GalleryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\GalleryTable Test Case
 */
class GalleryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\GalleryTable
     */
    public $Gallery;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.gallery',
        'app.profile',
        'app.users',
        'app.category',
        'app.subcategory',
        'app.apikey',
        'app.date',
        'app.directory',
        'app.forms',
        'app.photos',
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
        $config = TableRegistry::exists('Gallery') ? [] : ['className' => GalleryTable::class];
        $this->Gallery = TableRegistry::get('Gallery', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Gallery);

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
