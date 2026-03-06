<?php

declare(strict_types=1);

namespace Tests\Acceptance;

use HelloWorld\Model\CharacterClass;
use Tests\Support\AcceptanceTester;

final class CharacterCest
{

    public function testCanCreateCharacter(AcceptanceTester $I): void
    {
        $name = 'Mark';

        $this->createCharacter($name, $I);

        $I->see($name);
    }

    public function testCanDeleteCharacter(AcceptanceTester $I): void
    {
        $name = 'Duglas';

        $this->createCharacter($name, $I);

        $I->see($name);
        $I->click('Delete', ".btn");
        $I->dontSee($name);
    }

    public function testCanUpdateCharacter(AcceptanceTester $I): void
    {
        $name = 'France';
        $changedName = 'Developer';
        $changedAge = 14;

        $this->createCharacter($name, $I);

        $I->click('Update', ".btn");
        $I->see('Update a Character');
        $I->selectOption('form input[name=character_radio]', CharacterClass::WARRIOR);
        $I->fillField(['name' => 'name'], $changedName);
        $I->fillField(['name' => 'age'], $changedAge);
        $I->click('Create', ".styledSubmit");
        $I->see('Home');
        $I->see('Name: Developer');
        $I->see('CharacterClass: WARRIOR');
        $I->see('Alter: 14');
    }

    public function testCanListCharacters(AcceptanceTester $I): void
    {
        $characterOne = 'Kenny';
        $characterTwo = 'Alastor';

        $this->createCharacter($characterOne, $I);
        $this->createCharacter($characterTwo, $I);

        $I->see($characterOne);
        $I->see($characterTwo);
    }

    public function testCanShowCharacter(AcceptanceTester $I): void
    {
        $characterName = 'Vox';

        $this->createCharacter($characterName, $I);

        $I->click('Play', ".btn");
        $I->see('Your Name is: Vox');
        $I->see('Your Age is: 6');
        $I->click('Continue', ".btn");
    }

    private function createCharacter(string $name, AcceptanceTester $I): void
    {
        $I->amOnPage('/create');
        $I->seeElement('input', ['name' => 'name']);

        $I->fillField(['name' => 'name'], $name);
        $I->fillField('age', 6);
        $I->selectOption('form input[name=character_radio]', CharacterClass::ARCHER);

        $I->click('input[type=submit]');
        $I->amOnPage('/');
    }
}
