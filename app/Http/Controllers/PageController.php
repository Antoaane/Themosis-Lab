<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public array $pageContent;
    private string $imgSize;

    public function __construct(string $imgSize = 'full')
    {
        $this->imgSize = $imgSize;

    }

    public function render(string $template, array $data = [], $imgSize = 'full') : View
    {
        $this->imgSize = $imgSize;
        $this->pageContent = $this->getCustom();
        $pageContent = $this->pageContent;
        if(sizeof($data)>0){
            $pageContent['external_data'] = $data;
        }

        return view('pages.'.$template, $pageContent);
    }

    public function error() : View
    {
        return view('pages.error');
    }

    private function getCustom() : array
    {
        $data = get_post_custom(get_the_ID());
        $dataKeys = array_keys($data);

        $array = array_map(function($key,$item){
            if(strpos($key, 'img')){
                return wp_get_attachment_image_src($item[0],$this->imgSize);
            }
            return $item[0];
        }, $dataKeys, $data);

        return array_combine($dataKeys, $array);
    }
}
