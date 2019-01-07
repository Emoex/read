<?php

namespace App\Http\Controllers\home;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\home\timelineStore;
use App\Models\admin\timeline;
use DB;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if( $p = $request->input('p') && $num=$request->input('num') ){
            $p = $request->input('p');
            $data = timeline::offset(($p-1)*$num)->limit($num)->orderBy('time','desc')->get();
            if(!$data->isEmpty()){
                echo json_encode($data);
            }else{
                echo json_encode(['msg'=>'error']);
            }
        }else{
            return view('home/Timeline/index');
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dump($request->all());
        if(!$request->filled('content')){
            echo 'Kerror';
        }else{
            $data = $request->except('profile');
            if($data['cid'] == '秘密'){
                $data['public'] = 2;
            }else{
                $data['public'] = 1;
            }
            
            $data['time'] = date('Y-m-d H:i:s',time());
            if($request->hasfile('profile')){
                $image = $request->file('profile')->store('images');
                $data['image'] = $image;
                $res = timeline::insert($data);
                if($res){
                    echo 'success';
                }else{
                    echo 'Serror';
                }     
            }else{
                $res = timeline::insert($data);
                if($res){
                    echo 'success';
                }else{
                    echo 'Serror';
                }
            }
        }
        

        // $data = $request->all();
        // dump($data);
        // echo 111;
        // $data = $request->except('_token');
        // $data['time'] = date('Y-m-d H:i:s');
        // $data['like'] = 111;
        // $data['look'] = 111;
        // if($data['cid'] == '秘密'){
        //     $data['public'] = 2;
        // }else{
        //     $data['public'] = 1;
        // }
        // dump($data);
        // if (!$request->filled('content')) {
        //     echo 'error';
        // }else{
        //     echo 'success';
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = timeline::find($id);
        return view('home/Timeline/show',['data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
