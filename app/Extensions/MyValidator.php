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
use Illuminate\Support\Facades\Log;
use Session;

class MyValidator extends Validator{

    public function ValidateCaptcha($attribute, $value){
        if(empty($value)){
            return false;
        }
        $builder = new CaptchaBuilder(Session::get('milkcaptcha'));
        return $builder->testPhrase($value);
    }
}