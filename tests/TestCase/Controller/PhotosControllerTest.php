<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PhotosController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PhotosController Test Case
 */
class PhotosControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.photos',
        'app.users',
        'app.category',
        'app.subcategories',
        'app.apikey',
        'app.date',
        'app.directory',
        'app.forms',
        'app.profile',
        'app.reservation',
        'app.routines',
        'app.subcategory'
    ];

    /**
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
