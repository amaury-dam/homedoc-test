<?php
/**
 * Created by PhpStorm.
 * User: pierr
 * Date: 15/01/2019
 * Time: 08:46
 */

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use App\Common\curlRequest;
use App\Common\feedsRSS;
use Illuminate\Http\Request;


class feedsController extends Controller
{
    private  $curlRequest;
    private  $feeds;

    function __construct()
    {
        $this->curlRequest = new curlRequest();
        $this->feeds = new feedsRSS();
    }

    function getFeeds($page)
    {

        $start = 5 * ($page - 1);
        $ggNewsFeed = $this->feeds->make('https://news.google.com/rss/search?q=sante&hl=fr&gl=FR&ceid=FR%3Afr', true);
        $mediumFeed = $this->feeds->make('https://medium.com/feed/homedoc', true);;
        $data = array(
            'items' => $ggNewsFeed->get_items($start, 5),
            'mediumItems' => $mediumFeed->get_items(),
            'page' => $page
        );
        return view('patient/feeds')->with($data);
    }
}
