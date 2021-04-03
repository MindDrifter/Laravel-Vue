<?php

namespace App\Http\Controllers;
use App\Models\UserCards;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\CreateCardRequest;
use Illuminate\Support\Facades\DB;

class UserCardsController extends Controller{

    public function loadUserCards(Request $request){
       
            $cards = DB::table('auths')
            ->rightJoin('user_cards', 'auths.id', '=', 'user_cards.card_id')
            ->where('email', $request->email)
            ->get();
            return $cards;
            // $myTheme = $cards ->where('userId', $id) ->pluck('theme');
            // $myTitle = $cards ->where('userId', $id) ->pluck('title');
            // $myBody = $cards ->where('userId',$id) ->pluck('body');
            // $myCardId = $cards ->where('userId', $id) ->pluck ('id');


            // $myCards = array();
            // for ($i = 0; $i < count($myTheme); $i++){
            //     array_push($myCards, array($myTitle[$i],$myBody[$i], $myTheme[$i]));
            // }
            // return  ['myCards' => $myCards,'myCardId' => $myCardId, 'test' => 'd'];

    }

    public function deleteCard(Request $request){
        $id = $request->id;
        $card = DB::table('user_cards');
        $card->find($id);
        $card->delete();
        return ['id'=> $id];
    }

    public function createCard(Request $createCardRequest){
        $card = new UserCards();
        $card->theme = $createCardRequest->theme;
        $card->title = $createCardRequest->title;
        $card->body = $createCardRequest->body;
        $card ->card_id = $createCardRequest->id;
        $card->save();

    }

}
