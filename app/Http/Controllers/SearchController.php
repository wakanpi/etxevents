<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ETXEvent;
use App\ETXLocation;

class SearchController extends Controller
{

    protected function search(Request $request)
    {
        $search_phrase = $request->keywords;
//        $ary_keywords = explode(' ', $request->keywords);
//        $ary_where = [];
//
//        foreach ($ary_keywords as $kw) {
//            if (!$this->isCommon($kw)) {
//
//            }
//        }

        $results = ETXEvent::search($search_phrase)->get();

        return view('static.search', compact('search_phrase', 'results'));

    }


    /**
     * @param $str
     *
     * @return bool
     */
    private function isCommon($str)
    {
        /**
         * TODO   Add more phrases to this array to improve the search results maybe switch to elasticSearch in a future version.
         *
         **/
        $common_search = [
            'and', 'or', '&', 'the'
        ];

        if (in_array($str, $common_search)) {
            return true;
        }
    return false;
    }
}
