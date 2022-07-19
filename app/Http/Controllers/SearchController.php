<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchController extends Controller
{
    public function index(Request $request) {
        $searchSite = $request->input('search_site');
        if($searchSite){
            try {
                $result = $this->make_request($searchSite);
                $tags = $this->count_tags($result);
                return view('search', [
                    'tags' => $tags,
                    'search_site' => $searchSite
                ]);
            } catch (Exception $e) {
                return view('search', [
                    'search_site' => $searchSite,
                    'error_message' => $e->getMessage()
                ]);
            }
        }
        return view('search');
    }

    public function make_request($searchSite) {
        $request = Http::get($searchSite);
        if ($request->status() != 200) {
            throw new Exception("status code different then 200, check website please");
        }
        return $request->body();
    }

    public function count_tags($html) {
        preg_match_all('/<[a-z]*\s.*>/iU', $html, $matches);
        $tags = [];
        $index = 1;
        foreach ($matches[0] as $tag) {
            preg_match('/<(.*)\s/iU', $tag, $match);
            $tagName = $match[1];
            if (isset($tags[$tagName])) {
                $tags[$tagName]->how_much++;
            } else {
                $tags[$tagName] = (object)[
                    'index' => $index++,
                    'name' => $tagName,
                    'how_much' => 1
                ];
            }
        }
        return $tags;
    }
}
