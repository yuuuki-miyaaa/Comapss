<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
//Requestにまずここを通過させて、バリデーションをかけてからcontrollerに送る

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

     //生年月日をまとめるメソッドの作成
          public function getValidatorInstance()
    {
        //値を取得
        $year = $this->input('old_year');
        $month = $this->input('old_month');
        $day = $this->input('old_day');

        //結合
        $birthdate = $year . '-' . $month . '-' . $day;
        $birthdate_validation = implode('-', $birthdate);

        //merge メソッドを使用して、現在のリクエストインスタンスに新しいデータを追加
        //これにより、この結合された日付を後続のバリデーションプロセスで使用できる
        $this->merge([
            'birthdate_validation' => $birthdate_validation,
        ]);

        //getValidatorInstance メソッド
        //カスタムバリデーションから通常のバリデーションへ続行するために必要
        return parent::getValidatorInstance();
    }

     //バリデーションルール
    public function rules()
    {
        return [
            'over_name' => 'required|string|max:10|min:1',
            'under_name' => 'required|string|max:10|min:1',
            'over_name_kana' => 'required|string|max:30|min:1|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'under_name_kana' => 'required|string|max:30|min:1|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'mail_address' => 'required|email|max:100|min:5|unique:users',
            'sex' => 'required',
            'birth_date' => 'required|date|after:2000-1-1|before:tomorrow',
            'password' => 'required|max:30|min:8|confirmed',
        ];
    }

    //エラーメッセージ
    public function messages(){
        return [
            // 'post_title.min' => 'タイトルは4文字以上入力してください。',
            // 'post_title.max' => 'タイトルは50文字以内で入力してください。',
            // 'post_body.min' => '内容は10文字以上入力してください。',
            // 'post_body.max' => '最大文字数は500文字です。',
        ];
    }
}
