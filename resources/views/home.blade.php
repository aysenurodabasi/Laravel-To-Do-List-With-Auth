@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            @if(isset($taskupdate))
                <div class="panel panel-default">
                    <div class="panel-heading">
                     <input type="submit" class="btn btn-primary" id="taskadd" value="Add New Task">
                    </div>
                    <div class="panel-body" id="formupdate">
                        <form class="form-horizontal" action="{{url('/update')}}" method="POST" >
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-3">Task Time</label>
                                <div class="col-md-9">
                                    <input type="text" id="datepicker" name="tasktime"  class="form-control" value="{{$taskupdate->task_time}}">
                                </div>
                            </div>
                            <input type="hidden" name="taskid" value="{{$taskupdate->id}}">
                            <div class="form-group">
                                <label class="col-md-3">Task Title</label>
                                <div class="col-md-3">
                                    <input type="text" name="tasktitle" class="form-control" value="{{$taskupdate->task_title}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3">Task Description</label>
                                <div class="col-md-3">
                                <textarea name="taskdesc" cols="49" rows="5" class="form-control">{{ $taskupdate->task_desc }} </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3  col-md-offset-4">
                                    <input type="submit" name="send" class="btn btn-primary" value="Add">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @else
            <div class="panel panel-default">
                <div class="panel-heading"><input type="submit" class="btn btn-primary" id="taskadd" value="Add New Task"></div>
                <div class="panel-body" id="formadd" >
                    <form class="form-horizontal" action="{{url('/add')}}" method="POST" >
                        <div class="form-group">
                            <label class="col-md-3">Task Time</label>
                            <div class="col-md-9">
                                <input type="text" id="datepicker" name="tasktime"  class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Task Title</label>
                            <div class="col-md-9">
                                <input type="text" name="tasktitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3">Task Description</label>
                            <div class="col-md-9">
                                <textarea name="taskdesc" cols="54" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3  col-md-offset-3">
                                <input type="submit" name="send" class="btn btn-primary" value="Add">
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
    @endif
            </div>

    <div class="col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-heading" >To Do List</div>
                <div class="panel-body">



                @if($userlist->count() == 0)
                        <div class="card" style="width: 50rem;">
                            <h5 style="font-style: italic; float:right;">Add something to do...</h5>
                        </div>
                @else

                    @foreach($userlist as $userstask)
                        <div class="card" style="width: 50rem;">
                            <h5 class="card-title"  style="font-weight: bold; font-size:16px;">
                                    <a href="" class="tasktitle"> {{$userstask->task_title}}</a>
                                    <button type="button" class="btn btn-default btn-sm okbutton" >
                                        <span class="glyphicon glyphicon-ok" ></span>
                                    </button>
                            </h5>
                            <div class="card-body tasklist"  style="display:none">
                                <ul class="list-group list-group-flush">
                                    <p class="card-text">{{$userstask->task_desc}}</p>
                                    <p class="card-text">({{$userstask->task_time}})</p>
                                    <input class="btn btn-primary" id="update" type="submit" onclick="window.location.href='{{url('/update/'.$userstask->id)}}'" value="Update"/>
                                    <input class="btn btn-primary" id="delete" type="submit" onclick="window.location.href='{{url('/delete/'.$userstask->id)}}'" value="Delete"/>
                                </ul>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
    </div>


    <script>
        $(document).ready(function(e){
            $("#formadd").hide();

            $("#taskadd").click(function(){
                $("#formadd").show();
                return false;
            });

            $("#update").click(function(){
                $("#formupdate").show();
            });

            $('.tasktitle').on('click',function(){
                $(this).closest('.card').find('.tasklist').slideToggle();
            return false;
            });


            $('.okbutton').on('click',function(){
                $(this).closest('.card').find('.tasktitle').toggleClass("stroked");
                return false;

            });

            $(function() {
                $( "#datepicker" ).datepicker({
                    format: 'YYYY-MM-DD H:i:s',
                        altFormat:  'DD-MM-YYYY H:i:s'

                });
            } );
        });
    </script>

@endsection
