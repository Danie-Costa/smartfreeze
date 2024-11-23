<?php

namespace App\Services;

/**
 * Class GoogleCalendar
 * @package App\Services
 */
class GoogleCalendar
{
    /**
     * GoogleCalendar constructor.
     */

     private $url = 'https://calendar.google.com/calendar/u/0/r/eventedit?';
     private $title = '';
     private $startDate = '';
     private $endDate = '';
     private $startTime = '';
     private $endTime = '';
     private $message = '';


    public function __construct()
    {

    }
    private function trateDate($date){
        return str_replace(['/',' '],'', date('Y/m/d', strtotime($date))).'T';
    }
    private function trateTime($time){
        return str_replace([':',' '],'',date('H:i:s', strtotime($time))).'Z';
    }
    private function trateMessage($message){
        $substituicoes = [
            " "=>"%20",
            "\n"=>"%0A",
        ];
        foreach ($substituicoes as $palavra => $valor) {
            $message = str_replace($palavra, $valor, $message);
        }
        return $message;
    }

    public function getLink($title,$startDate, $endDate,$message){
        $this->startDate = $this->trateDate($startDate);
        $this->endDate = $this->trateDate($endDate);
        $this->startTime = $this->trateTime($startDate);
        $this->endTime = $this->trateTime($endDate);
        $this->message = $this->trateMessage($message);
        $this->title = $this->trateMessage($title);
        return $this->url.'text='.$this->title.
            '&dates='.$this->startDate. $this->startTime .
            '/'.$this->endDate.$this->endTime.'&details='.$this->message.' &location=Brasil &pli=1';
    }

}
