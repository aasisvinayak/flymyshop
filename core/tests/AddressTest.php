<?php


class AddressTest extends TestCase
{
    public function testCannotAddAddressWihoutFillingAllFields()
    {
        $this->userLogin();
        $this->visit('account/addresses/create')
        ->type('Test', 'address_l1')
        ->type('Test', 'city')
        ->type('Test', 'state')
        ->type('Test', 'postcode')
        ->type('UK', 'country')
        ->press('Add Address')
        ->see('required');
    }

    public function testAddAddress()
    {
        $this->userLogin();
        $this->visit('account/addresses/create')
            ->type('Test', 'address_l1')
           ->type('Test', 'address_l2')
            ->type('Test', 'city')
            ->type('Test', 'state')
            ->type('Test', 'postcode')
            ->type('UK', 'country')
            ->press('Add Address')
            ->seePageIs('/account/addresses');
    }

    public function testEditAddress()
    {
        $this->testAddAddress();
        $this->visit('account/addresses/')
            ->see('Test')
            ->click('Edit this Address')
            ->see('Test')
            ->type('Test10000', 'address_l1')
            ->press('Update Address')
            ->seePageIs('account/addresses')
           ->see('Successfully updated address');
    }

    public function testDeleteAddress()
    {
        $this->testAddAddress();
        $this->visit('account/addresses/')
            ->see('Test')
            ->press('Delete this entry')
            ->seePageIs('account/addresses')
            ->see('Successfully deleted the entry!');
    }
}
