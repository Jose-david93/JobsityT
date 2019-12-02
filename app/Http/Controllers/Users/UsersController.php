<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\User;
use App\Entries;
use App\HideTweets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Abraham\TwitterOAuth\TwitterOAuth;

class UsersController extends Controller
{
    public function show($id,$name_tweet)
    {
        //EntryArray
        $entries = Entries::join('users','entries.idUser','users.id')
        ->where('idUser',$id)
        ->paginate(2);

        //TweetsArray
        $connection = new TwitterOAuth('EG8P1kAONmUYfhiAXzG7fzgSI', 'cc4MzfbVsHh211uWYZ36HmyADoWEcjX8Sw6bnrRFO6GJ3lycbL', '1112861556-IDJI4VuBCkwJuZVHDeblmJzDm17RDh5B2x0fPiL', 'QjD2mRyfYA7dUIjgmriT750GsMugJezOWMRSBoST3nHKu');
        $content = $connection->get("account/verify_credentials");
        $tweets = $connection->get("search/tweets", ["q" => $name_tweet,"count" => "10"]);
        
        $hideTweets = HideTweets::where("idUser",$id)->get();
        for ($i=0; $i <count($hideTweets) ; $i++) { 
            for ($j=0; $j < count($tweets->statuses); $j++) 
            { 
                //hideTweets offline or not owner
                if($hideTweets[$i]->tweet == $tweets->statuses[$j]->id && (!(isset(Auth::user()->id)) || Auth::user()->id != $id))
                {
                    $tweets->statuses[$j]->hide = true;
                    break;
                }
                else if($hideTweets[$i]->tweet == $tweets->statuses[$j]->id && isset(Auth::user()->id) && Auth::user()->id == $id)
                {
                    $tweets->statuses[$j]->adminHide = true;
                    break;
                }
            }
        }

        return view("users.show", ['entries' => $entries,'tweets' => $tweets->statuses]);
    }

    public function hideTweets(Request $request){
        $tweet = HideTweets::firstOrCreate([
            "tweet"=>$request->tweet,
            "idUser"=>$request->idUser
        ]);
        return response()->json($tweet->id);
    }

    public function showTweets(Request $request){
        $tweetRows = HideTweets::where("tweet",$request->tweet)->delete();
        return response()->json($tweetRows);
    }
}
