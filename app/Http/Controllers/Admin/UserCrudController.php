<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\PermissionsRecipients;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Requests\CrudRequest;
use Backpack\PermissionManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;

class UserCrudController extends CrudController
{


    public function setup()
    {

        /*

           $user = \Auth::user();

           if((!$user->hasRole('admin'))||((!$user->hasRole('user')))||((!$user->hasRole('editor'))))  {

             return redirect()->action('Admin\UserCrudController@edit',['id'=>$user->id]);  
             exit; 

            }

        */
        /*
        var_dump(User::statusArray()); 
        exit;
        */

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(config('backpack.base.user_model_fqn'));
        $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
        $this->crud->setRoute(config('backpack.base.route_prefix').'/user');
        
        // Columns.
// 


        $this->crud->setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name' => 'surname',
                'label' => 'Apellido',
                'type' => 'text'
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [
                'name' => 'ocupation',
                'label' => 'Ocupación en UNTREF',
                'type' => 'text'
            ],
            [
                'name' => 'status',
                'label' => "Habilitación",
                'type' => 'select_from_array',
                'options' => User::statusArray(),
            ],
            [
                'name' => 'created_at',
                'label' => 'Fecha de solicitud',
                'type' => 'date'
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.roles'), // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'roles', // the method that defines the relationship in your Model
                'entity'    => 'roles', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.role'), // foreign key model
            ],
            [ // n-n relationship (with pivot table)
                'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
                'type'      => 'select_multiple',
                'name'      => 'permissions', // the method that defines the relationship in your Model
                'entity'    => 'permissions', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'model'     => config('permission.models.permission'), // foreign key model
            ],
        ]);
        
        // Fields checkeados

        $this->crud->addFields([
            [
                'name'  => 'name',
                'label' => trans('backpack::permissionmanager.name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'valuejson',
                'label' => 'valuejson',
                'type'  => 'hidden',
            ],
            [
                'name'  => 'temporal',
                'label' => 'temporal',
                'type'  => 'hidden',
            ],
            [
                'name'  => 'checkeados',
                'label' => 'checkeados',
                'type'  => 'hidden',
            ],
            [
                'name'  => 'itemselected',
                'label' => 'itemselected',
                'type'  => 'hidden',
            ],
            [
                'name' => 'surname',
                'label' => 'Apellido',
                'type' => 'text'
            ],
            [
                'name'  => 'email',
                'label' => trans('backpack::permissionmanager.email'),
                'type'  => 'email',
            ],
            [
                'name' => 'ocupation',
                'label' => 'Ocupación en UNTREF',
                'type' => 'text'
            ],
            [
                'name' => 'status',
                'label' => "Habilitación",
                'type' => 'select2_from_array',
                'options' => User::statusArray(),
                'allows_null' => false,
                'default' => 0,
            ],
            [
                'name'  => 'password',
                'label' => trans('backpack::permissionmanager.password'),
                'type'  => 'password',
            ],
            [
                'name'  => 'password_confirmation',
                'label' => trans('backpack::permissionmanager.password_confirmation'),
                'type'  => 'password',
            ],
            [
                // two interconnected entities
                'label'             => trans('backpack::permissionmanager.user_role_permission'),
                'field_unique_name' => 'user_role_permission',
                'type'              => 'checklist_dependency',
                'name'              => 'roles_and_permissions', // the methods that defines the relationship in your Model
                'subfields'         => [
                    'primary' => [
                        'label'            => trans('backpack::permissionmanager.roles'),
                        'name'             => 'roles', // the method that defines the relationship in your Model
                        'entity'           => 'roles', // the method that defines the relationship in your Model
                        'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
                        'attribute'        => 'name', // foreign key attribute that is shown to user
                        'model'            => config('permission.models.role'), // foreign key model
                        'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns'   => 3, //can be 1,2,3,4,6
                    ],
                    'secondary' => [
                        'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
                        'name'           => 'permissions', // the method that defines the relationship in your Model
                        'entity'         => 'permissions', // the method that defines the relationship in your Model
                        'entity_primary' => 'roles', // the method that defines the relationship in your Model
                        'attribute'      => 'name', // foreign key attribute that is shown to user
                        'model'          => config('permission.models.permission'), // foreign key model
                        'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
                        'number_columns' => 3, //can be 1,2,3,4,6
                    ],
                ],
            ],
        ]);
    }
    
    /**
     * Store a newly created resource in the database.
     *
     * @param StoreRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    //          CrudRequest
    public function store(Request $request)
    {



        $this->handlePasswordInput($request);

        $f = parent::storeCrud($request);


        if($request->roles_show){

            $rol = $request->roles_show[0];

            \DB::table('model_has_roles')->insert(
                ['role_id'     => $rol,
                 'model_id'   => $f[1],
                 'model_type' => 'App\User'
                ]
            );

        }



        if(!empty($request->itemselected)){

            $ma = json_decode($request->itemselected);

            foreach ($ma as $key => $value) {

                $ch = 0;

                if(!empty(json_decode($request->checkeados))){

                    $rom = json_decode($request->checkeados);

                    if (in_array($value, $rom)) {
                        $ch = 1;
                    }
                }

                $permreci               = new PermissionsRecipients();
                $permreci->user_id      = $f[1];
                $permreci->recipient_id = $value;
                $permreci->actions      = $ch;
                $permreci->save();
         
            }

        }

        return $f[0];

    }
    
    /**
     * Update the specified resource in the database.
     *
     * @param UpdateRequest $request - type injection used for validation using Requests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {


/*
Arreglar asignacion de usuario a rol **********
dd($request->all());
exit; 
*/

        $this->handlePasswordInput($request);
        $a = parent::updateCrud($request);

        $delet = PermissionsRecipients::where("user_id",$request->id);
        $delet->delete();


        if(!empty($request->itemselected)){

            $ma = json_decode($request->itemselected);


            foreach ($ma as $key => $value) {

                $ch = 0;

                if(!empty($request->checkeados)){

                    if(!empty(json_decode($request->checkeados))){

                        $rom = json_decode($request->checkeados);

                        if (in_array($value, $rom)) {
                            $ch = 1;
                        }
                    }

                }

                //  Para usuario admin, puede editarse las areas seleccionadas


                $permreci               = new PermissionsRecipients();
                $permreci->user_id      = $request->id;
                $permreci->recipient_id = $value;
                $permreci->actions      = $ch;
                $permreci->save();
         
            }

        }





        return $a; 

    }
    




    public function getUser(){


        $data = array();

        foreach (User::all()->toArray() as $key => $value) {
            $data[$value['id']] = $value;
        }

        echo json_encode(array(
            "status"   => "ok",
            "data"     => $data,
            "hability" => User::statusArray()
        ));

        exit; 

    }


    public function updateUser(Request $request){


        if ($request->all()) {
            $user = User::find($request->id_user);
            $user->status = $request->status;
            $user->save();
            return response()->json(['success' => 'success', 200]);
        }

    }




    /**
     * Handle password input fields.
     *
     * @param CrudRequest $request
     */
    protected function handlePasswordInput(Request $request)
    {

    // Remove fields not present on the user.
    //   $request->remove('password_confirmation');
     unset($request['password_confirmation']);
        
        // Encrypt password if specified.
        if ($request->password) {
            //   $request->set('password', bcrypt($request->input('password')));
            $request['password'] = bcrypt($request->password);

        } else {
                unset($request['password']);
        }

    }
}
