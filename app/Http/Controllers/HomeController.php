<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Task;
use App\User;
use Illuminate\support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $user=User::find($user_id);
        return view('home')->with('userlist',$user->task);
    }

    public function postAdd(Request $request)
    {
        $check = Validator::make($request->all(), array(
            'tasktitle' => 'required|min:5',
            'taskdesc' => 'required|min:5',
            'tasktime' => 'required'
        ));
        if ($check->fails()) {
            return redirect()->to('/')->withErrors($check)->withInput();
        } else {
            $tasktitle = $request->input('tasktitle');
            $taskdesc = $request->input('taskdesc');
            $tasktime = $request->input('tasktime');


            $save = Task::create(array(
                'task_title' => $tasktitle,
                'task_desc' => $taskdesc,
                'task_time' => Carbon::parse($request->tasktime),
                'user_id' => auth()->id()
            ));
            if ($save) {
                return redirect()->to('/');
            }
        }

    }

    public function getDelete($id = 0)
    {
        if ($id != 0) {
            $get=User::find(Auth::user()->id);
            $del=$get->task->find($id)->delete();
            if ($del) {
                return redirect()->to('/');
            } else
                return null;
        }

    }

    public function getUpdate($id = 0)
    {
        $user_id = Auth::user()->id;
        $user=User::find($user_id);
        $gettask = Task::whereRaw('id=?', array($id))->first();
        return view('home', array('userlist' => $user->task, 'taskupdate' => $gettask));

    }

    public function postUpdate(Request $request)
    {
        $check = Validator::make($request->all(), array(
            'tasktitle' => 'required|min:5',
            'taskdesc' => 'required|min:5',
            'tasktime' => 'required'
        ));
        if ($check->fails()) {
            return redirect()->to('/')->withErrors($check)->withInput();
        }
        else {
            $taskid= $request->input('taskid');
            $tasktitle = $request->input('tasktitle');
            $taskdesc = $request->input('taskdesc');
            $tasktime = $request->input('tasktime');


            $tasknew = Task::find($taskid);
            $tasknew->task_title=$tasktitle;
            $tasknew->task_desc=$taskdesc;
            $tasknew->task_time=$tasktime;
            $tasknew->save();

            return redirect()->to('/');


        }
    }
}