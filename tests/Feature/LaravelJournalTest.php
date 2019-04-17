<?php
/**
 * Class LaravelJournalTest
 *
 * @package Tests\Feature
 * @author robconvery <robconvery@me.com>
 */

namespace Tests\Feature;

use Carbon\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Carbon;
use Robconvery\LaravelJournal\Journal;
use Tests\TestCase;

class LaravelJournalTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @group laravel_journal
     * @group view_all_journal_entries
     */
    public function view_all_journal_entries()
    {
        // Arrange
        $this->withoutExceptionHandling();
        \factory(Journal::class, 10)->create();

        // Act
        $response = $this->get(route('laravel-journal-all'));

        // Assert
        $response->assertOk();
    }

    /**
     * @test
     * @group laravel_journal
     * @group update_existing_journal_entry
     */
    public function update_existing_journal_entry()
    {
        // Arrange
        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $entry = $faker->paragraph;
        $Journal = Journal::create(['entry' => $entry]);

        // Act
        $response = $this->post(route('laravel-journal-store', $Journal), [
            'entry' => 'hello'
        ]);

        // Assert
        $Journal->refresh();
        $response->assertStatus(302);
        $this->assertEquals('hello', $Journal->entry);
    }


    /**
     * @test
     * @group laravel_journal
     * @group edit_journal_entry
     */
    public function edit_journal_entry()
    {
        // Arrange
        $this->withoutExceptionHandling();
        $faker = \Faker\Factory::create();
        $entry = $faker->paragraph;
        $Journal = Journal::create([
            'entry' => $entry
        ]);

        // Act
        $response = $this->get(route('laravel-journal-edit', $Journal));

        // Assert
        $response->assertOK();
    }

    /**
     * @test
     * @group laravel_journal
     * @group create_journal_entry
     */
    public function create_journal_entry()
    {
        // Arrange
        $faker = \Faker\Factory::create();
        $entry = $faker->paragraph;
        $this->withoutExceptionHandling();

        // Act
        $response = $this->post(route('laravel-journal-create'), [
            'entry' => $entry
        ]);

        // Assert
        $Journal = Journal::first();
        $response->assertStatus(302);
        $this->assertEquals($entry, $Journal->entry);
    }


    /**
     * @test
     * @group laravel_journal
     * @group view_create_journal_entry_screen
     */
    public function view_create_journal_entry_screen()
    {
        // Arrange
        $this->withoutExceptionHandling();

        // Act
        $response = $this->get(route('laravel-journal-new'));

        // Assert
        $response->assertOK();
        $response->assertSee(route('laravel-journal-create'));
    }

    /**
     * @test
     * @group laravel_journal
     * @group page_not_found_on_missing_journal_entry
     */
    public function page_not_found_on_missing_journal_entry()
    {
        // Arrange
        // $this->withoutExceptionHandling();
        $date = Carbon::now();

        // Act
        $response = $this->get(
            route('laravel-journal-entry', ['date' => $date->format("Y-m-d")])
        );

        // Assert
        $response->assertStatus(404);

    }

    /**
     * @test
     * @group laravel_journal
     * @group can_see_journal_entry
     */
    public function can_see_journal_entry()
    {
        // Arrange
        $faker = \Faker\Factory::create();
        $entry = $faker->paragraph;
        $this->withoutExceptionHandling();
        $date = Carbon::now();
        $Journal = new Journal(['entry' => $entry]);
        $Journal->save();

        // Act
        $response = $this->get(
            route('laravel-journal-entry', ['date' => $date->format("Y-m-d")])
        );

        // Assert
        $response->assertOk();
        $response->assertSee($date->format('l jS F Y'));
        $response->assertSee($entry);
        // $response->assertSee(route('laravel-journal-edit', $Journal));
        // $response->assertSee(route('laravel-journal-new'));
    }

}
