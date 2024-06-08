<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

abstract class BaseCest
{
    protected $credentials;
    protected $languageCodes;

    public function _before(AcceptanceTester $I)
    {
        $this->credentials = json_decode(file_get_contents('tests/credentials.json'), true);
        $this->languageCodes = json_decode(file_get_contents('tests/languageCodes.json'), true);
    }

    public function _after(AcceptanceTester $I)
    {
        // Cleanup or reset actions can be performed here.
    }
}
