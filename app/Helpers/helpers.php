<?php
use App\Tag;

if (!function_exists('parentsTag')) {
    function parentsTag($id){
        $tag = Tag::whereId($id)->first();
        $name_tag = null;
        if($tag){
        $name_tag = $tag->name;
          while(!is_null($tag->tag)){
            $name_tag = $tag->tag->name.'.'.$name_tag;
            $tag = $tag->tag;
          }
        }
        return $name_tag;
    }
}

if (!function_exists('dateIndoFormat')) {
    function dateIndoFormat($data){
        if(!is_null($data)){
            $time = date_create($data);
            $time = date_format($time,'d/m/Y H:i');
            return $time;
        }else{
            return '-';
        }
    }
}

if (!function_exists('dateIndoFormat2')) {
    function dateIndoFormat2($data){
        if(!is_null($data)){
            $time = date_create($data);
            $time = date_format($time,'d M Y - H:i');
            return $time;
        }else{
            return '-';
        }
    }
}
