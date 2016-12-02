<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Member;
use App\Admin;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Quiz;
use App\AdminPanel;
use App\Choices;
use App\QuizTrial;
use App\MemberSuggestion;
use Illuminate\Support\Facades\Schema;

class AdminController extends Controller {

    var $dataMember;
    var $dataAdmin;
    var $quiz;
    protected $question;

    public function __construct() {
        $this->middleware('admin');
        $this->dataMember = \App\Member::all();
        $this->dataAdmin = \App\Admin::all()->first();
        $this->quiz = \App\Quiz::all();
        $this->question = array('question', 'choices1', 'choices2', 'choices3', 'choices4', 'choices5', 'answer');
    }

    public function index() {
        
    }

    public function showDetailMember($username) {
        $statusPendaftaran = $this->dataMember->first()->statusPendaftaran;
        $dataExistTim = DB::table('field_registration')->pluck('parameter_name');
        $dataTim = DB::table('field_registration')->take(7)->get();
        $dataAnggota1 = DB::table('field_registration')->skip(7)->take(6)->get();
        $dataAnggota2 = DB::table('field_registration')->skip(13)->take(6)->get();
        $dataAnggota3 = DB::table('field_registration')->skip(19)->take(6)->get();
        $dataPebimbing = DB::table('field_registration')->skip(25)->take(6)->get();
        $dataLain = DB::table('field_registration')->skip(31)->take(2)->get();
        $dataAnggotaArray = array($dataAnggota1, $dataAnggota2, $dataAnggota3);
        $number = array(7, 13, 19, 25);
        $arrayCaption = array('Ketua Tim', 'Anggota 1', 'Anggota 2');
        $dataLainTahap2 = DB::table('field_registration')->skip(33)->take(1)->get();

        return view('pages/AdminPages/memberDetailAdminPage', array(
            'dataExistTim' => $dataExistTim,
            'dataAnggotaArray' => array($dataAnggota1, $dataAnggota2, $dataAnggota3),
            'dataMember' => $this->dataMember->where('username', $username)->first(),
            'number' => $number,
            'arrayCaption' => $arrayCaption,
            'statusPendaftaran' => $statusPendaftaran,
            'fieldRegistration_dataTim' => $dataTim,
            'fieldRegistration_dataAnggota1' => $dataAnggota1,
            'fieldRegistration_dataAnggota2' => $dataAnggota2,
            'fieldRegistration_dataAnggota3' => $dataAnggota3,
            'fieldRegistration_dataPebimbing' => $dataPebimbing,
            'fieldRegistration_dataLain' => $dataLain,
            'fieldRegistration_dataLainTahap2' => $dataLainTahap2
        ));
    }

    public function showMember() {
        $winnerMember = DB::table('winner_table')->join('member', 'member.username', '=', 'winner_table.username')->get();
        date_default_timezone_set('Asia/Jakarta');

        return view('pages/AdminPages/memberAdminPage', array(
            'dataMember' => $this->dataMember,
            'dataMember_count' => $this->dataMember->count(),
            'winnerMember' => $winnerMember
        ));
    }

    public function getMessage() {
        return view('pages/AdminPages/messageAdminPage', array(
            'dataAdmin' => $this->dataAdmin,
        ));
    }

    public function postMessage(Request $request) {

        $admin = Admin::where('role', 'admin')->first();
        $admin->message = $request->input('message');
        $admin->save();
        $request->session()->flash('status', 'Pesan sudah diupdate');
        return redirect('/admin/message');
    }

    public function postRules(Request $request) {

        $admin = Admin::where('role', 'admin')->first();
        $admin->rules = $request->input('rules');
        $admin->save();
        $request->session()->flash('status', 'Pesan sudah diupdate');
        return redirect('/admin/message');
    }

    public function getDownload($username, $file) {
//PDF file is stored under project/public/download/info.pdf
        $filepath = base_path() . '/images/' . $file;

        $headers = array(
            'Content-Type: application/pdf/jpg/png',
        );
        return response()->download($filepath, $file, $headers);
    }

    public function deleteMember(Request $request) {
        $username = $request->input('username');
        $member = Member::where('username', $username)->first()->delete();
        $request->session()->flash('status', $username . ' telah dihapus');
        return redirect('admin/member');
    }

    public function loginAsMember(Request $request, $username) {

        $id = $this->dataMember->where('username', $username)->pluck('id')->first();

        if (auth('member')->loginUsingId($id)) {
            return redirect("profile/" . auth("member")->user()->username)->with('data', 'admin');
        } else {
            $request->session()->flash('status', 'username dan password tidak sesuai');
            return redirect('/');
        }
    }

    public function activateMember($username, $statusActivation, Request $request) {
        $member = new Member;
        $member = $this->dataMember->where('username', $username)->first();
        if ($statusActivation == 1) {
            $member->statusTim = '1';
            $member->save();
            $request->session()->flash('status', $username . ' telah terverifikasi');
        } else {
            $member->statusTim = '0';
            $member->save();
            $request->session()->flash('status', $username . ' tidak terverifikasi');
        }

        return redirect('/admin/member');
    }

    public function resetQuizChance(Request $request, $username) {
        if ($choices = Choices::where('username', $username)->exists()) {
            $choices = Choices::where('username', $username)->first()->delete();
            $request->session()->flash('status', $username . ' sudah direfresh');
        } else {
            $request->session()->flash('status', $username . ' belum  pernah mengerjakan online test');
        }


        return redirect('/admin/member');
    }

    public function resetPassword(Request $request) {

        $member = new Member;
        $username = $request->input('username');
        $password = bcrypt($request->input('password'));
        $member = $this->dataMember->where('username', $username)->first();
        $member->password = $password;
        $member->save();
        $request->session()->flash('status', 'password ' . $username . ' telah diupdate');
        return redirect('admin/member');
    }

    public function controlPanel() {
        $dataPanel = AdminPanel::all()->last();
        $option1 = array('open', 'closed');
        $option2 = array('open', 'closed');
        $option3 = array('open', 'closed');
        $option4 = array('open', 'closed');
        $option5 = array('show', 'hidden');
        $option6 = array('show', 'hidden');
        $option7 = array('show', 'hidden');
        return view('/pages/AdminPages/controlPanel', array(
            'dataPanel' => $dataPanel,
            'option1' => $option1,
            'option2' => $option2,
            'option3' => $option3,
            'option4' => $option4,
            'option5' => $option5,
            'option6' => $option6,
            'option7' => $option7
        ));
    }

    public function postControlPanel(Request $request) {
        //Registration
        $adminPanel = new AdminPanel();
        $adminPanel->registrationGate = $request->input('registrationGate');
        $adminPanel->tryOutGate = $request->input('tryOutGate');
        $adminPanel->quizGate1 = $request->input('quizGate1');
        $adminPanel->quizGate2 = $request->input('quizGate2');
        $adminPanel->alertQuiz1 = $request->input('alertQuiz1');
        $adminPanel->alertQuiz2 = $request->input('alertQuiz2');
        $adminPanel->announcementGate = $request->input('announcementGate');

        $adminPanel->save();
        $request->session()->flash('status', 'Panel sudah diupdate');
        return redirect('/admin/panel');
    }

    // POST and GET HTTP request use same function
    public function reviewQuiz(Request $request) {

        // Databaseneeds
        if (empty($request->input('saveAndGo'))) {
            $saveAndGo = 1;
        } else {
            $saveAndGo = $request->input('saveAndGo');
        }
        $skip = ((1 * $saveAndGo) * 10) - 10;
        $take = (1 * $saveAndGo) * 10;
        //Save input
        if (Choices::where('username', 'admin')->exists()) {
            $choices = Choices::where('username', 'admin')->first();
        } else {
            $choices = new Choices();
        }
        $theLastNumberPageNow = $request->input('theLastNumberInPageNow');
        $theFirstNumberPageNow = $request->input('theFirstNumberInPageNow');
        $columns = Schema::getColumnListing('choices_table');
        $choices->username = 'admin';
//        for ($i = $take; $i > $skip; $i--) {
////            $choices->jawaban . $i = $request->input('jawaban' . $i);
//            $choices->$columns[$i + 1] = $request->input('jawaban' . $i);
//        }
        for ($i = $theLastNumberPageNow; $i > $theFirstNumberPageNow; $i--) {
            $choices->$columns[$i + 1] = $request->input('jawaban' . $i);
        }
        $choices->save();
        $numbering = $skip + 1;

        //Check user answer
        if (Choices::where('username', 'admin')->exists()) {
            $user = Choices::where('username', 'admin')->first();
        } else {
            $user = new Choices();
        }


        $quiz = DB::table('quiz')->skip($skip)->take(10)->get();
        $pagination = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $randomChoices = array('choices1', 'choices2', 'choices3', 'choices4', 'choices5');
        return view('/pages/AdminPages/quizReview', array(
            'quiz' => $quiz,
            'randomChoices' => $randomChoices,
            'pagination' => $pagination,
            'user' => $user,
            'columns' => $columns,
            'numbering' => $numbering,
            'saveAndGo' => $saveAndGo,
            'take' => $take,
            'skip' => $skip
        ));
    }

    public function onlineTestResult() {

        $choices = DB::table('choices_table')->join('member', 'choices_table.username', '=', 'member.username')->orderBy('choices_table.timeStartTryOut', 'asc')->get();
        date_default_timezone_set('Asia/Jakarta');

        return view('pages/AdminPages/resultPage', array(
            'choices' => $choices
        ));
    }

    public function checkAnswer($username) {
        $answer = Quiz::all()->pluck('answer');
        $columns = Schema::getColumnListing('choices_table');
        $choices = Choices::where('username', $username)->first();
        $jumlahBenar = 0;
        $jumlahSalah = 0;
        $jumlahKosong = 0;
        $j = 2;
        for ($i = 0; $i <= 99; $i++) {
            if (($choices->$columns[$j] == 'NU') || (empty($choices->$columns[$j]))) {
                $jumlahKosong++;
            } else {
                if (($choices->$columns[$j]) == $answer[$i]) {
                    $jumlahBenar++;
                } else if (($choices->$columns[$j]) != $answer[$i]) {
                    $jumlahSalah++;
                }
            }
            $j++;
        }
        return view('pages/AdminPages/checkAnswerPage', array(
            'choices' => $choices,
            'columns' => $columns,
            'jumlahBenar' => $jumlahBenar,
            'jumlahSalah' => $jumlahSalah,
            'jumlahKosong' => $jumlahKosong,
            'answer' => $answer
        ));
    }

    ///////////////////////////////////////////////////////////////// QUIZ FUNCTION /////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////THE REAL QUIZ
    public function addquiz() {
        $question = $this->question;
        $choices = array('A', 'B', 'C', 'D', 'E');
        $choices_1 = array('Question', 'A', 'B', 'C', 'D', 'E');
        return view('pages/AdminPages/addQuiz', array(
            'question' => $question,
            'choices' => $choices,
            'choices_1' => $choices_1
        ));
    }

    public function quiz() {
// Retrieve all from database
        $question = $this->question;
        $quiz = Quiz::all();
        $jumlahSoal = DB::table('quiz')->count();
        return view('pages/AdminPages/quizPage', array(
            'quiz' => $quiz,
            'jumlahSoal' => $jumlahSoal,
            'question' => $question
        ));
    }

    public function postEditQuiz($id, Request $request) {
        $quiz = Quiz::where('id', $id)->first();
        $question = $this->question;
// Function to fetch the Input
        foreach ($question as $question) {
            $quiz->$question = Input::get('' . $question . '');
        }
        $quiz->save();
        $request->session()->flash('status', 'quiz berhasil diupdate');
        return redirect('/admin/quiz');
    }

    public function postaddquiz(Request $request) {
        $quiz = new Quiz;
        $question = $this->question;
// Function to fetch the Input
        foreach ($question as $question) {
            $quiz->$question = Input::get('' . $question . '');
        }
        $quiz->save();
        $request->session()->flash('status', 'quiz berhasil ditambahkan');
        return redirect('/admin/quiz');
    }

    public function editquiz($id) {
        $choices = array('A', 'B', 'C', 'D', 'E');
        $choices_1 = array('Question', 'A', 'B', 'C', 'D', 'E');
        $quiz = Quiz::where('id', $id)->first();
        $question = $this->question;
//Use same page (addPage.blade)
        return view('pages/AdminPages/addQuiz', array(
            'quiz' => $quiz,
            'question' => $question,
            'choices' => $choices,
            'choices_1' => $choices_1
        ));
    }

    public function deletequiz(Request $request) {
        $id = $request->input('id');
        $quiz = Quiz::where('id', $id)->first()->delete();
        $request->session()->flash('status', 'quiz telah dihapus');
        return redirect('admin/quiz');
    }

    ////////////////////////////////////////////////////////////////////////THE TRIAL QUIZ

    public function addquizTrial() {
        $question = $this->question;
        $choices = array('A', 'B', 'C', 'D', 'E');
        $choices_1 = array('Question', 'A', 'B', 'C', 'D', 'E');
        return view('pages/AdminPages/Trial/addQuiz', array(
            'question' => $question,
            'choices' => $choices,
            'choices_1' => $choices_1
        ));
    }

    public function quizTrial() {
// Retrieve all from database
        $question = $this->question;
        $quiz = QuizTrial::all();
        $jumlahSoal = DB::table('quiz')->count();
        return view('pages/AdminPages/Trial/quizPage', array(
            'quiz' => $quiz,
            'jumlahSoal' => $jumlahSoal,
            'question' => $question
        ));
    }

    public function postEditQuizTrial($id, Request $request) {
        $quiz = QuizTrial::where('id', $id)->first();
        $question = $this->question;
// Function to fetch the Input
        foreach ($question as $question) {
            $quiz->$question = Input::get('' . $question . '');
        }
        $quiz->save();
        $request->session()->flash('status', 'quiz berhasil diupdate');
        return redirect('/admin/Trial/quiz');
    }

    public function postaddquizTrial(Request $request) {
        $quiz = new QuizTrial;
        $question = $this->question;
// Function to fetch the Input
        foreach ($question as $question) {
            $quiz->$question = Input::get('' . $question . '');
        }
        $quiz->save();
        $request->session()->flash('status', 'quiz berhasil ditambahkan');
        return redirect('/admin/Trial/quiz');
    }

    public function editquizTrial($id) {
        $choices = array('A', 'B', 'C', 'D', 'E');
        $choices_1 = array('Question', 'A', 'B', 'C', 'D', 'E');
        $quiz = QuizTrial::where('id', $id)->first();
        $question = $this->question;
//Use same page (addPage.blade)
        return view('pages/AdminPages/Trial/addQuiz', array(
            'quiz' => $quiz,
            'question' => $question,
            'choices' => $choices,
            'choices_1' => $choices_1
        ));
    }

    public function reviewQuizTrial(Request $request) {

        if (empty($request->input('saveAndGo'))) {
            $saveAndGo = 1;
        } else {
            $saveAndGo = $request->input('saveAndGo');
        }
        $skip = ((1 * $saveAndGo) * 10) - 10;
        $take = (1 * $saveAndGo) * 10;
        $numbering = $skip + 1;
        $quiz = DB::table('quiz_trial')->skip($skip)->take($take)->get();
        $pagination = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
        $randomChoices = array('choices1', 'choices2', 'choices3', 'choices4', 'choices5');
        return view('/pages/AdminPages/quizReview', array(
            'quiz' => $quiz,
            'randomChoices' => $randomChoices,
            'pagination' => $pagination,
            'numbering' => $numbering
        ));
    }

    public function deletequizTrial(Request $request) {
        $id = $request->input('id');
        $quiz = QuizTrial::where('id', $id)->first()->delete();
        $request->session()->flash('status', 'quiz telah dihapus');
        return redirect('admin/Trial/quiz');
    }

    public function score($username, Request $request) {

        $answer = Quiz::all()->pluck('answer');
        $columns = Schema::getColumnListing('choices_table');
        $choices = Choices::where('username', $username)->first();
        $score = 0;
        $j = 2;
        for ($i = 0; $i <= 99; $i++) {
            if (($choices->$columns[$j] == 'NU') || (empty($choices->$columns[$j]))) {
                
            } else {
                if (($choices->$columns[$j]) == $answer[$i]) {
                    $score += 4;
                } else if (($choices->$columns[$j]) != $answer[$i]) {
                    $score -=1;
                }
            }
            $j++;
        }
        $choices->score = $score;
        $choices->save();
        $request->session()->flash('status', $username . ' sudah diperiksa');
        return redirect('admin/result');
    }

    public function ranking() {
        $dataPeserta = DB::table('choices_table')
                ->join('member', 'choices_table.username', '=', 'member.username')
                ->where('choices_table.statusTryOut', 1)
                ->whereNotNull('choices_table.score')
                ->orderBy('choices_table.score', 'desc')
                ->get();


        return view('pages/AdminPages/rankingPage', array(
            'dataPeserta' => $dataPeserta,
        ));
    }

    public function memberSuggestion() {
        $memberSuggestion = MemberSuggestion::where('suggestion', '!=', 'Silahkan diisi jika kamu punya saran untuk LCTIP yang lebih baik :)')->get();
        return view('pages/AdminPages/suggestionPage', array(
            'memberSuggestion' => $memberSuggestion
        ));
    }

}
