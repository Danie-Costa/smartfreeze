<?php

use Illuminate\Foundation\Mix;
use \Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
if (!function_exists('uploadImage')) {
    function uploadImage($file, $name, $paht)
    {
        $extension = $file->extension();
        $nameFile = "{$name}.{$extension}";
        $upload = $file->storeAs($paht, $nameFile, 'public');
        return $upload;
    }
}
if (!function_exists('toUrl')) {
    function toUrl($str)
    {
        $url = mb_strtolower($str);
        $prepos = array('â', 'ê', 'î', 'ô', 'û', 'á', 'é', 'í', 'ó', 'ú', 'ã', 'õ', 'ẽ', 'ç', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '[', ']', '{', '}', ';', ':', ',', '.', '/', '<', '>', '?', '\\', '|', '`', '~', '-', '=', '_', '+', '"', ' a ', ' á ', ' à ', ' ante ', ' até ', ' após ', ' de ', ' desde ', ' em ', ' entre ', ' com ', ' para ', ' por ', ' perante ', ' sem ', ' sob ', ' sobre ', ' na ', ' no ', ' e ', ' do ', ' da ', ' ', '   ', '\'', '----', '---', '--');
        $ch = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'a', 'o', 'e', 'c', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-');
        $url = str_replace($prepos, $ch, $url);
        $url = str_replace(['--','----','---'], ['-','-','-'], $url);
        return urlencode($url);
    }
}

if (!function_exists('renderBladeString')) {
    function renderBladeString($string, $data = [])
    {
        $php = Blade::compileString($string);

        $obLevel = ob_get_level();
        ob_start();
        extract($data, EXTR_SKIP);

        try {
            eval('?'.'>'.$php);
        } catch (\Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        }

        return ob_get_clean();
    }
}

if (!function_exists('isLight')) {
    function isLight($hexColor) {
        $hexColor = ltrim($hexColor, '#');

        $r = hexdec(substr($hexColor, 0, 2));
        $g = hexdec(substr($hexColor, 2, 2));
        $b = hexdec(substr($hexColor, 4, 2));
        $luminance = 0.299 * $r + 0.587 * $g + 0.114 * $b;
        return ($luminance > 128) ? true : false;
    }
}
if (!function_exists('GetMonthName ')) {
    function GetMonthName($month,$type = false)
    {
        $mName = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
        $monthName = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];

        if($type){
            return $monthName[intval($month)];
        }
        return $mName[intval($month)];
    }
}

if (!function_exists('GetDayWeekName ')) {
    function GetDayWeekName($date,$type = false)
    {
        $dName = ['0'=>'D','1'=>'S','2'=>'T','3'=>'Q','4'=>'Q','5'=>'S','6'=>'S',];
        $dSName = ['0'=>'Domingo','1'=>'Segunda-feira','2'=>'Terça-feira','3'=>'Quarta-feira','4'=>'Qinta-feira','5'=>'Sexta-feira','6'=>'Sábado',];
        if($type){
            return $dSName[$date];
        }
        return $dName[$date];
    }
}

if (!function_exists('GetMayCompany')) {
    function GetMayCompany()
    {
        return auth()->user()->company()->first() ?? null;
    }
}


if (!function_exists('GetMayCompanyId')) {
    function GetMayCompanyId()
    {
        return auth()->user()->company()->first()->id ?? null;
    }
}

if (!function_exists('GetMyRule')) {
    function GetMyRule()
    {
        return auth()->user()->rule ?? null;
    }
}

if (!function_exists('GetMyUserId')) {
    function GetMyUserId()
    {
        return auth()->user()->id ?? null;
    }
}

if (!function_exists('GetMyCustomerId')) {
    function GetMyCustomerId()
    {
        return auth()->user()->customer()->first()->id ?? null;
    }
}







?>
