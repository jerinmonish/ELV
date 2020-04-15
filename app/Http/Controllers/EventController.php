<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LERHelper;
use yajra\Datatables\Datatables;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\UserViewed;
use App\Models\UserLiked;
use App\Imports\UsersImport;
use Redirect;
use Session;
use File;
use Auth;
use Excel;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.events.index');
    }

    public function listAllEvents(){
        $events = Event::all();
        return Datatables::of($events)
                        ->addColumn('viewLink', function ($events) {
                            return '<a title="View" href="'.route('event.show',array(LERHelper::encryptUrl(@$events->id))).'" class="btn btn-primary"><i class="fa fa-eye"></i></a> <a title="Edit" href="'.route('event.edit',array(LERHelper::encryptUrl(@$events->id))).'" class="btn btn-info"><i class="fa fa-pencil"></i></a>  <a title="Delete" href="'.route('event.delete',array(LERHelper::encryptUrl(@$events->id))).'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this item ?\')"><i class="fa fa-trash"></i></a> '; 
                        })->editColumn('created_at', function ($events) {
                            return LERHelper::formatDate($events->created_at);
                        })->editColumn('updated_at', function ($events) {
                            return LERHelper::formatDate($events->created_at);
                        })->editColumn('event_scheduled', function ($events) {
                            return LERHelper::adminViewDate2($events->event_scheduled_date.$events->event_scheduled);
                        })
                        ->rawColumns(['viewLink'])
                        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $data = $request->all();
        // print_r($data['event_scheduled']);exit;
        if(!empty($request->file('event_fname'))){
            $file = $request->file('event_fname');
            $filename = date('dmyhis').'_'.$file->getClientOriginalName();
            $path = public_path().'/uploads/events/';
            $file->move($path, $filename);
            $data['event_scheduled_date'] = date('Y-m-d',strtotime($data['event_scheduled_date']));
            $data['event_scheduled']      = date('H:i',strtotime($data['event_scheduled']));
            $data['event_fname']          = $filename;
            $event = new Event($data);
            $event->save();
            return redirect()->route('event.index')->with('success',trans('main.events.addsuccess'));
        } else {
            return redirect()->route('event.index')->with('error',trans('main.events.adderror'));
        }
    }


    public function importExcelSave(Request $request)
    {
        $request->validate([
            'upload_file' => 'required|mimes:csv,txt'
        ]);

        $path1 = $request->file('upload_file')->store('temp'); 
        $path=storage_path('app').'/'.$path1;  
        try {
            Excel::import(new UsersImport, $path);
        } catch (\Exception $e) {
            // $failures = $e->message();
            return back()->with('error', $e->getMessage().': Some error, check the file and upload the file');
        }
        // $data = Excel::import(new UsersImport, $path);
        return back()->with('success', 'Insert Record successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = LERHelper::decryptUrl($id);
        $data['event']      = Event::findOrFail($id);
        $data['viewedCont'] = UserViewed::where('event_id',$id)->get();
        $data['viewedLCont'] = UserLiked::where('event_id',$id)->get();
        return view('admin.events.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = LERHelper::decryptUrl($id);
        $data['event'] = Event::where('id', $id)->first();
        return view('admin.events.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::find($id);
        $data = $request->all();

        if(!empty($request->file('event_fname'))){
            $file_path = public_path().'/uploads/events/'.$event->event_fname;
            @unlink($file_path);
            $file = $request->file('event_fname');
            $filename = date('dmyhis').'_'.$file->getClientOriginalName();
            $path = public_path().'/uploads/events/';
            $file->move($path, $filename);
            $data['event_fname'] = $filename;
        } 
            $data['event_scheduled_date'] = date('Y-m-d',strtotime($data['event_scheduled_date']));
            $data['event_scheduled']      = date('H:i',strtotime($data['event_scheduled']));

         if ($event->update($data)) {
             return redirect()->route('event.index')->with('success',trans('main.events.updatesuccess'));
        } else {
            return redirect()->route('event.index')->with('error',trans('main.events.updateerror'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = LERHelper::decryptUrl($id);
        $files = Event::findOrFail($id);
        $file_path = public_path().'/uploads/events/'.$files->event_fname;
        @unlink($file_path);
        $files->delete();
        return redirect()->route('event.index')->with('success',trans('main.events.deletesuccess'));
    }

    public function viewers_list($id){
        $id = LERHelper::decryptUrl($id);
        $user['user_list'] = UserViewed::where('event_id',$id)->get();
        if($user['user_list']->count() > 0){
            return view('admin.viewed_list',$user);
        } else {
            return redirect()->back()->with(['error' => trans('main.events.no_event')]); 
        }
    }
}
