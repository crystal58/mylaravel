@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <a href="{{ URL('admin/article/create') }}" class="btn btn-lg btn-primary">新增</a>

                        @foreach($article as $art)
                            <h3>{{$art->title}}</h3>
                            <div style="float: left;width: 800px">作者：{{$art->author}} 更新时间：{{$art->updated_at}}</div>
                            <div>
                                <a href="{{ URL('admin/article/'.$art->id.'/edit') }}">编辑</a>


                            <form id="delarticle" action="{{ URL('admin/article/'.$art->id) }}" method="POST" style="display: inline;">
                                <input name="_method" type="hidden" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="#" onclick="$('#delarticle').submit();">删除</a>
                            </form>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
