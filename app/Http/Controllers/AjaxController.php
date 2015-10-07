<?php

namespace App\Http\Controllers;

use App\ETXTag;
use App\ETXCategory;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class AjaxController extends Controller
{
    public function postEventCategoryTags(Request $request)
    {
        $catID = $request->catID;

        $cat = ETXCategory::find($catID);

        $tags = $cat->tags;


        if ($tags->count() > 0) {
            $ary_tags = [];

            foreach ($tags as $t) {
                array_push($ary_tags, $t);
            }

            $resp = [
                'error' => false,
                'html' => '',
                'cbdata' => $ary_tags
            ];
        }  else  {
            $resp = [
                'error' => true,
                'html' => '',
                'cbdata' => []
            ];
        }

        return json_encode($resp);
    }
}
