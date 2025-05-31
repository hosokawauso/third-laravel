<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusCode;

class QuizController extends Controller
{

     //DBが無くてコントローラーに記載することで取り出すことができる。
      /* private $statusCodes = [
        [
            'code' => '102',
            'meaning' => 'Processing',
            'description' => '処理中である'
          ],
          [
            'code' => '200',
            'meaning' => 'OK',
            'description' => 'リクエストが正常に成功できた'
          ],
          [
            'code' => '301',
            'meaning' => 'Moved Permanently',
            'description' => 'リクエストしたリソースが恒久的に移動されている'
          ],
          [
            'code' => '304',
            'meaning' => 'Not Modified',
            'description' => 'リクエストしたリソースは更新されていない'
          ],
          [
            'code' => '400',
            'meaning' => 'Bad Request',
            'description' => 'クライアントのリクエストに異常がある'
          ],
          [
            'code' => '401',
            'meaning' => 'Unauthorized',
            'description' => 'アクセストークンが無効なときや、認証がされていない'
          ],
          [
            'code' => '403',
            'meaning' => 'Forbidden',
            'description' => '閲覧権限が無いファイルやフォルダである'
          ],
          [
            'code' => '404',
            'meaning' => 'Not found',
            'description' => 'Webページが見つからない'
          ],
          [
            'code' => '500',
            'meaning' => 'Internal Server Error',
            'description' => '何らかのサーバ内でエラーが起きた'
          ],
          [
            'code' => '502',
            'meaning' => 'Bad Gateway',
            'description' => 'サーバーがリクエストに満たすのに必要な機能をサポートしていない'
          ],
          [
            'code' => '503',
            'meaning' => 'Service Unavailable',
            'description' => '一時的にサーバにアクセスが出来ない'
          ]
    ]; */
    
    
    public function show()
    {
     /*  // 正解をランダムに1つ選ぶ
      $correct = $this -> statusCodes[array_rand($this->statusCodes)];
        
      //正解以外を抽出してランダムに3つ選ぶ
      $incorrectChoices = collect($this->statusCodes)
          ->filter(fn($code) => $code['code'] !== $correct['code'])
          ->random(3);
      // 正解と不正解をシャッフル　4択
      $choices = $incorrectChoices->push($correct)->shuffle();

      //$statusCodesに記載しているすべての選択肢をシャッフルして提示する。
      $choices = collect($this->statusCodes)->shuffle();
 */

 $statusCodes = StatusCode::all(); 

 if($statusCodes->count() < 4) {
     abort(500, 'ステータスコードが4件以上必要です。');
 }
 
 $correct = $statusCodes->random();
 $choices = $statusCodes->where('id', '!=', $correct->id)->random(3);
 $choices -> push($correct); //正解を追加
 $shuffledChoices = $choices->shuffle(); //選択肢をシャッフル
 
 return view('quiz.quiz', [
            'question' => $correct->description,
            'correct_code' => $correct->code,
            'choices' => $shuffledChoices,
        ]);
    }

    public function check(Request $request)
    {
      
       $correctCode = $request -> input('correct_code');
       $selectedCode = $request -> input('selected_code');
       $isCorrect = $selectedCode === $correctCode;

       $correctStatus = StatusCode::where('code', $correctCode)->first();
       
       //$correctStatus = collect($this->statusCodes)->firstWhere('code', $correctCode);

        return view('quiz.result', [
            'isCorrect' => $isCorrect,
            'correct_code' => $correctCode,
            'selected_code' => $selectedCode,
            'correctStatus' => $correctStatus,
        ]);
    }
}
