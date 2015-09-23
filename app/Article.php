<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function getArticleByUserId($userid){
        $data = $this->where("user_id",$userid)
            ->orderBy("id",'desc')
            ->get();
        return $data;
    }

    public function getArticleById($id){
        $data = $this->find($id);
        return $data;
    }


}
