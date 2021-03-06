<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\home\PasswordEdit;
use App\Models\User;
use App\Models\ArticleCate;
use App\Models\Article;
use Hash;
class UserinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home/user/userinfo');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
       $user = User::find(session('user')['id']);
       $user->nickname = $request->nickname;
       $user->sex = $request->sex;
       $user->intro = $request->intro;
       if($request->hasFile('face')){
            $path = $request->file('face')->store('images');
            $user->face='/uploads/'.$path;
        }
       $res = $user->save();
       if($res){
         session(['user'=>$user]);
         $user->msg = 'success';
         echo json_encode($user);
       }else{
        $arr = ['msg'=>'error'];
        echo json_encode($arr);
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
        //
    }
    

    public function showSetPassword()
    {
        return view('home/user/setPassword');
    }

    public function setPassword(PasswordEdit $request)
    {
       $request->flash();
       $user = User::find(session('user')['id']);
       if(!Hash::check($request->oldPwd_edit,$user->pwd)){
          return back()->with('error','原密码错误');  
            }
       $user->pwd = Hash::make($request->newPwd_edit);
       $user->save();
       session(['user'=>'']);
       return redirect('home/article');     
    }
}
