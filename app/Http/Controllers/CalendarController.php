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
                        'color' => 'red',   
                ];
            }
        }    
        return $events;
    }
    
}