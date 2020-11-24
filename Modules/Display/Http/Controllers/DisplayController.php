<?php

namespace Modules\Display\Http\Controllers;

use Modules\Display\Entities\Display;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;
use GuzzleHttp\Client;

session_start();

class DisplayController extends AppBaseController
{
    public function index()
    {
        // $client = new Client(['base_uri' => 'http://192.168.44.127']);

        // $multipart = [
        //     [
        //         'name' => 'client_id',
        //         'contents' => 'ZLR24lN2Ztf1HfaPQwKmNy4zVMw8J1F7oc8xRyz6'
        //     ],
        //     [
        //         'name' => 'client_secret',
        //         'contents' => '3opgkjtvFQKaXmDfGbWKC7WWV0778SFgdGf82n6gUbJEdfSbRgyknwF35iDIWDkOgmKNr9y7KrP6UOkoMMGB24zU9MfTTji8ka3dDAorfHYAHfg7eb0mBrbtopcmeK5oRJNjYGKJHbFPw5diPiru8gOFUdkhMjFMbCB6rYBWPIOO41rkvR29uM31i8782O3eVKjQXPfiVA67zEhW7noAvE0KQO3Qr0wwpSg34IHBtlM9FpTZF1C9NQ3phwCz7f'
        //     ],
        //     [
        //         'name' => 'grant_type',
        //         'contents' => 'client_credentials'
        //     ],
        // ];

        // $response = $client->request('POST', '/xibo-cms/web/api/authorize/access_token', [
        //     'multipart' => $multipart
        // ]);

        // $contents = $response->getBody();
        // $content = json_decode($contents, true);

        // $token = $content["access_token"];

        // $_SESSION["token"] = $token;

        return view('display::index');
    }

    public function data()
    {
        // $client = new Client(['base_uri' => 'http://192.168.44.127']);

        // $headers = [
        //     'Authorization' => 'Bearer ' . $this->access_token,
        //     'Accept' => 'application/json'
        // ];

        // $response = $client->request('GET', '/xibo-cms/web/api/display', [
        //     'headers' => $headers
        // ]);

        // $contents = $response->getBody();
        // $content = json_decode($contents, true);

        // $numberOfArray = count($content);
        
        // if ( $numberOfArray > 0 ) {
        //     for ($i = 0; $i < $numberOfArray; $i++) {
        //         $displayExists = Display::where('display_id', '=', $content[$i]["displayId"])->first();
        //         if ($displayExists === null) {
        //             $data = array(
        //                 'display_id' => $content[$i]["displayId"],
        //                 'display_name' => $content[$i]["deviceName"],
        //                 'authorized' => $content[$i]["licensed"],
        //                 'logged_in' => $content[$i]["loggedIn"],
        //                 'default_layout' => $content[$i]["defaultLayout"],
        //                 'last_accessed' => $content[$i]["lastAccessed"],
        //                 'ip_address' => $content[$i]["clientAddress"],
        //             );
        
        //             $display = Display::create($data);
        //         }
        //     }
        // }

        $display = Display::all();

        return $display;
    }
}
