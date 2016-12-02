<?php

namespace App\Http\Controllers\AdminAuth;

use Auth;
use App\Admin;
use App\Member;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthAdminController extends Controller {

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

    //
    var $fieldRegistration;
 
    protected $redirectTo = '/homeyss';
    protected $guard = 'admin';

    public function __construct() {
        $this->fieldRegistration = \App\FieldRegistration::all();
        
//        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    public function index() {
        
    }

    public function getLogin() {
        return view('pages/AdminPages/loginAdminPage', array(
            'fieldRegistration' => $this->fieldRegistration->take(2),
        ));
    }

    public function postLogin() {

        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        if (auth('admin')->attempt($userdata)) {

            return redirect('/admin/member');
        } else {
            return redirect('/');
        }
    }

    public function getLogout() {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}
