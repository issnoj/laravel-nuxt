<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @var $user User */
    public $user;

    /**
     * @noinspection NonAsciiCharacters
     */
    public function test_新しいユーザを作成して返却する()
    {
        $data = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(201)
            ->assertJson([
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ],
            ]);
    }

    /**
     * @noinspection NonAsciiCharacters
     */
    public function test_新しいユーザの作成に失敗する()
    {
        $data = [
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => 'test1234',
            'password_confirmation' => 'test12345',
        ];

        $response = $this->json('POST', route('register'), $data);

        $response
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'password' => [
                        "パスワードが一致していません",
                    ]
                ],
                'message' => "The given data was invalid."
            ]);
    }
}
