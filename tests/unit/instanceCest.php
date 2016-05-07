<?php
namespace EntrustBundle;
use EntrustBundle\UnitTester;

/**
 * @todo Working on make a CI instance
 */

class instanceCest
{
    protected $app;

    public function _before(UnitTester $I)
    {
        // load_class('Bundle', 'third_party/CI-Bundle');
        // $this->app =& get_instance();
        // $this->app->load->bundle(realpath(__DIR__ . '/../../'));
    }

    public function _after(UnitTester $I)
    {   
    }

    // tests
    public function testAPPPATH(UnitTester $I)
    {
        // $actual = realpath(APPPATH);
        // $expected = realpath(__DIR__ . '/../../../../');
        // $I->assertEquals(
        //     $expected,
        //     $actual,
        //     'Your APPPATH seems to be wrong. Check your $application_folder in ci_bootstrap.php'
        // );
    }
}
