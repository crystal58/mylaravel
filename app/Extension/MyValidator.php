<?php
/**
 * Created by PhpStorm.
 * User: crystal
 * Date: 15/10/8
 * Time: 下午6:04
 */
namespace App\Extensions;

use Illuminate\Validation\Validator;
use Gregwar\Captcha\CaptchaBuilder;

class MyValidate extends Validator{

    public function ValidateCaptcha($attribute, $value){
        $captcha = $request->input("captcha");
        // $builder = new CaptchaBuilder;
        // if(!$builder->testPhrase($captcha)) {
        //用户输入验证码正确
        // }
    }
}