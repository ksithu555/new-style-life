<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\User;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AuthLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $today = Carbon::today();
        $notifications = Notification::where('seen', 0)->whereDate('created_at', $today)->get();
        $notiCount=0;
        foreach($notifications as $notify)
        {
            if(!empty($notify->time))
            {
            $notiCount++;
            }
        }
        return view('layouts.auth',compact('notiCount','notifications'));
    }
}