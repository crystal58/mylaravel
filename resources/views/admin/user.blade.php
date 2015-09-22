@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Home</div>

                    <div class="panel-body">
                        <div style="display: none" id="win">
                            <input type="hidden" name="userid" id="userid" value="">
                            <input type="radio" value="1" name="userstatus"> 激活
                            <input type="radio" value="0" name="userstatus"> 静默
                            <br><br>
                            <input type="button" value="提交" onclick="edituserstatus()">
                        </div>
                        @foreach ($result as $user)
                            <h3>{{$user['name']}}</h3>
                            <div>更新时间：{{$user['updated_at']}} <a href="#" onclick="edituser('{{$user['id']}}','{{$user['status']}}')">编辑</a> </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        function edituser(userid,status){
            $("#userid").val(userid);
            if(status==1){
                $('input[name=userstatus]').get(0).checked = true;
                $('input[name=userstatus]').get(1).checked = false;
            }else{
                $('input[name=userstatus]').get(0).checked = false;
                $('input[name=userstatus]').get(1).checked = true;
            }
            $("#win").show();
        }
        function edituserstatus(){
            var userid = $("#userid").val();
            var status = $('input:radio[name="userstatus"]:checked').val();
        }
    </script>
@endsection
