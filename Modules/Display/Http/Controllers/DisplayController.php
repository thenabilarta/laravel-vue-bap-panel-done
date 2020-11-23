<?php

namespace Modules\Display\Http\Controllers;

use Modules\Display\Entities\Display;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Platform\Core\Http\Controllers\AppBaseController;
use GuzzleHttp\Client;

class DisplayController extends AppBaseController
{
    public $access_token = "L0L0X5Ci87jYrFSwDiGJMMuQJNutMnzfv8ai6rp5";

    public function index()
    {
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
