<?php

namespace App\Http\Controllers\MemberAuth;

use App\Member;
use Validator;
use Hash;
use DB;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\AdminPanel;

class AuthMemberController extends Controller {

    use AuthenticatesAndRegistersUsers,
        ThrottlesLogins;

//

    var $fieldRegistration;
    var $member;
    public $guard = 'member';
    protected $redirectTo = '/homes';

    public function __construct() {
        $this->fieldRegistration = \App\FieldRegistration::all();
        $this->member = \App\Member::all();
        $this->validator = ['pathFotoAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
            'pathFotoAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
            'pathFotoAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
        ];
    }

    public function index() {
        
    }

    public function getRegister() {
        $dataPanel = AdminPanel::all()->last();
        if ($dataPanel->registrationGate == 'open') {
            $statusPendaftaran = 0;
            $fieldRegistration = DB::table('field_registration')->take(7)->get();
            return view('pages/MemberPages/registerPage', array(
                'title' => 'Register Page',
                'fieldRegistration' => $fieldRegistration,
                'dataPanel' => $dataPanel
            ));
        } else {
            return redirect('/');
        }
    }

    public function postRegister(Request $request) {

        $fieldRegistrations = $this->fieldRegistration;
        $fieldRegistrations_parameter_name = $this->fieldRegistration->pluck('parameter_name');
        $destination = base_path() . '/images/';

        //If the user is isset
        if ($request->input('status') == 'update') {
            $fieldRegistrations = $this->fieldRegistration;
            $fieldRegistrations_parameter_name = $this->fieldRegistration->pluck('parameter_name');
            $member = Member::where('username', $request->username)->first();
        //Different validator

            $validator = Validator::make($request->all(), [
                        'password' => ['confirmed'],
                        'pathFotoAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathKartuPelajarAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathFotoAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathKartuPelajarAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathFotoAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathKartuPelajarAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathFotoPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathKTPPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                        'pathBuktiPembayaran' => ['mimes:jpeg,jpg,png', 'max:500'],
                        //Bukti Pembayaran 2
                        'pathBuktiPembayaranTahap2' => ['mimes:jpeg,jpg,png', 'max:500'],
            ]);

            if ($request->input('submit') == 'save') {
                
            } elseif ($request->input('submit') == 'submit') {
                $validator = Validator::make($request->all(), [
                            'password' => ['confirmed'],
                            'namaLengkapAnggota1' => 'required',
                            'namaLengkapAnggota2' => 'required',
                            'namaLengkapAnggota3' => 'required',
                            'kelasAnggota1' => 'required',
                            'kelasAnggota2' => 'required',
                            'kelasAnggota3' => 'required',
                            'noHpAnggota1' => 'required',
                            'noHpAnggota2' => 'required',
                            'noHpAnggota3' => 'required',
                            'emailAnggota1' => 'required',
                            'emailAnggota2' => 'required',
                            'emailAnggota3' => 'required',
                            'namaLengkapPebimbing' => 'required',
                            'noIndukPebimbing' => 'required',
                            'noHpPebimbing' => 'required',
                            'emailPebimbing' => 'required',
                            'pathFotoAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKartuPelajarAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathFotoAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKartuPelajarAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathFotoAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKartuPelajarAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathFotoPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKTPPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathBuktiPembayaran' => ['mimes:jpeg,jpg,png', 'max:500'],
                            //Bukti Pembayaran 2
                            'pathBuktiPembayaranTahap2' => ['mimes:jpeg,jpg,png', 'max:500'],
//                            
                ]);

                $member->statusPendaftaran = 1;
            }
        }
//If the user is not isset
        elseif ($request->input('status') == 'notUpdate') {
            $member = new Member;
//Different validator
            foreach ($fieldRegistrations as $fieldRegistrations) {

                $validator = Validator::make($request->all(), [
                            'password' => ['confirmed'],
                            'username' => 'unique:member',
                            'pathFotoAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKartuPelajarAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathFotoAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKartuPelajarAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathFotoAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKartuPelajarAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathFotoPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathKTPPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                            'pathBuktiPembayaran' => ['mimes:jpeg,jpg,png', 'max:500'],
                ]);
                if ($request->input('submit') == 'save') {
                    
                } elseif ($request->input('submit') == 'submit') {
                    $validator = Validator::make($request->all(), [
                                'password' => ['confirmed'],
                                'username' => 'unique:member',
                                'namaLengkapAnggota1' => 'required',
                                'namaLengkapAnggota2' => 'required',
                                'namaLengkapAnggota3' => 'required',
                                'kelasAnggota1' => 'required',
                                'kelasAnggota2' => 'required',
                                'kelasAnggota3' => 'required',
                                'noHpAnggota1' => 'required',
                                'noHpAnggota2' => 'required',
                                'noHpAnggota3' => 'required',
                                'emailAnggota1' => 'required',
                                'emailAnggota2' => 'required',
                                'emailAnggota3' => 'required',
                                'namaLengkapPebimbing' => 'required',
                                'noIndukPebimbing' => 'required',
                                'noHpPebimbing' => 'required',
                                'emailPebimbing' => 'required',
                                'pathFotoAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathKartuPelajarAnggota1' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathFotoAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathKartuPelajarAnggota2' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathFotoAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathKartuPelajarAnggota3' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathFotoPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathKTPPebimbing' => ['mimes:jpeg,jpg,png', 'max:500'],
                                'pathBuktiPembayaran' => ['mimes:jpeg,jpg,png', 'max:500'],
//                            
                    ]);
//change status pendaftaran into compeleted
                    $member->statusPendaftaran = 1;
                }
            }
        } else {
            echo "register error";
        }


        if ($validator->fails()) {
            if ($request->input('status') == 'update') {
                return redirect('/profile/' . auth("member")->user()->username . '/edit')->withInput()->withErrors($validator);
            } else {
                return redirect('/register')->withInput()->withErrors($validator);
            }
        }
        $fieldRegistrations = $this->fieldRegistration;
        $fieldRegistrations_parameter_name = $this->fieldRegistration->pluck('parameter_name');
// Save All data
        for ($i = 0; $i < sizeof($fieldRegistrations); $i++) {
            if ((($fieldRegistrations[$i]->type_question) == 'file') && $request->hasFile($fieldRegistrations[$i]->parameter_name)) {
                $extension = Input::file($fieldRegistrations[$i]->parameter_name)->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '-' . time() . '.' . $extension; // renameing image
                $request->file($fieldRegistrations[$i]->parameter_name)->move($destination, $fileName);
                $member->$fieldRegistrations_parameter_name[$i] = $fileName;
                echo $fieldRegistrations[$i]->parameter_name;
            } elseif ((!$request->has($fieldRegistrations[$i]->parameter_name)) && (!(($fieldRegistrations[$i]->type_question) == 'file')) && (!(($fieldRegistrations[$i]->type_question) == 'password'))) {
                $member->$fieldRegistrations_parameter_name[$i] = '';
            } elseif ($request->has($fieldRegistrations[$i]->parameter_name)) {
                if (($fieldRegistrations[$i]->type_question) == 'password') {
                    $member->$fieldRegistrations_parameter_name[$i] = bcrypt(Input::get($fieldRegistrations[$i]->parameter_name));
                } else {
                    $member->$fieldRegistrations_parameter_name[$i] = Input::get($fieldRegistrations[$i]->parameter_name);
                }
            }
        }
//save all the data stored
        $member->save();
        if ($request->input('status') == 'update') {
            if ($request->input('admin') == 1) {
                return redirect('/admin/member');
            } else {
                return redirect('/profile/' . $request->input('username'));
            }
        } else {
            $request->session()->flash('status', 'Terima kasih telah mendaftar');
            return redirect('/');
        }
    }

    public function getLogin() {
        $dataPanel = AdminPanel::all()->last();
        return view('pages/MemberPages/loginPage', array(
            'title' => 'Login Page',
            'fieldRegistration' => $this->fieldRegistration->take(2),
            'dataPanel' => $dataPanel
        ));
    }

    public function getDownload($username, $file) {
//PDF file is stored under project/public/download/info.pdf
        $filepath = base_path() . '/images/' . $file;

        $headers = array(
            'Content-Type: application/pdf/jpg/png',
        );
        return response()->download($filepath, $file, $headers);
    }

    public function postLogin(Request $request) {

        $validator = Validator::make($request->all(), [
                    'username' => 'exists:member',
        ]);
        if ($validator->fails()) {
            return redirect('/login')->withInput()->withErrors($validator);
        }

        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );
        if (auth('member')->attempt($userdata)) {
            return redirect("profile/" . auth("member")->user()->username);
        } else {
            $request->session()->flash('status', 'username dan password tidak sesuai');
            return redirect('/');
        }
    }

    public function getLogout() {
        Auth::guard('member')->logout();
        return redirect('/');
    }

}
