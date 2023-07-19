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

class RoomTypeController extends Controller
{
       // show room types
   public function getroomtypes()
   {
       $orders = Order::all();
       $users = User::all();
       $roomTypes = RoomType::all();
       return view('backend.roomtypes', compact('roomTypes','users', 'orders'));
   }
   
    // add room type
    public function postroomtypeadd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            
        ]);

        $roomType = new RoomType();
        $roomType->name = $request->name;
       
        $roomType->save();

        return redirect()->back()->with('success', 'Room Type added successfully.');
          
    }

    //
    public function getroomtypeadd()
    {
        $orders = Order::all();
        $users = User::all();
        return view('backend.roomtypeadd', compact('users', 'orders'));
    }

   // delete roomtype
   public function deleteroomtype($id)
   {
       $roomtype = RoomType::findOrFail($id);
          $roomCount = Room::where('type_id', $roomtype->id)->count();
       if ($roomCount > 0) {
           return back()->with('error', 'Cannot delete room type. It has associated rooms.');
       }
          $roomtype->delete();
   
       return back()->with('success', 'Room Type deleted successfully');
   }
   
    // edit roomtype
    public function getroomtypeedit($id)
    {
        $orders = Order::all();
        $users = User::all();
        $roomType = RoomType::find($id);
        if (!$roomType) {
            return redirect()->back()->with('error', 'Room Type not found.');
        }

        return view('backend.roomtypeedit', compact('roomType','users', 'orders'));
    }

    //
    public function postroomtypeedit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        
        ]);
        $roomType = RoomType::find($id);
        if (!$roomType) {

        return redirect()->back()->with('error', 'Room Type not found.');
        }

     $roomType->name = $request->name;
     $roomType->save();

        return redirect()->back()->with('success', 'Room Type updated successfully.');
    } 

    
}
