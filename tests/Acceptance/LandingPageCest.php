<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

require_once 'BaseCest.php';

class LandingPageCest extends \Tests\Acceptance\BaseCest
{

    public function verifyTheLanguagesInTheDropdown(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->see('Discover the Secrets of The Keto World');
        $I->fillField('email', $this->credentials['valid']['email']);
        $I->fillField('password', $this->credentials['valid']['password']);
        $I->checkOption('Remember Me');
        $I->click('Login');
        $I->see('Welcome');
        $I->click('#dropdownMenuLink');

        $languages = [
            'English', 'Português', 'Čeština', 'Français', 'Deutsch', 'Ελληνικά', 'Italiano', 'Polski',
            'Română', 'Русский', 'Español', 'Svenska', 'Türkçe', 'עִבְרִית', 'Magyar', 'Dansk', 'Norsk', 'Suomi'
        ];

        foreach ($languages as $language) {
            $I->see($language);
        }
    }

    # It appeared that when you're using PhpBrowser module in Codeception, 
    # you can't directly use the wait methods like waitForElementVisible() because PhpBrowser 
    # doesn't support waiting for elements to appear or become visible out of the box.
    # That's why I was blocked to build a way more advanced acceptance tests. Also there is a big limitations due to my lack of PHP knowledge

    // public function verifyMyVIPContentButtonWithEachLangCode(AcceptanceTester $I)
    // {
    //     $I->amOnPage('/login');
    //     $I->see('Discover the Secrets of The Keto World');
    //     $I->fillField('email', $this->credentials['valid']['email']);
    //     $I->fillField('password', $this->credentials['valid']['password']);
    //     $I->checkOption('Remember Me');
    //     $I->click('Login');
    //     $I->see('Welcome');
    //     $I->click('#dropdownMenuLink');

    //     $languages = [
    //         'English', 'Português', 'Čeština', 'Français', 'Deutsch', 'Ελληνικά', 'Italiano', 'Polski',
    //         'Română', 'Русский', 'Español', 'Svenska', 'Türkçe', 'עִבְרִית', 'Magyar', 'Dansk', 'Norsk', 'Suomi'
    //     ];
    //     $languageCodes = array_values($this->languageCodes);

    //     for ($i = 0; $i < count($languages); $i++) {

    //         $I->click($languages[$i]);
    //         $I->waitForClickable('My VIP content', 10); // Waits up to 10 seconds for the element to appear
    //         $url = '/' . $languageCodes[$i] . '/blog';
    //         $I->click('My VIP content');
    //         $I->amOnPage($url);
    //         $I->seeInCurrentUrl($url);
    //         $I->moveBack();
    //     }

    //     $I->click('My VIP content');
    //     $I->seeInCurrentUrl('/en/blog');
    //     $I->see('Blog');
    //     $I->moveBack();
    //     $I->see('Welcome');
    // }

    public function verifyTheNameOfTheButtonsOnTheNavigationBar(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->see('Discover the Secrets of The Keto World');
        $I->fillField('email', 'funk.jalon1717398018@qa.1ff.space');
        $I->fillField('password', '123qwerty');
        $I->checkOption('Remember Me');
        $I->click('Login');
        $I->see('My VIP content');
        $I->see('My meal plan');
        $I->see('English');
        $I->see('Sign out');
    }

}
