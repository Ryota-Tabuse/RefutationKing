<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Thema;

class ThemaTest extends TestCase
{
    //テストケースごとに、データベースをリフレッシュする。
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // データベースマイグレーション
        $this->artisan('migrate');
    }

    /**
     * 通常時パターン.
     *
     * @test
     */
    public function normal_test()
    {
        /**
         * データ準備.
         */
        $name = '議論名';
        $option_a = 'aaa';
        $option_b = 'bbb';

        /**
         * テスト開始.
         */
        $response = $this->post('/themes/create', [
            'name' => $name,
            'option_a' => $option_a,
            'option_b' => $option_b,
        ]);

        /**
         * テスト検証
         */
        $thema = Thema::all();
        $this->assertEquals(1, count($thema));
        $this->assertEquals($name, $thema[0]->name);
        $this->assertEquals($option_a, $thema[0]->option_a);
        $this->assertEquals($option_b, $thema[0]->option_b);
        $response->assertSessionHasNoErrors();
    }

    /**
     * 議論名文字数オーバーエラー
     *
     * @test
     */
    public function exceeded_chara_thema_error_test()
    {
        /**
         * テスト実行.
         */
        $response = $this->post('/themes/create', [
            'name' => 'アイウエオかきくけこサシスセソたちつてとナニヌネノはひふへほマミムメモらりるれろやゆよ',
            'option_a' => 'aaa',
            'option_b' => 'bbb',
        ]);

        /*
         * テスト検証
         */
        $response->assertSessionHasErrors([
            'name' => '議論テーマ名 は 40 文字以内で入力してください。',
        ]);
    }

    /**
     * 選択肢文字数オーバーエラー
     *
     * @test
     */
    public function exceeded_chara_optionA_error_test()
    {
        /**
         * テスト実行.
         */
        $response = $this->post('/themes/create', [
            'name' => '議論名',
            'option_a' => 'アイウエオかきくけこサ',
            'option_b' => 'アイウエオかきくけこサ',
        ]);

        /*
         * テスト検証
         */
        $response->assertSessionHasErrors([
            'option_a' => '選択肢 は 10 文字以内で入力してください。',
            'option_b' => '選択肢 は 10 文字以内で入力してください。',
        ]);
    }

    /**
     * テーマの入力がない場合、バリデーションエラー
     *
     * @test
     */
    public function null_thema_name_error_test()
    {
        $response = $this->post('/themes/create', [
            'name' => '',
            'option_a' => '',
            'option_b' => '',
        ]);

        $response->assertSessionHasErrors([
            'name' => '議論テーマ名 は必須です。',
            'option_a' => '選択肢 は必須です。',
            'option_b' => '選択肢 は必須です。',
        ]);
    }
}
