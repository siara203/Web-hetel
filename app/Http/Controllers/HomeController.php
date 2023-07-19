<?php

namespace App\Http\Controllers;

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

    public function getdetails()
    {
       
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
            $quantity = $request->input('quantity.' . $key, 0);
            $service = Service::findOrFail($serviceId);
            $orderService = OrderServices::where('order_id', $order->id)
                ->where('service_id', $serviceId)
                ->first();
    
            if ($orderService) {
                if ($quantity > 0) {
                    $totalServiceAmount += $quantity * $service->price;
                    $orderService->quantity = $quantity;
                    $orderService->save();
                } else {
                    // Remove the service from the order if the quantity is 0
                    $order->services()->detach($serviceId);
                    $orderService->delete();
                }
            } else {
                // Add the new service to the order
                if ($quantity > 0) {
                    $totalServiceAmount += $quantity * $service->price;
                    $order->services()->attach($serviceId, ['quantity' => $quantity]);
                }
            }
        }
    
       // Calculate total amount
       $orderRoom = OrderRoom::where('order_id', $order->id)->first();
       $room = Room::findOrFail($orderRoom->room_id);
       $roomRate = $room->price;
       $checkInDate = Carbon::parse($request->input('check_in_date'));
       $checkOutDate = Carbon::parse($request->input('check_out_date'));
       $totalHours = $checkInDate->diffInHours($checkOutDate);
   
       if ($totalHours < 1) {
           $totalHours = 1;
       }
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
    
    //    rooms, rooms detail, order

        public function search(Request $request)
        {
            $keyword = $request->input('keyword');
        $rooms = Room::where('name','like','%'.$keyword.'%')->get();
        return view('frontend.search',compact('rooms'));
        }

        public function show($id)
        {
           
            $room = Room::findOrFail($id);
            return view('frontend.room_detail', compact('room' ));
        }
        public function showDetail($id)
        {
            $user = Auth::user(); 
            $room = Room::findOrFail($id); 
            $orders = Order::where(function ($query) {
                    $query->where('status', 'approved')
                        ->orWhere('status', 'active');
                })
                ->where('check_out_date', '>', now())
                ->join('order_rooms', 'orders.id', '=', 'order_rooms.order_id')
                ->where('order_rooms.room_id', $room->id)
                ->get();
                
            return view('frontend.room_detail', compact('room', 'user', 'orders'));
        }        

        // order
    public function order($room_id, $user_id)
    {
            $room = Room::findOrFail($room_id);
            $user = User::findOrFail($user_id);
            $services = Service::all();
        
            return view('frontend.order', compact('room', 'user', 'services'));
    }
        
        
    public function postOrder(Request $request, $room_id, $user_id)
    {
        $room = Room::findOrFail($room_id);
        $user = User::findOrFail($user_id);

        $validatedData = $request->validate([
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:0',
            'service_id' => 'array',
            'service_id.*' => 'exists:services,id',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
        ]);

        $order = new Order();
        $order->user_id = $user->id;
        $order->check_in_date = $request->check_in_date;
        $order->check_out_date = $request->check_out_date;
        $order->status = 'pending';
        $order->description = $request->description;
        $order->save();

        $orderRoom = new OrderRoom();
        $orderRoom->order_id = $order->id;
        $orderRoom->room_id = $room->id;
        $orderRoom->save();

        $services = $request->service_id;
        $quantities = $request->quantity;
        $totalServiceAmount = 0;

        if (!empty($services)) {
            foreach ($services as $key => $serviceId) {
                $service = Service::find($serviceId);
                if ($service) {
                    $orderService = new OrderServices();
                    $orderService->order_id = $order->id;
                    $orderService->service_id = $service->id;
                    $orderService->quantity = $quantities[$key];
                    $orderService->save();

                    $totalServiceAmount += $quantities[$key] * $service->price;
                }
            }
        }

        return redirect()->back()
        ->with('success', 'Your order has been successfully placed, waiting for us to approve.
         Order information can be found at account information.');
    }
        
}
