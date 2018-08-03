<?php

namespace App\Http\Controllers\Auth;

use App\Models\AreaUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends \Backpack\Base\app\Http\Controllers\Auth\RegisterController {
    
    protected function validator(array $data) {
        $user = new User();
        $users_table = $user->getTable();
        
        return Validator::make($data, [
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email'    => 'required|email|max:255|unique:'.$users_table,
            'ocupation' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    protected function create(array $data) {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'ocupation' => $data['ocupation'],
            'password' => bcrypt($data['password']),
        ]);
    
        if (isset($data['areas'])) {
            foreach ($data['areas'] as $area) {
                AreaUser::create([
                    'area_id' => $area,
                    'user_id' => $user->id
                ]);
            }
        }
        
        return $user;
    }
    
    public function register(Request $request) {
        // if registration is closed, deny access
        if (!config('backpack.base.registration_open')) {
            abort(403, trans('backpack::base.registration_closed'));
        }
        
        $this->validator($request->all())->validate();
        
        $this->create($request->all());

       // show a success message
       \Alert::success("Usuario agregado correctamente!")->flash();
    
        return redirect(backpack_url('login'));
    }
}
