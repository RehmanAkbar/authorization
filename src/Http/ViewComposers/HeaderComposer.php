<?php
/**
 * Created by PhpStorm.
 * User: FAKHAR
 * Date: 1/11/2018
 * Time: 3:44 PM
 */

namespace App\Http\ViewComposers;



use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

class HeaderComposer
{


    public function compose(View $view)
    {
        $latestActivities = Activity::with('user')->latest()->limit(5)->get();

        $view->with('latestActivities', $latestActivities);
    }
}