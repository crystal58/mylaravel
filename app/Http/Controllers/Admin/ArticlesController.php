<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $article = new Article();
        $user = Auth::user()->toArray();
        $data = $article->getArticleByUserId($user['id']);
        return view("admin.articlelist",["article"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view("admin.articleCreate");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:articles|max:255',
            'content' => 'required',
        ]);
        $article = new Article();
        $data = array(
            'title' => $request->get("title")
        );
        $article->title = $request->get("title");
        $article->content = $request->get("content");
        $article->other = $request->get("other");
        $user = Auth::user()->toArray();
        $article->user_id = $user['id'];
        $article->author = $user['name'];
        if($article->save()){
            $data['msg'] = "发布成功";
        }else{
            $data['msg'] = "发布失败";
        }

        return view("admin.articleCreate",['result'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $article = new Article();
        $data = $article->getArticleById($id)->toArray();
        return view("admin.articleCreate",['result'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|unique:articles,title,'.$id.'|max:255',
            'content' => 'required',
        ]);
        $art = new Article();
        $article = $art->getArticleById($id);
        $user = Auth::user()->toArray();
        if($user['id'] != $article->user_id){
            echo "the article is not yours";
            exit;
        }
        $article->title = $request->get("title");
        $article->content = $request->get("content");
        $article->other = $request->get("other");

        $data = array();
        if($article->save()){
            return Redirect::to('admin/article/'.$id."/edit")->with("result","保存成功");
        }else{
            return Redirect::back()->withInput()->with("result","保存失败");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $art = new Article();
        $article = $art->find($id);
        if($article){
            $article->delete();
        }
        return Redirect::to('admin/article');
    }
}
