<?php
namespace EntrustBundle;
use EntrustBundle\AcceptanceTester;

class basicCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/index.php/entrust');
        $I->submitForm('#loginForm', [
            'username' => 'admin@cerberus',
            'password' => 'admin'
        ]);      
    }

    public function _after(AcceptanceTester $I)
    {
        $I->amOnPage('index.php/entrust/logout');
    }

    public function tryToLogin(AcceptanceTester $I)
    {
        $I->see('Welcome to EntrustBundle!');
    }

    public function tryToShow404(AcceptanceTester $I)
    {
        $I->amOnPage('index.php/entrust/foo');
        $I->seeResponseCodeIs(404);
    }
}
