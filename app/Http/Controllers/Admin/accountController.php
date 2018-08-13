<?php

namespace Backpack\Base\app\Http\Controllers\Auth;
namespace App\Http\Controllers\Admin;

use Auth;
use Alert;
use App\User;
use App\Models\Area;
use Illuminate\Http\Request;
use Backpack\Base\app\Http\Controllers\Controller;
use Backpack\Base\app\Http\Requests\AccountInfoRequest;
use Backpack\Base\app\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;

class accountController extends \Backpack\Base\app\Http\Controllers\Auth\MyAccountController
{
    protected $data = [];

    public function __construct()
    {
   
        $this->middleware(backpack_middleware());
    }

    /**
     * Show the user a form to change his personal information.
     */
    public function getAccountInfoForm()
    {
        $this->data['title'] = trans('backpack::base.my_account');
        $this->data['user'] = $this->guard()->user();

        return view('backpack::auth.account.update_info', $this->data);
    }

    /**
     * Save the modified personal information for a user.
     */
    public function postAccountInfoForm(AccountInfoRequest $request)
    {
        $result = $this->guard()->user()->update($request->except(['_token']));

        if ($result) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }


    /**
     * Show the user a form to change his login password.
     */
    public function getChangePasswordForm()
    {
        $this->data['title'] = trans('backpack::base.my_account');
        $this->data['user'] = $this->guard()->user();

        return view('backpack::auth.account.change_password', $this->data);
    }



    /**
     * Show the user a form to change his login password.
     */
    public function my_profile()
    {

        $user = \Auth::user();

        $this->data['areas']         = Area::all();
        $myUser                      = User::where('id',$user->id)->get()->toArray();
        $this->data['user']          = $myUser[0];
        $this->data['areas_defined'] = \DB::table('area_user')->select('area_id')->where("user_id",$this->data['user']['id'])->get();


        $areas = array();

        if(!empty($this->data['areas_defined'])){

            foreach ($this->data['areas_defined'] as $key2 => $value2) {
                array_push($areas, $value2->area_id);
            }

            $this->data['areas_defined'] = $areas;
        }

        return view('backpack::auth.account.my_profile', $this->data);
    }




    public function UpdateAreasUser(Request $request){


            \DB::table('area_user')->where('user_id', $request->user_id)->delete();

            $newSelect = array();

            if(!empty($request->areas_selected)){

                $newSelect  = json_decode($request->areas_selected);

                foreach ($newSelect as $key => $value) {
                    
                    \DB::table('area_user')->insert(['user_id' => $request->user_id,'area_id' => $value]);

                }
            }


            \Alert::success("Las areas se modificaron correctamente")->flash();

            return redirect()->back();

    }



    /**
     * Save the new password for a user.
     */
    public function postChangePasswordForm(ChangePasswordRequest $request)
    {
        $user = $this->guard()->user();
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            Alert::success(trans('backpack::base.account_updated'))->flash();
        } else {
            Alert::error(trans('backpack::base.error_saving'))->flash();
        }

        return redirect()->back();
    }

    /**
     * Get the guard to be used for account manipulation.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return backpack_auth();
    }
}
