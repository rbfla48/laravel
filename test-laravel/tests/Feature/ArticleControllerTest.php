<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ArticleControllerTest extends TestCase
{
    /**
     * @test
     */
    public function 로그인한_사용자_글쓰기_화면_노출(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('article.create'))
            ->assertStatus(200)
            ->assertSee('글쓰기');
    }

    public function 로그인하지않은_사용자_로그인화면노출():void
    {
        $this->get(route('article.create'))
        ->assertStatus(302)
        ->assertRedirectToRoute('login');
    }

    /**
     * @test
     */
    public function 로그인한_사용자_글_저장하기(): void
    {
        //userFactiry에서 임의의 user_id 생성
        $user = User::factory()->create();

        $testData = [
            'content' => 'test_text'
        ];
        
        //해당 url로 리다이렉션 되는지 확인
        $this
        ->actingAs($user)
        ->post(route('article.store'),$testData)->assertRedirect(route('article.index'));
        
        //입력값이 DB에 잘 들어갔는지 확인
        $this->actingAs($user)
        ->assertDatabaseHas('articles',$testData);
    }
}
