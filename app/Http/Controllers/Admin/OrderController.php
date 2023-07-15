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

class OrderController extends Controller
{
   
    // show orders
    public function getorders()
{
    $currentDateTime = Carbon::now();
    
    // Update status of active orders
    $activeOrders = Order::where('status', 'approved')
        ->where('check_in_date', '<=', $currentDateTime)
        ->get();

    foreach ($activeOrders as $order) {
        $order->status = 'active';
        $order->save();

        $orderRooms = $order->orderRooms;
        foreach ($orderRooms as $orderRoom) {
            $room = $orderRoom->room;
            if ($room) {
                $room->status = 'active';
                $room->save();
            }
        }
    }

    // Update status of completed orders
    $completedOrders = Order::where('status', '!=', 'finished')
        ->where('check_out_date', '<=', $currentDateTime)
        ->get();

    foreach ($completedOrders as $order) {
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

    $users = User::all();
    $orders = Order::all();

    return view('backend.orders', compact('orders', 'users'));
}


    // add order
    public function getorderadd()
    {
        $orders = Order::all();
        $users = User::all();
        $rooms = Room::all();
        $services =Service::all();

        return view('backend.orderadd', compact('orders','users', 'rooms','services'));
    }
    //
    public function postorderadd(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'status' => 'required',
            'room_id' => 'required|exists:rooms,id',
            'service_id' => 'array',
            'service_id.*' => 'exists:services,id',
            'quantity' => 'array', 
        ]);

        $order = new Order();
        $order->user_id = $request->user_id;
        $order->check_in_date = $request->check_in_date;
        $order->check_out_date = $request->check_out_date;
        $order->status = $request->status;
        $order->description = $request->description;
        $order->save();

        $room = Room::find($request->room_id);
        if ($room) {
            $orderRoom = new OrderRoom();
            $orderRoom->order_id = $order->id;
            $orderRoom->room_id = $room->id;
            $orderRoom->save();

            if ($order->status == 'active') {
                $room->status = 'active';
                $room->save();
            }
        }

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

        $room = Room::findOrFail($request->input('room_id'));
        $roomRate = $room->price;
        $totalHours = 0;
        foreach ($services as $key => $serviceId) {
            $service = Service::find($serviceId);
            $totalHours += $quantities[$key] * $service->duration;
        }

        if ($totalHours < 1) {
            $totalHours = 1;
        }

        $roomTotal = $roomRate * $totalHours;
        $subtotal = $roomTotal + $totalServiceAmount;
        $totalAmount = $subtotal;

        $order->total_amount = $totalAmount;
        $order->save();

        return redirect()->back()->with('success', 'Order added successfully.');
    }

    //button approved
        public function orderapproved($id)
        {
        $order = Order::findOrFail($id);
        $orderRoom = OrderRoom::where('order_id', $order->id)->first();
        if ($orderRoom) {
        $room = Room::findOrFail($orderRoom->room_id);
        if ($room->status === 'active') {
        return redirect()->back()->with('error', 'This room is already active.');
        }
        }
        $order->status = 'approved';
        $order->save();

        if ($orderRoom) {
            $room->status = 'vacancy';
            $room->save();
            }

        return redirect()->back()->with('success', 'Order approved successfully.');

        }
    //button cancel
    public function ordercancel($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        $orderRoom = OrderRoom::where('order_id', $order->id)->first();
        if ($orderRoom) {
            $room = Room::findOrFail($orderRoom->room_id);
            $room->status = 'vacancy';
            $room->save();
        }
    
        return redirect()->back()->with('success', 'Order cancelled successfully.');
    } 

    // delete order
    public function deleteorder($id)
    {
        $order = Order::findOrFail($id);
        $order->rooms()->detach();
        $order->services()->detach();
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }

        // edit order
    public function getorderedit(Request $request, $id)
    {
        $orders = Order::all();
        $order = Order::findOrFail($id);
        $users = User::all();
        $services = Service::all();
        $rooms = Room::where('status', 'vacancy')->get();
            
        return view('backend/orderedit', compact('orders','order', 'users', 'services', 'rooms'));
    }

    //
    public function postorderedit(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        $validatedData = $request->validate([
            'user_id' => 'required',
            'check_in_date' => 'required',
            'check_out_date' => 'required',
            'status' => 'required',
            'service_id' => 'required|array',
            'room_id' => 'required',
            'description' => 'nullable',
            'quantity' => 'required|array',
        ]);
    
        $order->user_id = $request->input('user_id');
        $order->check_in_date = $request->input('check_in_date');
        $order->check_out_date = $request->input('check_out_date');
        $order->status = $request->input('status');
        $order->description = $request->input('description');
        $order->save();
    
        $serviceIds = $request->input('service_id');
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
    
        // Update room status
        if ($order->status === 'active' && $room->status === 'vacancy') {
            $room->status = 'active';
        } elseif ($request->input('status') === 'cancelled' || $request->input('status') === 'finished' || $request->input('status') === 'pending') {
            $room->status = 'vacancy';
        }
        $room->save();

    
        return redirect()->back()->with('success', 'Order updated successfully.');
    }
    
        
}
