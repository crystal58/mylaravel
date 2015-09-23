@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @if(isset($result['msg']))
                        <div>{{$result['msg']}}</div>
                    @endif
                        @if(session("result"))
                            <div>{{session("result")}}</div>
                        @endif
                    <div class="panel-heading">发布</div>
                    <div class="panel-body">
                        @if(isset($result['id']) && $result['id']>0)
                            <form action="{{url('admin/article/'.$result['id'])}}" method="POST" name="addarticle">
                                <input type="hidden" name="_method" value="PUT">
                        @else
                            <form action="{{url('admin/article')}}" method="POST" name="addarticle">
                        @endif
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            标题：<input type="text" name="title" class="form-control" required="required" value="{{isset($result['title'])?$result['title']:''}}">
                            <br>
                            文章内容：<textarea name="content" rows="10" class="form-control" required="required">{{isset($result['content'])?$result['content']:''}}</textarea>
                            <br>
                            其他：<textarea name="other" rows="5" class="form-control" required="required">{{isset($result['other'])?$result['other']:''}}</textarea>
                            <br>
                            <button class="btn btn-lg btn-info">提 交</button>
                        </form></form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
