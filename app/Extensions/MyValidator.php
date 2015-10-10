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

class MyValidator extends Validator{

    public function ValidateCaptcha($attribute, $value){
        if(empty($value)){
            return false;
        }
        Log::info('input:'.$value);
        $builder = new CaptchaBuilder;
        return $builder->testPhrase($value);
    }
}