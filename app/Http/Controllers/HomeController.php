<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Picture;
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
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function getrooms()
    {
        $rooms = Room::all();
        return view('frontend.rooms', compact('rooms'));
    }
    

    public function getintroduction(){
        return view('frontend.introduction');
    }

    public function getservices(){
        return view('frontend.services');
    }

    public function getdetails(){
        return view('frontend.details');
    }

    public function getcontact(){
        return view('frontend.contact');
    }
    public function gettermsofservice(){
        return view('frontend.terms-of-service');
    }
    //account
    public function getaccount()
    {
        $currentDateTime = Carbon::now();
        $orders = Order::where('check_out_date', '<=', $currentDateTime)
                    ->where('status', '!=', 'finished')
                    ->get();

        foreach ($orders as $order) {
            $order->status = 'finished';
            $order->save();
            
            $orderRooms = $order->orderRooms;
            foreach ($orderRooms as $orderRoom) {
                $room = $orderRoom->room;
                if ($room) {
                    $room->status = 'vacancy';
                    $room->save();
                }
            }
        }
        
        $orders = Order::where('user_id', Auth::id())->get();
        $user = Auth::user();
        $services = Service::all();
        return view('frontend.account', compact( 'user','orders','services')); 
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        if ($request->has('update_info')) {
            $request->validate([
                'full_name' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                
                'password_verification' => 'required',
            ]);

            if (!Hash::check($request->password_verification, $user->password)) {
                return redirect()->back()->with('error', 'Incorrect password verification');
            }

            $user->full_name = $request->input('full_name');
            $user->email = $request->input('email');
            $user->address = $request->input('address');
            $user->phone = $request->input('phone');
            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully');
        } elseif ($request->has('update_password')) {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|min:3|confirmed',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'Incorrect current password');
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Password changed successfully');
        }
        
        
    }
    public function updateorder(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        $validatedData = $request->validate([
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'service_id' => 'required|array',
            'description' => 'nullable',
            'quantity' => 'required|array',
        ]);
    
        $order->check_in_date = $request->input('check_in_date');
        $order->check_out_date = $request->input('check_out_date');
        $order->description = $request->input('description');
        $order->save();
    
        $order->services()->sync($request->input('service_id'));
    
        $roomRate = $order->room->price ?? 0;   
        $serviceIds = $request->input('service_id');
        $quantityValues = $request->input('quantity');
        $totalServiceAmount = 0;
    
        foreach ($serviceIds as $key => $serviceId) {
            $service = Service::find($serviceId);
    
            if ($service) {
                $quantity = $quantityValues[$key] ?? 1;
                $totalServiceAmount += $quantity * $service->price;
                $orderService = OrderServices::where('order_id', $order->id)
                    ->where('service_id', $serviceId)
                    ->first();
    
                if ($orderService) {
                    $orderService->quantity = $quantity;
                    $orderService->save();
                }
            }
        }
    
        $checkInDate = Carbon::parse($request->input('check_in_date'));
        $checkOutDate = Carbon::parse($request->input('check_out_date'));
        $totalHours = $checkInDate->diffInHours($checkOutDate);
    
        if ($totalHours < 1) {
            $totalHours = 1;
        }
    
        $totalAmount = ($totalHours * $roomRate) + $totalServiceAmount;
        $order->total_amount = $totalAmount;
        $order->save();
    
        return redirect()->back()->with('success', 'Order updated successfully.');
    }
    
    public function payment($id)
    {
        $order = Order::findOrFail($id);
        $user = Auth::user();
        $services = Service::all();
        
        $room = $order->rooms->first();
        $roomRate = $room->price;
        $checkInDate = Carbon::parse($order->check_in_date);
        $checkOutDate = Carbon::parse($order->check_out_date);
        $totalTime = $checkInDate->diffInHours($checkOutDate);
        
        if ($totalTime < 1) {
            $totalTime = 1;
        }
        
        return view('frontend.payment', compact('user', 'order', 'services', 'room', 'roomRate', 'totalTime'));
    }
    

}
