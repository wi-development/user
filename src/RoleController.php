<?php
namespace WI\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use WI\Core\Entities\Company\Company;
use WI\Locale\Locale;
use Datatables;

#use User;

class RoleController extends Controller {

  /**
  * Display a listing of the resource.
  *
  * @return Response
  */
  public function indexORG()
  {
    #$test  = new \WI\User\User();
    #$test = $test->getTest();
    #$users = User::all();
    #$pagination = false;
    #return view('user::index',compact('users','pagination'));


    //auth()->loginUsingId(2);
    //$users = User::with('role','locale')->paginate(5);
    $users = User::with('roles','locale')->paginate(20);
	  //all role names as array
	  //dc($users[2]->roles->pluck('name')->all());
	  //all role names as string
	  //dc($users[2]->roles->implode('name',','));

    $pagination = ($users instanceof LengthAwarePaginator);
    return view('user::indexORG',compact('users','columnNames','pagination'));
  }




/*
 * INDEX CONTROLLERS
 */

	public function getAllIndex($sitemap_id = 0){
		//dc($sitemap_parent_id);
		$tableConfig = [];
		$tableConfig['allowSortable'] = false;
		$test = 'header test';
		$tableConfig['header'] = 'Rollen';
		//$tableConfig['header'] = 'Alle pagina\'s van \''.$sitemap->translation->name.'\'';
		//$allowed_child_templates = Template::where('parent_id',$sitemap->template->id)->get();
		//$tableConfig['customSearchColumnValues'] = "['online','pending_review','concept']";

		//$roles = Role::all();
		//$roles = ($roles->implode('name','\',\''));
		//$tableConfig['customSearchColumnValues'] = "['".$roles."']";
		$tableConfig['customSearchColumnValues'] = "[]";
		//dc($tableConfig);
		if(request()->ajax()){
		}
		else{
		}


		$allowed_child_templates = [];//onzin
		$breadcrumbAsHTML = 'onzin';
		$sitemap = collect();
		$sitemap->id = 1;
		return view('user::role.index',compact('sitemap','allowed_child_templates','breadcrumbAsHTML','tableConfig'));
		//dc($sitemap->template->id);
		$template = "TEMPLASTE";

		//Gz18jBTf9sSi8epjsVzZy1UlbR2RPJpBx6IxNTEc

	}



	/**
	 * Process datatables ajax request.
	 * Used by 'admin.sitemap.menuIndex' via 'this.getMenuIndex()'
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function allIndexData(Request $request,$sitemap_parent_id = 0)
	{

		$roles = Role::select(['id', 'name', 'label', 'description', 'updated_at']);


		$datatable =  Datatables::of($roles);

		//dd($datatable);

		$datatable->addColumn('action', function ($roles) {
			//<input class="btn btn-cons btn-awesome btn btn-cons btn-awesome btn btn-danger" value="Delete" type="submit">
			$r = "<table><tr><td style='border:none'>";
			$r .= '<a href="'.route('admin::role.edit',['id'=>$roles->id]).'" class="btn btn-success btn-labeled fa fa-pencil mar-rgt">Wijzigen</a>';
			$r .= '</td><td>';
			$r .= "<a class=\"btn btn-danger btn-labeled fa fa-trash-o\" onclick=\"wiDeleteRole(".$roles->id.")\">Verwijderen</a>";
			$r .= '</td></td></table>';
			return $r;
		});
		$var = '';

		$datatable->editColumn('label', function ($role) use ($var) {
			$retval = "<div style='white-space: nowrap'>";
			$retval .= $role->label;
			$retval .= "</div>";
			return $retval;

		});

		$datatable->editColumn('updated_at', function ($role) use ($var) {
			//$retval = $role->updated_at ? with(new Carbon($role->updated_at))->diffForHumans() : '';
			$retval = "<div class=\"extraDataxx\" style='xdisplay:none;white-space: nowrap'>";
			$retval .= "<date>";
			$retval .= $role->updated_at->formatLocalized('%A %d %B');
			$retval .= " <i class=\"fa fa-clock-o\" aria-hidden=\"true\"></i>";
			$retval .= $role->updated_at->format(' h:i');
			$retval .= "</date>";
			$retval .= "</div>";

			return $retval;
		});

		return $datatable->make(true);
	}


  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {

  	  $role = Role::findOrFail($id);
    //if (\Gate::denies('editProfile',($user))){
    //  dc('edit denied');
      //abort('401include');
    //}
	//$roles = Role::lists('name','id');
	//$locales = Locale::lists('name','id');
	//$companies = Company::lists('name','id');
	  //role.edit
	  //user::edit






	  $permissions = Permission::with('permissiontype')->get();



	  $role_permission_ids = $role->permissions()->get()->pluck('id')->all();
	//	dc($role_permission_ids);
	  $prevName = '';
	  $permissions = $permissions->groupBy(function ($item, $key) use ($role_permission_ids) {
		  $item->first = false;
		  $item->last = false;
		  $item->checked = (in_array($item->id, $role_permission_ids));
		  return ($item->permissiontype->name);
	  });
	  //dc($permissions);
	  foreach ($permissions as $key => $permissionType){
		  $permissionType->first = false;
		  $permissionType->last = false;
		  $permissionType->class = ['nav-li' => '','tab-div' => ''];
	  }

	  (head($permissions->all())->first = true);
	  (head($permissions->all())->class = ['nav-li' => 'active','tab-div' => 'active in']);
	  (last($permissions->all())->last = true);

        return view('user::role.edit',compact('role','permissions'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(RoleRequest $request,$id)
  {


  	//dd('UPDATE ROLE');

  	//
    //dc($request);
    $role = Role::findOrFail($id);
    //if (\Gate::denies('editProfile',($user))){
      //dc('deniedd');
      //abort('401include');
    //}

    $role->update($request->all());
	$role->permissions()->sync((array)$request->input('permission_id'));
    Flash::success('De gegevens van '.$request['name'].' zijn aangepast!');
    return redirect()->back();
  }



  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('user::role.create',compact(''));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(RoleRequest $request)
  {

	  $action = DB::transaction(function () use ($request){
		  try {
			  $role = Role::create($request->all());
			  Flash::success('Rol \'' . $request['name'] . '\' is succesvol toegevoegd');
		  } catch (\Exception $e) {
			  Flash::error('Niet gelukt: ' . $e->getMessage());
			  //send mail with subject "db import failed" and body of $e->getMessage()
		  }
	  });
	  return redirect()->route('admin::role.all.index');
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
      	$role = Role::findOrFail($id);
        Role::destroy($id);
          if (request()->ajax()) {
          $data = ['status' => 'succes', 'statusText' => 'Ok', 'responseText' => 'Rol \''.$role->name.'\' is verwijderd'];
          return response()->json($data, 200);
        }
        Flash::success('De rol ' . $id . '');
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