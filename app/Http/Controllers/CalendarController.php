<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        
        return view('calendar/calendar',compact('user'));
    }

    public function getEvents()
    {
        $user = Auth::user();
        $calendars = $user->load('folders.tasks');

         $events = []; 
        foreach($calendars->folders as $folder){
            foreach($folder->tasks as $task_calendar){
                // Fullcalendarの仕様上、バー表記の時前日までの表示となる為改善する。
                $events[]= [ 
                        'title' => $task_calendar->title,
                        'description' => $task_calendar->textarea,
                        'start' => $task_calendar->due_date,
                        'end'   => $task_calendar->due_date,
                        'color' => $this->getEventColor($task_calendar->priority),   
                ];
            }
        }    
        return $events;
    }
    
    private function getEventColor($colorCode)
    {
        switch ($colorCode) {
            case "重要":
                return '#f87171';
            case "普通":
                return '#60a5fa';
            case "後回し":
                return '#4ade80';
            // 他の値に対する処理があればここに追加
            default:
                return 'red'; // デフォルトの色
        }
    }
}