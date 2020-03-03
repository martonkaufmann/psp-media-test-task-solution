<?php

namespace Tests\Feature\Customer;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Country;
use App\Customer;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testWithValidData(): void
    {
        $country = factory(Country::class)->create();
        $customer = factory(Customer::class)->make();

        $response = $this->postJson('/api/customer', [
            'email' => $customer->email,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'gender' => $customer->gender,
            'country' => $country->code
        ]);

        $response
            ->assertStatus(201)
        ;
    }

    public function testWithoutData(): void
    {
        $response = $this->postJson('/api/customer', []);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => [
                        'The email field is required.'
                    ],
                    'first_name' => [
                        'The first name field is required.'
                    ],
                    'last_name' => [
                        'The last name field is required.'
                    ],
                    'gender' => [
                        'The gender field is required.'
                    ],
                    'country' => [
                        'The country field is required.'
                    ]
                ]
            ])
        ;
    }

    public function testWithTakenEmail(): void
    {
        $country = factory(Country::class)->create();
        $customer = factory(Customer::class)->create([
            'country' => $country->code,
        ]);

        $response = $this->postJson('/api/customer', [
            'email' => $customer->email,
            'first_name' => 'first',
            'last_name' => 'last',
            'gender' => 'male',
            'country' => $country->code
        ]);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => [
                        'The email has already been taken.'
                    ],
                ],
            ])
        ;
    }

    public function testWithNonExistentCountry(): void
    {
        $customer = factory(Customer::class)->make();

        $response = $this->postJson('/api/customer', [
            'email' => $customer->email,
            'first_name' => $customer->first_name,
            'last_name' => $customer->last_name,
            'gender' => $customer->gender,
            'country' => 'DOESNOTEXIST'
        ]);

        $response
            ->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'country' => [
                        'The selected country is invalid.'
                    ],
                ],
            ])
        ;
    }
}
