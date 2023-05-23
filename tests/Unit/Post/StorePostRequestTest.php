<?php

namespace Tests\Unit\Post;

use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * 投稿リクエストテスト
 */
class StorePostRequestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 概要 Postリクエストのバリデーションテスト
     * 条件 データプロバイダメソッドのラベル
     * 結果 true:バリデーションOK、false:バリデーションNG
     *
     * @dataProvider validationDataProvider
     */
    public function test_パラメータ化テスト($keys, $values, $expected)
    {
         //入力項目の配列（$keys）と入力値の配列($values)から連想配列を生成
         $dataList = array_combine($keys, $values);

        $request = new StorePostRequest();
        $rules = $request->rules();
        $validator = Validator::make($dataList, $rules);

        // テスト実施
        $actual = $validator->passes();

        // テスト検証
        $this->assertSame($expected, $actual);
    }

    // データプロバイダメソッド
    public function validationDataProvider(): array
    {
        // テスト用ファイルの生成
        $file = UploadedFile::fake()->image('dummy.jpg');

        // 'ラベル' => [入力項目], [入力値], 期待値
        return [
            'エラーなし' => [
                /* 入力項目 */
                ['title', 'description', 'level', 'file_name', 'text_id'],
                /* 入力値 */
                ['タイトル', '説明', 'A1', $file, ''],
                /* 期待値 */
                true,
            ],
        ];
    }
}
