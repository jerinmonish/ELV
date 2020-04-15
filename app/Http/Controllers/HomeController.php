<?php

namespace App\Http\Controllers;

use yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\Models\UserLiked;
use App\Models\UserViewed;
use App\Helpers\LERHelper;
use App\Models\Event;
use Carbon\Carbon;
use Redirect;
use Session;
use File;
use Auth;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function list_events(){
        return view('list_events');
    }
    //To list todays events alone
    public function list_todays_events(){
        $today_event = Event::where('event_status', 'Active')->where('event_scheduled_date', '=',Carbon::today()->toDateString())->get();
        // print_r();exit;
        return Datatables::of($today_event)
                        ->addColumn('viewLink', function ($today_event) {
                            $like = UserLiked::where('event_id',$today_event->id)->count();
                            return '<a title="View" href="'.route('show_events',array(LERHelper::encryptUrl(@$today_event->id))).'" class="btn btn-primary"><i class="fa fa-eye"></i></a> <a title="View" href="#" class="btn btn-primary"><i class="fa fa-thumbs-up" id="setDataLk" onclick="return alert(\'You can like this video in event detail page only !\')">'.@$like.'</i></a>'; 
                        })->editColumn('created_at', function ($today_event) {
                            return LERHelper::formatDate($today_event->created_at);
                        })->editColumn('updated_at', function ($today_event) {
                            return LERHelper::formatDate($today_event->created_at);
                        })->editColumn('event_scheduled', function ($today_event) {
                            return LERHelper::adminViewDate2($today_event->event_scheduled_date.$today_event->event_scheduled);
                        })
                        ->rawColumns(['viewLink'])
                        ->make(true);
    }

    //To list future events alone
    public function list_future_events(){
        // $future_event = Event::where('event_status', 'Active')->where('event_scheduled_date', ">", '"'.Carbon::today()->toDateString().'"')->get();
        $future_event = Event::where('event_status','Active')->where('event_scheduled_date','>',date('Y-m-d'))->get();
        return Datatables::of($future_event)
                        ->addColumn('viewLink', function ($future_event) {
                            return '<a title="View" href="'.route('show_events',array(LERHelper::encryptUrl(@$future_event->id))).'" class="btn btn-primary"><i class="fa fa-eye"></i></a>'; 
                        })->editColumn('created_at', function ($future_event) {
                            return LERHelper::formatDate($future_event->created_at);
                        })->editColumn('updated_at', function ($future_event) {
                            return LERHelper::formatDate($future_event->created_at);
                        })->editColumn('event_scheduled', function ($future_event) {
                            return LERHelper::adminViewDate2($future_event->event_scheduled_date.$future_event->event_scheduled);
                        })
                        ->rawColumns(['viewLink'])
                        ->make(true);
    }

    //To list past events alone
    public function list_past_events(){
        $past_event = Event::where('event_scheduled_date', '<', date('Y-m-d'))->get();
        return Datatables::of($past_event)
                        ->addColumn('viewLink', function ($past_event) {
                            return '<a title="View" href="'.route('show_events',array(LERHelper::encryptUrl(@$past_event->id))).'" class="btn btn-primary"><i class="fa fa-eye"></i></a>'; 
                        })->editColumn('created_at', function ($past_event) {
                            return LERHelper::formatDate($past_event->created_at);
                        })->editColumn('updated_at', function ($past_event) {
                            return LERHelper::formatDate($past_event->created_at);
                        })->editColumn('event_scheduled', function ($past_event) {
                            return LERHelper::adminViewDate2($past_event->event_scheduled_date.$past_event->event_scheduled);
                        })
                        ->rawColumns(['viewLink'])
                        ->make(true);
    }

    //To show event if any based on todays time and data
    public function show_events($id){
        $id = LERHelper::decryptUrl($id);
        $data['event'] = Event::findOrFail($id);
        $data['liked_video'] = UserLiked::all();
        if($data['event']){
            $setTodaysDate = date("Y-m-d H:i").':00';
            $exp = explode(" ", $setTodaysDate);
            $from_time = strtotime($setTodaysDate);
            $to_time = strtotime($data['event']->event_scheduled_date.' '.$data['event']->event_scheduled);
            $minutes = round(abs($to_time - $from_time) / 60,2);
            // print_r($setTodaysDate);exit;
            if($exp[0] == $data['event']->event_scheduled_date){
                if(10 >= $minutes){

                    $like = UserViewed::firstOrNew(array('user_id' => @Auth::user()->id,'event_id'=>$id));
                    $like->user_id = @Auth::user()->id;
                    $like->event_id = $id;
                    $like->save();

                    return view('view_events',$data);
                } else {
                    return redirect()->route('list_events')->with('error',trans('main.events.timeissue').''.LERHelper::formatDate($data['event']->event_scheduled_date).' '.LERHelper::formatMysqlTimedisplay($data['event']->event_scheduled));        
                }
            } else {
                return redirect()->route('list_events')->with('error',trans('main.events.dateissue'));    
            }
        } else {
            return redirect()->route('list_events')->with('error',trans('main.no_data'));
        }
    }

    //To update or add and display new video
    public function like_video(Request $request){
        $data = $request->all();
        $like = UserLiked::firstOrNew(array('user_id' => $data['user_id'],'event_id'=>$data['event_id']));
        $like->user_id = $data['user_id'];
        $like->save();
        $data['get_liked'] = $like->count();
        echo json_encode($data); exit;
    }
}
