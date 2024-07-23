<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Module;

class NotificationController extends Controller
{
    public function showNotifications() {
        $details = Detail::with('module')->get();
        return view('ui-notification', compact('details'));
    }
}
