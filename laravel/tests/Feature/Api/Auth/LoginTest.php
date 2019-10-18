<?php

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
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
    public function test_登録済みユーザーを認証して返却する()
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'password',
        ]);

        $response
            ->assertStatus(200)
            ->assertJson([
                'user' => [
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ],
            ]);

        $this->assertAuthenticatedAs($this->user);
    }

    /**
     * @noinspection NonAsciiCharacters
     */
    public function test_登録済みユーザーの認証に失敗する()
    {
        $response = $this->json('POST', route('login'), [
            'email' => $this->user->email,
            'password' => 'passworda',
        ]);

        $response
            ->assertStatus(401)
            ->assertJson(['errors' => ['_' => ['メールアドレスかパスワードが間違ってます']]]);
    }
}
