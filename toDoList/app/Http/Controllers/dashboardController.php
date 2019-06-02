<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
Use Redirect;
use Carbon\Carbon;

class dashboardController extends Controller
{
    public function index(){
         $data = DB::table('tasks')->leftJoin('comments','comments.task_id','=','tasks.id')
                                    ->groupBy('tasks.id')
                                    ->orderBy('created_at','desc')
                                    ->select('tasks.*',DB::raw('COALESCE(COUNT(comments.task_id),0) as count'))
                                    ->paginate(6);
            foreach($data as $d){
                $table[$d->status_id][]=['id'=>$d->id,'name'=>$d->name,'comment_count'=>$d->count,
                                        'description'=>$d->description,'status_id'=>$d->status_id];
            }
            
        $statuses = DB::table('statuses')->get();
            if(!empty($data) && !empty($table)){
                return view('dashboard',['data'=>$table,'links'=>$data,'statuses'=>$statuses]);
            }else{
                return view('dashboard',['data'=>[],'links'=>[],'statuses'=>$statuses]);
            }
    }

    public function createTask(Request $request){
        $data = $request->input();
        $validator = Validator::make($request->input(), array(
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',         
        ));

        if ($validator->fails()) {
             return response()->json([
                 'error'    => true,
                 'messages' => $validator->errors(),
             ], 422);
        }
        $result = DB::table('tasks')->insert(
            [
                'name' => $data['name'],
                'description' => $data['description'],
                'status_id' => $data['status'],
                'created_at'=>Carbon::now()->setTimezone('3')->toDateTimeString(),
                'updated_at'=>Carbon::now()->setTimezone('3')->toDateTimeString(),
            ]
        );
        return response()->json([
            'name' => $data['name'],
            'description' => $data['description'],
            'status_id' => $data['status'],
        ], 200);
       
    }

    public function update($id,Request $request){
        $data = $request->input();
        $validator = Validator::make($request->input(), array(
            'newName' => 'required',
            'description' => 'required',
            
        ));
        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }
        DB::table('tasks')->where('id', $id)->update(['name' => $data['newName'],'description'=>$data['description'],'status_id'=>$data['status_id'],'updated_at'=>Carbon::now()->setTimezone('3')->toDateTimeString()]);
        if($data['comment']!=''){
            DB::table('comments')->insert([
                'task_id'=>$id,
                'text_comment'=>$data['comment'],
                'created_at'=>Carbon::now()->setTimezone('3')->toDateTimeString(),
                'updated_at'=>Carbon::now()->setTimezone('3')->toDateTimeString(),
            ]);
        }
        
            return response()->json([
                'error' => false,
                'task'  => $data['newName'],
            ], 200);
    }

    public function getComments($id){
        return json_encode(DB::table('comments')->where('task_id',$id)->get());
    }
}
