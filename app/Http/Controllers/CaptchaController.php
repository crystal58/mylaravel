<?php
namespace App\Http\Controllers;

use App\Http\Requests;

use Illuminate\Http\Request;

//引用对应的命名空间
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Session;
use Crypt;

class CaptchaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function captcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        Log::info("before:".$phrase);
        $phrase_new = Crypt::encrypt($phrase);
        Log::info("after:".$phrase_new);
        //把内容存入session
        Session::flash('milkcaptcha', $phrase_new);

        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

}