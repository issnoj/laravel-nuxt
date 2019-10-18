<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @var $user User */
    public $user;

    public function setUp(): void
    {
        parent::setUp();

        // テストユーザー作成
        $this->user = factory(User::class)->create();
    }

    /**
     * @noinspection NonAsciiCharacters
     */
    public function test_認証済みのユーザーをログアウトさせる()
    {
        $headers = ['Authorization' => 'Bearer ' . auth()->guard()->fromUser($this->user)];
        $response = $this->actingAs($this->user)
            ->json('POST', route('logout'), [], $headers);

        $response->assertStatus(200);
        $this->assertGuest();
    }

    /**
     * @noinspection NonAsciiCharacters
     */
    public function test_未認証の場合は401を返却する()
    {
        $headers = ['Authorization' => 'Bearer ' . ''];
        $response = $this->json('POST', route('logout'), [], $headers);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Unauthenticated.']);
        $this->assertGuest();
    }
}
