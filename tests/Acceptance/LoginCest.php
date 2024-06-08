<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

require_once 'BaseCest.php';

class LoginCest extends \Tests\Acceptance\BaseCest
{

    public function verifyTheSuccessfulLogin(AcceptanceTester $I)
    {
        $I->wantTo('Login successfully with valid credentials');
        $I->amOnPage('/login');
        $I->see('Discover');
        $I->fillField('email', $this->credentials['valid']['email']);
        $I->fillField('password', $this->credentials['valid']['password']);
        $I->checkOption('Remember Me');
        $I->click('Login');
        $I->see('Welcome');
        $I->see('Discover the Secrets of The Keto World');
    }

    public function verifyTheLoginWithWrongCredentials(AcceptanceTester $I)
    {
        $I->wantTo('Fail to login with invalid credentials');
        $I->amOnPage('/login');
        $I->see('Discover');

        $randomEmail = $this->generateRandomEmail();

        $I->fillField('email', $randomEmail);
        $I->fillField('password', $this->credentials['invalid']['password']);
        $I->click('Login');
        $I->see('These credentials do not match our records.', '//div[@class="alert alert-danger"]');
    }

    public function generateRandomEmail()
    {
        $randomString = bin2hex(random_bytes(5));
        $email = $randomString . '@gmail.com';

        return $email;
    }
}
