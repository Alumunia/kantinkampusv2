<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Member;
use App\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\AdminPanel;
use App\Choices;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\MemberSuggestion;
use App\WinnerTable;

/**
 * Description of MemberController
 *
 * @author alumunia
 */
class MemberController extends Controller {

    var $dataMember;
    var $titlePage;

    public function __construct() {
        $this->titlePage = 'Member Page';
        $this->middleware('member');
        $this->dataMember = \App\Member::all()->where('username', Auth::guard('member')->user()->username);
        $this->dataAdmin = \App\Admin::where('role', 'admin')->first();
        $this->fieldRegistration = \App\FieldRegistration::all();
    }

    public function index() {

        $username = Auth::guard('member')->user()->username;
        $dataPanel = AdminPanel::all()->last();
        $dt = (new Carbon('first day of September 2016'))->addDay(9)->addSecond(30);
        $timeNow = Carbon::now()->addHours(7);
        $progress = (((46) - ($dt->diffInDays($timeNow))) / 46) * 100;
        $passedMember = winnerTable::where('username', Auth::guard('member')->user()->username)->first();
        // Checking if user is a winner or not
        $choices = Choices::where('username', Auth::guard('member')->user()->username)->first();

        $dataExistTim = DB::table('field_registration')->pluck('parameter_name');
        $number = array(7, 13, 19, 25);
        $posisi = array('Ketua Tim', 'Anggota 1', 'Anggota 2', 'Pembimbing');
        $statusPendaftaran = $this->dataMember->first()->statusPendaftaran;
        return view('pages/MemberPages/memberPage', array(
            'title' => $this->titlePage,
            'dataMember' => $this->dataMember->first(),
            'dataExistTim' => $dataExistTim,
            'dataAdmin' => $this->dataAdmin,
            'statusPendaftaran' => $statusPendaftaran,
            'number' => $number,
            'posisi' => $posisi,
            'dataPanel' => $dataPanel,
            'progress' => $progress,
            'passedMember' => $passedMember,
            'passedMember' => $passedMember,
            'choices' => $choices
        ));
    }

    public function editProfile() {
//        if ($this->dataMember->first()->statusPendaftaran == 0) 
        $dataPanel = AdminPanel::all()->last();
        $statusPendaftaran = $this->dataMember->first()->statusPendaftaran;
        $dataExistTim = DB::table('field_registration')->pluck('parameter_name');
        $dataTim = DB::table('field_registration')->take(7)->get();
        $dataAnggota1 = DB::table('field_registration')->skip(7)->take(6)->get();
        $dataAnggota2 = DB::table('field_registration')->skip(13)->take(6)->get();
        $dataAnggota3 = DB::table('field_registration')->skip(19)->take(6)->get();
        $dataPebimbing = DB::table('field_registration')->skip(25)->take(6)->get();
        $dataLain = DB::table('field_registration')->skip(31)->take(2)->get();
        //Depend On index at database
        $dataLainTahap2 = DB::table('field_registration')->skip(33)->take(1)->get();
        $dataAnggotaArray = array($dataAnggota1, $dataAnggota2, $dataAnggota3);
        $number = array(7, 13, 19, 25);
        $arrayCaption = array('Ketua Tim', 'Anggota 1', 'Anggota 2');

        // Checking if user is a winner or not
        $winnerMember = WinnerTable::where('username', Auth::guard('member')->user()->username)->first();

        return view('pages/MemberPages/registerPage', array(
            'dataExistTim' => $dataExistTim,
            'title' => $this->titlePage,
            'dataAnggotaArray' => array($dataAnggota1, $dataAnggota2, $dataAnggota3),
            'dataMember' => $this->dataMember->first(),
            'number' => $number,
            'arrayCaption' => $arrayCaption,
            'statusPendaftaran' => $statusPendaftaran,
            'fieldRegistration_dataTim' => $dataTim,
            'fieldRegistration_dataAnggota1' => $dataAnggota1,
            'fieldRegistration_dataAnggota2' => $dataAnggota2,
            'fieldRegistration_dataAnggota3' => $dataAnggota3,
            'fieldRegistration_dataPebimbing' => $dataPebimbing,
            'fieldRegistration_dataLain' => $dataLain,
            'fieldRegistration_dataLainTahap2' => $dataLainTahap2,
            'winnerMember' => $winnerMember,
            'dataPanel' => $dataPanel
        ));
    }

    public function quizExecution() {
        return view('pages/quizExecution', array(
            'title' => 'Quiz'
        ));
    }

    public function panel() {
        $dataPanel = AdminPanel::all()->last();
        $dataAdmin = $this->dataAdmin;

        return view('pages/MemberPages/panelPage', array(
            'title' => 'Quiz Panel',
            'dataMember' => $this->dataMember->first(),
            'dataPanel' => $dataPanel,
            'dataAdmin' => $dataAdmin
        ));
    }

    public function postPanel(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        if (Choices::where('username', Auth::guard('member')->user()->username)->exists()) {
            $choices = Choices::where('username', Auth::guard('member')->user()->username)->first();
            if ($choices->statusTryOut == 1) {
                $request->session()->flash('status', 'kesempatan mengerjakan sudah habis :(');
                return redirect('/');
            }
        } else {
            $choices = new Choices();
        }

        if (($request->input('status') == 'goToTryout') || ($request->input('status') == 'goToQuiz1') || ($request->input('status') == 'goToQuiz2')) {

            if (($choices->ticket_tryout) == 1) {
                return redirect('/profile/' . Auth::guard('member')->user()->username . '/panel/quiz');
            }

            $choices->username = Auth::guard('member')->user()->username;
            $choices->ticket_tryout = '1';
            $choices->timeStartTryOut = time();
            //Set End time (2 jam)
            $choices->timeEndTryOut = time() + (120 * 60);
            $choices->save();
            return redirect('/profile/' . Auth::guard('member')->user()->username . '/panel/quiz');
        } else {

            return redirect('/profile/' . Auth::guard('member')->user()->username . '/panel/quiz');
        }
    }

    // POST and GET HTTP request use same function
    public function tryOut(Request $request) {

        // Base information needed
        $dataMember = $this->dataMember->first();
        $dataAdmin = $this->dataAdmin;
        date_default_timezone_set('Asia/Jakarta');
        $dataPanel = AdminPanel::all()->last();

        if (($dataPanel->quizGate1 == 'open') && ($dataPanel->quizGate2 == 'closed')) {
            if (($dataMember->regional == 5) || ($dataMember->regional == 6) || ($dataMember->regional == 7) || ($dataMember->regional == 8)) {
                $request->session()->flash('status', 'Maaf tapi hari ini bukan regional tim kamu');
                return redirect('/');
            }
        } else if (($dataPanel->quizGate2 == 'open') && ($dataPanel->quizGate1 == 'closed')) {
            if (($dataMember->regional == 1) || ($dataMember->regional == 2) || ($dataMember->regional == 3) || ($dataMember->regional == 4)) {
                $request->session()->flash('status', 'Maaf tapi hari ini bukan regional tim kamu');
                return redirect('/');
            }
        }



        // The first filter to check  does the  status is done or already out of time
        if (Choices::where('username', Auth::guard('member')->user()->username)->exists()) {
            $choices = Choices::where('username', Auth::guard('member')->user()->username)->first();
            if ($choices->statusTryOut == 1 || (($choices->timeEndTryOut) <= ($choices->currentTimeTryOut))) {
                $choices->statusTryOut = '1';
                $choices->save();
                $request->session()->flash('status', 'anda sudah mengerjakan soal tryout :)');
                return redirect('/');
            }
        }

        // Databaseneeds
        if (empty($request->input('saveAndGo'))) {
            $saveAndGo = 1;
        } else {
            $saveAndGo = $request->input('saveAndGo');
        }
        //Check pagination
        $skip = ((1 * $saveAndGo) * 10) - 10;
        $take = (1 * $saveAndGo) * 10;
        //Check user and initiate the user if the user is not exist
        if (Choices::where('username', Auth::guard('member')->user()->username)->exists()) {
            $choices = Choices::where('username', Auth::guard('member')->user()->username)->first();
        } else {
            $choices = new Choices();
        }
        //Check if the user is use the gate before entering the quiz
        if ($choices->ticket_tryout != 1) {
            $request->session()->flash('status', 'Ooops jangan mencoba curang yaaa :)');
            return redirect('/');
        }
        //Check pagination
        $theLastNumberPageNow = $request->input('theLastNumberInPageNow');
        $theFirstNumberPageNow = $request->input('theFirstNumberInPageNow');
        //Get columns by column_name
        $columns = Schema::getColumnListing('choices_table');
        $choices->username = Auth::guard('member')->user()->username;

        //Check when user do the test does the ticket is already closed?
        if (($dataPanel->quizGate1 == 'closed') && (($dataMember->regional == 1) || ($dataMember->regional == 2) || ($dataMember->regional == 3) || ($dataMember->regional == 4))) {
            $choices->statusTryOut = '1';
            $choices->save();
            $request->session()->flash('status', 'Maaf waktu anda sudah habis');
            return redirect('/');
        } else if (($dataPanel->quizGate2 == 'closed') && (($dataMember->regional == 5) || ($dataMember->regional == 6) || ($dataMember->regional == 7) || ($dataMember->regional == 8))) {
            $choices->statusTryOut = '1';
            $choices->save();
            $request->session()->flash('status', 'Maaf waktu anda sudah habis');
            return redirect('/');
        }
        //Save the answer
        for ($i = $theLastNumberPageNow; $i > $theFirstNumberPageNow; $i--) {
            $choices->$columns[$i + 1] = $request->input('jawaban' . $i);
        }
        $numbering = $skip + 1;
        if ($request->input('saveAndSubmit') != null || (($choices->timeEndTryOut) < ($choices->currentTimeTryOut))) {
            //Save the answer
            for ($i = $theLastNumberPageNow; $i > $theFirstNumberPageNow; $i--) {
                $choices->$columns[$i + 1] = $request->input('jawaban' . $i);
            }
            $choices->statusTryOut = '1';
            $choices->save();
            //redirect to panel because out of chance
            $request->session()->flash('status', 'Terima kasih sudah mengerjakan soal :)');
            return redirect('/');
        }
        $choices->save();


        //////////////////////////////////////////////////// FUNCTION TO CALCULATE DIFFERENT TIME BETWEEN CURRENT TIME AND END TIME //////////////////////////////////////
        //Initiate currenttime and endtime

        $targetDate = $choices->timeEndTryOut;

        //set the time right now
        $actualDate = time();
        $choices->currentTimeTryOut = time();
        $choices->save();
        //set the timezone
        //set date format
        $dateFormat = "d F Y -- g:i a";
        // Import from LCTIP2015
        $secondsDiff = $targetDate - $actualDate;
        $remainingDay = floor($secondsDiff / 60 / 60 / 24);
        $remainingHour = floor(($secondsDiff - ($remainingDay * 60 * 60 * 24)) / 60 / 60);
        $remainingMinutes = floor(($secondsDiff - ($remainingDay * 60 * 60 * 24) - ($remainingHour * 60 * 60)) / 60);
        $remainingSeconds = floor(($secondsDiff - ($remainingDay * 60 * 60 * 24) - ($remainingHour * 60 * 60)) - ($remainingMinutes * 60));
        $actualDateDisplay = date($dateFormat, $actualDate);
        $targetDateDisplay = date($dateFormat, $targetDate);
        //Check today is tryOut or Not
        if ($dataPanel->tryOutGate == 'open') {
            $quiz = DB::table('quiz_trial')->skip($skip)->take(10)->get();
        }
        //Today is online test
        else {
            $quiz = DB::table('quiz')->skip($skip)->take(10)->get();
        }
        $pagination = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $randomChoices = array('choices1', 'choices2', 'choices3', 'choices4', 'choices5');
        return view('/pages/MemberPages/tryOut', array(
            'title' => 'Online Test',
            'quiz' => $quiz,
            'randomChoices' => $randomChoices,
            'pagination' => $pagination,
            'user' => $choices,
            'columns' => $columns,
            'numbering' => $numbering,
            'saveAndGo' => $saveAndGo,
            'take' => $take,
            'skip' => $skip,
            // Deliver parameter  now
            'remainingDay' => $remainingDay,
            'remainingHour' => $remainingHour,
            'remainingMinutes' => $remainingMinutes,
            'remainingSeconds' => $remainingSeconds,
            'dataPanel' => $dataPanel,
            'dataAdmin' => $dataAdmin
        ));
    }

    public function suggestion(Request $request) {

        $member = new MemberSuggestion();
        $member->username = Auth::guard('member')->user()->username;
        $member->suggestion = $request->input('suggestion');
        $member->save();

        $request->session()->flash('status', 'Terima kasih sudah memberikan saran kamu :)');
        return redirect('/profile/' . Auth::guard('member')->user()->username);
    }

    public function newProduct(Request $request) {
        
    }

    public function dropzone() {
        return view('dropzone');
    }

}
