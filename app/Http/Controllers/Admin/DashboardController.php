<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Service;
use App\Models\RoomType;
use App\Models\Order;
use App\Models\OrderRoom;
use App\Models\OrderServices;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{
       // show dashboard
       public function getdashboard()
       {
          
           $orders = Order::all();
           $totalRooms = Room::count();
           $totalOrders = Order::count();
           $users = User::all();
   
           return view('backend.dashboard', compact('users', 'orders','totalOrders','totalRooms'));
       }    
   
       // show notification
       public function notification()
       {
           $orders = Order::all();
           $users = User::all();
   
           return view('backend.notification', compact('users', 'orders'));
       }
   
}
