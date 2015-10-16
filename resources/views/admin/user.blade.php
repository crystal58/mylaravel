@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">用户</div>
                    <form action="{{url('admin/search')}}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div style="text-align: center;margin:10px">
                        <select name="type">
                            <option value="name">name</option>
                            <option value="email">email</option>
                        </select>
                        <input type="text" name="keyword" value=""> <input type="submit" value="search">
                    </div>
                    </form>
                    <hr>
                    <div class="panel-body">
                        <div style="display: none" id="win">
                            <input type="hidden" value="" id="userid">
                            <div>用户名 : <span id="user_name"></span></div>
                            <div>状 态 :
                                <input type="radio" value="1" name="userstatus"> 激活
                                <input type="radio" value="2" name="userstatus"> 静默
                            </div>
                            <input type="button" value="提交" onclick="edituserstatus()">
                        </div>
                        <div>
                            <span>用户名</span>
                            <span>更新时间</span>
                            <span>状态</span>
                            <span>操作</span>
                        </div>
                        @foreach ($result as $user)
                            <div>
                                <span>{{$user['name']}} </span>
                                <span>{{$user['updated_at']}}</span>
                                <span id="user{{$user['id']}}">
                                    @if($user['status'] == 1)
                                        正常
                                    @elseif($user['status'] ==2)
                                        静默
                                    @endif
                                </span>
                                <span><a href="#" onclick="edituser('{{$user['id']}}')">编辑</a></span>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function edituser(userid){
            $.ajax({
                type: "GET",
                url: "{{url('admin/user/')}}/" + userid,
                dataType:"json",
                success: function(msg){
                    $("#user_name").html(msg.name);
                    $("#userid").val(msg.id);
                    if(msg.status==1){
                        $('input[name=userstatus]').get(0).checked = true;
                        $('input[name=userstatus]').get(1).checked = false;
                    }else{
                        $('input[name=userstatus]').get(0).checked = false;
                        $('input[name=userstatus]').get(1).checked = true;
                    }
                    $("#win").show();
                }

            });

        }

        function edituserstatus(){
            var userid = $("#userid").val();
            var status = $('input:radio[name="userstatus"]:checked').val();
            var text = "";
            if(status == 1){
                text = "正常"
            }else{
                text = "静默";
            }

            $.ajax({

                type: "POST",

                url: "{{url('admin/user/')}}/" + userid,

                data: "status="+status+"&_method=PUT&_token={{ csrf_token() }}",

                success: function(msg){

                    if(msg == 'success'){
                        $("#user"+userid).html(text)
                        $("#win").hide();
                        alert("更新成功");
                    }else{
                        alert("更新失败");
                    }

                }

            });

        }
    </script>
@endsection
<style type="text/css">
    span {
        display:-moz-inline-box;
        display:inline-block;
        width:200px;
    }
</style>