<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\AdminPanel;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client;

class FrontController extends Controller {

    public function __construct() {
        $this->grant_type = 'authorization_code';
        $this->direct_uri = "https://www.mataharimall.com/";
        $this->client_id = '1480990443';
        $this->post_accesstoken_url = 'https://api.line.me/v1/oauth/accessToken';
        $this->get_profile_url = 'https://api.line.me/v1/profile';
        $this->client_secret = '878cbb2afc4de666337cf51fbca4ab6a';
    }

    public function index() {
        //Date Online Test
//        $dt = Carbon::now()->addHours(7);
//        $dt->year = 2016;
//        $dt->month = 9;             // would force year++ and month = 1
//        $dt->day = 10;
//        $dt->hour = 12;
//        $dt->minute = 30;

        $dt = (new Carbon('first day of September 2016'))->addDay(9)->addSecond(30);
        $timeNow = Carbon::now()->addHours(7);
        $progress = (((46) - ($dt->diffInDays($timeNow))) / 46) * 100;
        $day = ($dt->diffInDays($timeNow));
        $hour = floor(($dt->diffInHours($timeNow)) / 24);
        $minute = floor(($dt->diffInMinutes($timeNow)) / 1440);
        $second = floor(($dt->diffInSeconds($timeNow)) / 86400);
        $dataPanel = AdminPanel::all()->last();

        return view('pages/MemberPages/homePage', array(
            'title' => 'Home',
            'progress' => $progress,
            'day' => $day,
            'hour' => $hour,
            'minute' => $minute,
            'second' => $second,
            'dataPanel' => $dataPanel
        ));
    }

    // Line needs
    public function lineLogin() {
        return view('lineLogin', array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'direct_uri' => $this->direct_uri,
        ));
    }

    public function lineLoginGet() {
        $code = Input::get('code');
        //Send the data to API
        if (!empty($code)) {
            $client = new Client();
            $request = $client->request('POST', $this->post_accesstoken_url, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type' => $this->grant_type,
                    'code' => $code,
                    'client_id' => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'direct_uri' => $this->direct_uri,
                ]
            ]);
//            echo $res->getStatusCode();
//           "200"
//            echo $res->getHeader('content-type');
//             'application/json; charset=utf8'
//            echo $res->getBody();
//             {"type":"User"...'
//             
            //Get Access Token from JSON
            $obj = json_decode($request->getBody());
            $access_token = $obj->{'access_token'};

            //Send the access token to API
            $client_send_accessToken = new Client();
            // GET to get user's profile
            $request_1 = $client_send_accessToken->request('GET', $this->get_profile_url, [
                'headers' => [
                    'Authorization' => 'bearer ' . $access_token
                ]
            ]);

            //Get display name
            $obj_1 = json_decode($request_1->getBody());
            $display_name = $obj_1->{'displayName'};
            $mid = $obj_1->{'mid'};
            $pictureUrl = $obj_1->{'pictureUrl'};
            $statusMessage = $obj_1->{'statusMessage'};

            echo 'Your name ' . $display_name . '<br>';
            echo 'Your MID ' . $mid . '<br>';
            echo 'Your PP : <img alt="@mtdowling" class="timeline-comment-avatar" height="100" src="' . $pictureUrl . '" width="100"><br>';
            echo 'Your status ' . $statusMessage . '<br>';
        } else {
            echo 'Error granted';
        }
    }

}
