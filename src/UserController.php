<?php
namespace WI\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use WI\Locale\Locale;

#use User;

class UserController extends Controller {

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function index()
  {
    #$test  = new \WI\User\User();
    #$test = $test->getTest();
    #$users = User::all();
    #$pagination = false;
    #return view('user::index',compact('users','pagination'));


    //auth()->loginUsingId(2);
    //$users = User::with('role','locale')->paginate(5);
    $users = User::with('role','locale')->paginate(20);
    $pagination = ($users instanceof LengthAwarePaginator);
    return view('user::index',compact('users','columnNames','pagination'));
  }



  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //auth()->loginUsingId(1);
    $user = User::findOrFail($id);
    if (\Gate::denies('editProfile',($user))){
      dc('edit denied');
      //abort('401include');
    }
    $roles = Role::lists('name','id');
    $locales = Locale::lists('name','id');
    return view('user::edit',compact('user','roles','locales'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UserRequest $request,$userId)
  {
    //
    //dc($request);
    $user = User::findOrFail($userId);
    //dd($user);
    if (\Gate::denies('editProfile',($user))){
      dc('deniedd');
      //abort('401include');
    }
    $user->update($request->all());
    Flash::success('[REDIRECT] <bR>User '.$request['name'].' has been updated!<br>'.request()['feedback'].'<br>');
    return redirect()->back();
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $roles = Role::lists('name','id');
    $locales = Locale::where('status','<>','disabled')->lists('name','id');
    return view('user::create',compact('roles','locales'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(UserRequest $request)
  {
    //dc($request->all());
    try
    {
      User::create($request->all());
      Flash::success('Gebruiker '.$request['name'].' is succesvol toegevoegd');
    }
    catch (\Exception $e)
    {
      Flash::error('Niet gelukt: '.$e->getMessage());
      //send mail with subject "db import failed" and body of $e->getMessage()
    }
    return redirect()->route('user.index');
    //return redirect('user.index');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    //Auth::logout();
    $action = DB::transaction(function () use ($id) {
      try {
        User::destroy($id);
        if (request()->ajax()) {
          $data = ['status' => 'succes', 'statusText' => 'Ok', 'responseText' => 'Delete is gelukt'];
          return response()->json($data, 200);
        }
        Flash::success('Delete is geluktJAJA! ' . $id . '');
      }
      catch (\Exception $e) {
        if (request()->ajax()){
          $data = ['status' => 'succes', 'statusText' => 'Fail', 'responseText' => '' . $e->getMessage() . ''];
          return response()->json($data, 400);
        }
        Flash::error('Delete is mislukt!<br>' . $e->getMessage() . ' ' . $id . '');
      }
    });

    if(request()->ajax()){
      return $action;
    }
    return redirect()->back();
  }



}