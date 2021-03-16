<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewTicketConcertListing extends TestCase
{
    /** @test */
    public function user_can_view_a_concert_listing()  
    {
        // Arrange 
        $concert = Concert::create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13, 2016 8:00pm'),
            'ticket_price' => 3250 ,// better way to store currency ( in lowest possible rate)
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Lane Street',
            'city' => 'Laraville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555',
        ]);


        // Act 
        $response = $this->get('/concerts/'.$concert->id);


        // Assert 
        $response->assertSee('The Red Chord');
        $response->assertSee('with Animosity and Lethargy');
        $response->assertSee('December 13, 2016 8:00pm');
        $response->assertSee('32.50');
        $response->assertSee('The Mosh Pit');
        $response->assertSee('123 Lane Street');
        $response->assertSee('Laraville');
        $response->assertSee('ON');
        $response->assertSee('17916');
        $response->assertSee('For tickets, call (555) 555-5555');
    }
}
