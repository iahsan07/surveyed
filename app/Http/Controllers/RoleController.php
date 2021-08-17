<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if(!$user->isAllowed('view_roles')){
            return abort('403');
        }
        $createRole = $user->isAllowed('create_role');
        $editRole = $user->isAllowed('edit_role')?1:0;
        $deleteRole = $user->isAllowed('delete_role')?1:0;
        return view('roles.index',compact('createRole','editRole','deleteRole'));
    }

    public function getAllRoles(Request $request){
        try{
            $roles = Role::select('id','name')->get();
            return response()->json( [
                'success' => true,
                'data' => $roles
            ])->setStatusCode(200);

        } catch (\Exception $e){
            return response()->json( [
                'success' => false,
            ])->setStatusCode(500);
        }

    }

    public function getAllPermissions(Request $request){
        try {
            $permissions = Permission::select('id','name')->get();
            return response()->json( [
                'success' => true,
                'data' => $permissions
            ])->setStatusCode(200);
        } catch (\Exception $e){
            return response()->json( [
                'success' => false,
            ])->setStatusCode(500);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Auth::user()->isAllowed('create_role')){
            return abort('403');
        }
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validateRole($request);
        if($validator){
            return $validator;
        }
        $data = $request->all();
        try {
            DB::transaction(function () use ($data){
                $role = Role::create(['name'=>$data['role']['name'],'slug'=>$data['role']['slug']]);
                $role->permissions()->sync($data['role']['checkedPerms']);
                return response()->json( [
                    'success' => true,
                ])->setStatusCode(200);
            });
        }
        catch (\Exception $e){
            return response()->json( [
                'success' => false,
                's_error' => $e->getMessage(),
                'errors' => [],
            ])->setStatusCode(500);
        }

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

        if(!Auth::user()->isAllowed('edit_role')){
            return abort('403');
        }

        $role = Role::findOrFail($id);
        $perms = $role->permissions()->pluck('permissions.id')->toArray();
        $role->permissions = $perms;

        return view('roles.edit',compact('role'));
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
        $validator = $this->validateRole($request, $id);
        if($validator){
            return $validator;
        }
        $data = $request->all();

        try {
            DB::transaction(function () use ($data, $id){
                $role = Role::find($id);
                $role->name = $data['role']['name'];
                if($role->slug!='super_admin'){
                    $role->slug = $data['role']['slug'];
                    $role->permissions()->sync($data['role']['checkedPerms']);
                }
                $role->save();


                return response()->json( [
                    'success' => true,
                ])->setStatusCode(200);
            });
        }
        catch (\Exception $e){
            return response()->json( [
                'success' => false,
                's_error' => $e->getMessage(),
                'errors' => [],
            ])->setStatusCode(500);
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
        try {

            DB::transaction(function () use ($id){
                $role = Role::find($id);
                $role->permissions()->detach();
                $role->delete();

                return response()->json( [
                    'success' => true,
                ])->setStatusCode(200);
            });

        }
        catch (\Exception $e){
            return response()->json( [
                'success' => false,
                's_error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }

    private function validateRole($request, $id=null){

        if(!is_null($id)){
            $validator = Validator::make($request->all(), [
                'role.name'    => ['required', 'string','max:50'],
                'role.slug'    => ['required', 'string','max:50','unique:roles,slug,'.$id],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'role.name'    => ['required', 'string','max:50'],
                'role.slug'    => ['required', 'string','max:50','unique:roles,slug'],
            ]);
        }

        if ( $validator->fails()) {
            return response()->json( [
                'success' => false,
                's_error' => null,
                'errors'    => [
                    'name'    => $validator->errors()->first( 'role.name' ) ? $validator->errors()->first( 'role.name' ): '',
                    'slug'    => $validator->errors()->first( 'role.slug' ) ? $validator->errors()->first( 'role.slug' ): '',
                ]
            ])->setStatusCode(422);
        }
        return false;
    }
}
