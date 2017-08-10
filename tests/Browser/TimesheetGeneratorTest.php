<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TimesheetGeneratorTest extends DuskTestCase
{

    public function test_can_visit_home_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Timesheet Generator');

        });
    }

    public function test_preview_shows_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('date', date('F j, Y'))
                    ->type('company', 'Test Company')
                    ->type('name', 'Test Name')
                    ->waitForText('Test Company')
                    ->waitForText('Test Name')
                    ->waitForText( date('F j, Y') );
        });
    }

    public function test_timesheet_options()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('company', 'Test Company')
                ->check('hide_saturday')
                ->uncheck('hide_sunday')
                ->pause(1000)
                ->assertSeeIn('.ts-pdf h1', 'Test Company')
                ->assertSourceHas('<td>Sunday</td>')
                ->assertSourceMissing('<td>Saturday</td>');
        });
    }

}
