<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //
    public function getEvents()
    {
        $user = Auth::user();
        $calendars = $user->load('folders.tasks');

         $events = []; 
        foreach($calendars->folders as $folder){
            foreach($folder->tasks as $task_calendar){
                $events[]= [ 
                        'title' => $task_calendar->title,
                        'description' => '',
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
            case 1:
                return 'red';
            case 2:
                return 'blue';
            case 3:
                return 'green';
            // 他の値に対する処理があればここに追加
            default:
                return 'red'; // デフォルトの色
        }
    }
}