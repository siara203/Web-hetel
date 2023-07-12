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
use Carbon\Carbon;

class AdminController extends Controller
{
    // show dashboard
    public function getdashboard()
    {
        $totalSales = Order::where('status', 'finished')->sum('total_amount');
        $orders = Order::all();
        $totalRooms = Room::count();
        $totalOrders = Order::count();
        $users = User::all();

        return view('backend.dashboard', compact('users', 'orders','totalSales','totalOrders','totalRooms'));
    }    

    // show notification
    public function notification()
    {
        $orders = Order::all();
        $users = User::all();

        return view('backend.notification', compact('users', 'orders'));
    }

    // show services
    public function getserviceadd()
    {
        $orders = Order::all();
        $users = User::all();
        
        return view('backend.serviceadd', compact('users', 'orders'));
    }

    // add service
    public function postserviceadd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'pic' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);
        $imageName = $request->file('pic')->getClientOriginalName();
        $imagePath = $request->file('pic')->move(public_path('images/services'), $imageName);

        $picture = new Picture([
            'file_name' => $imageName,
            'path' => $imagePath,
            'gfi' => $request->pic->getClientOriginalExtension(),
        ]);
        $picture->save();
    
        $service = new Service([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        $service->save();
    
        $service->picture()->associate($picture);
        $service->save();
    
        return redirect()->back()->with('success', 'Service added successfully.');
    }
    
    //delete service
    public function deleteservice($id)
    {
        $service = Service::findOrFail($id);
    
        if ($service->orders()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete service as it has associated orders.');
        }
    
        $service->delete();
    
        $picture = $service->picture;
        if ($picture) {
            $picture->delete();
        }
    
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
    

    // edit service
    public function postserviceedit(Request $request, $id)
    { 
        $service = Service::find($id);
        $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
        'description' => 'required',
        'pic' => 'image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        if (!$service) {
            return redirect()->back()->with('error', 'Service not found.');
        }

        if ($request->hasFile('pic')) {
            $imagePath = $request->file('pic')->store('images/services');
            $imageName = $request->file('pic')->getClientOriginalName();
            $service->picture->update([
                'file_name' => $imageName,
                'path' => $imagePath,
                'gfi' => $request->pic->getClientOriginalExtension(),
            ]);
        }

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Service updated successfully.');
    }

    //
    public function getserviceedit($id)
    {
        $orders = Order::all();
        $users = User::all();
        $service = Service::find($id);

        if (!$service) {
         return redirect()->back()->with('error', 'Service not found.');
        }

    return view('backend.serviceedit', compact('service','users', 'orders'));
    }

    // show services
    public function getservices()
    {
        $orders = Order::all();
        $users = User::all();
        $services = Service::all();
        return view('backend.services', compact('services','users', 'orders'));
    }
    
    // show users
       public function getusers()
    {
        $users = User::all(); 
        $orders = Order::all();
        return view('backend.users', compact('users', 'orders'));
    }     

    // add user
      public function getuseradd()
    {
        $users = User::all(); 
        $orders = Order::all();
        return view('backend.useradd', compact('users', 'orders'));
    }

    //
    public function postuseradd(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required|digits_between:5,15',
            'email' => 'required|email|unique:users',
            'address' => 'required',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'role' => 'required',
        ]);

        $user = new User;
        $user->full_name = $request->input('full_name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role = $request->input('role');
        $user->address = $request['address'];
        $user->save();

        return redirect()->back()->with('success', 'User added successfully.');
    }
    
    // delete user
    public function getuserdelete($id)
    {
        $user = User::find($id);
    
        if ($user->email === 'admin@admin.com') {
            return back()->with('error', 'Cannot delete admin account');
        }
    
        if ($user->orders()->count() > 0) {
            return back()->with('error', 'Cannot delete user because there is an order');
        }
    
        $user->delete();
    
        return back()->with('success', 'User deleted successfully');
    }
    
    // edit user
    public function postuseredit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validatedData = $request->validate([
        'full_name' => 'required',
        'phone' => 'required',
        'email' => 'required|email|unique:users,email,'.$id,
        'password'=>'required',
        'confirm_password' => 'required|same:password',
        'role' => 'required|in:user,admin', 
        ],[
        'email.unique' => 'The email has already been taken.',
        'confirm_password.same' => 'The password confirmation does not match.',  
        ]);

        $user->full_name = $validatedData['full_name'];
        $user->phone = $validatedData['phone'];
        $user->email = $validatedData['email'];
        $user->password = $validatedData['password'];
        $user->role = $validatedData['role'];
        $user->save();

        return redirect()->back()->with('success', 'User updated successfully');
    }

    //
    public function getuseredit($id)
    {           
        $orders = Order::all();
        $users = User::all();
        $user = User::findOrFail($id);
        if ($user->email === 'admin@admin.com') {
             return redirect()->back()->with('error', 'Cannot edit admin account');
        }
        return view('backend.useredit', compact('user','users', 'orders'));
    }

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

    // show rooms
    public function getrooms()
    {
        $orders = Order::all();
        $users = User::all();
        $rooms = Room::all();

        return view('backend.rooms', compact('rooms','users', 'orders'));
    }
    
   // add room
    public function getroomadd()
    {
        $orders = Order::all();
        $users = User::all();
        $roomTypes = RoomType::all();
        $room = new Room();

        return view('backend.roomadd', compact('roomTypes', 'room','users', 'orders'));
    }

    //
    public function postroomadd(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:rooms',
            'size' => 'required',
            'price' => 'required',
            'type_id' => 'required',
            'status' => 'required',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);
    
        $room = new Room([
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'status' => $request->status,
            'type_id' => $request->type_id,
            'description' => $request->description,
        ]);
        $room->save();
    
        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $image2Name = time() . '_' . $image2->getClientOriginalName();
            $image2->move(public_path('images/rooms'), $image2Name);
    
            $picture2 = new Picture([
                'file_name' => $image2Name,
                'path' => $image2Name,
                'gfi' => $image2->getClientOriginalExtension(),
            ]);
            $picture2->save();
            $room->image2 = $image2Name;
        }
    
        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $image3Name = time() . '_' . $image3->getClientOriginalName();
            $image3->move(public_path('images/rooms'), $image3Name);
    
            $picture3 = new Picture([
                'file_name' => $image3Name,
                'path' => $image3Name,
                'gfi' => $image3->getClientOriginalExtension(),
            ]);
            $picture3->save();
            $room->image3 = $image3Name;
        }
    
        if ($request->hasFile('image4')) {
            $image4 = $request->file('image4');
            $image4Name = time() . '_' . $image4->getClientOriginalName();
            $image4->move(public_path('images/rooms'), $image4Name);
    
            $picture4 = new Picture([
                'file_name' => $image4Name,
                'path' => $image4Name,
                'gfi' => $image4->getClientOriginalExtension(),
            ]);
            $picture4->save();
            $room->image4 = $image4Name;
        }
    
        if ($request->hasFile('image5')) {
            $image5 = $request->file('image5');
            $image5Name = time() . '_' . $image5->getClientOriginalName();
            $image5->move(public_path('images/rooms'), $image5Name);
    
            $picture5 = new Picture([
                'file_name' => $image5Name,
                'path' => $image5Name,
                'gfi' => $image5->getClientOriginalExtension(),
            ]);
            $picture5->save();
            $room->image5 = $image5Name;
        }
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move(public_path('images/rooms'), $imageName);
    
            $picture = new Picture([
                'file_name' => $imageName,
                'path' => $imageName,
                'gfi' => $image->getClientOriginalExtension(),
            ]);
            $picture->save();
            $room->picture()->associate($picture);
        }
    
        $room->save();
    
        return redirect()->back()->with('success', 'Room added successfully.');
    }
    
    // edit room
    public function getroomedit($id)
    {
        $orders = Order::all();
        $users = User::all();
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();

        return view('backend/roomedit', compact('room', 'roomTypes','users', 'orders'));
    }

    //
    public function postroomedit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:rooms,name,'.$id,
            'size' => 'required',
            'price' => 'required',
            'type_id' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        $room = Room::findOrFail($id);
        $previousStatus = $room->status;

        $room->name = $request->name;
        $room->size = $request->size;
        $room->price = $request->price;
        $room->type_id = $request->type_id;
        $room->status = $request->status;
        $room->description = $request->description;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->move(public_path('images/rooms'), $imageName);

            $picture = new Picture([
                'file_name' => $imageName,
                'path' => $imagePath,
                'gfi' => $image->getClientOriginalExtension(),
            ]);
            $picture->save();

            $room->picture()->associate($picture);
        }

        if ($request->hasFile('image2')) {
            $image2 = $request->file('image2');
            $imageName2 = $image2->getClientOriginalName();
            $imagePath2 = $image2->move(public_path('images/rooms'), $imageName2);

            $picture2 = new Picture([
                'file_name' => $imageName2,
                'path' => $imagePath2,
                'gfi' => $image2->getClientOriginalExtension(),
            ]);
            $picture2->save();

            $room->image2 = $imageName2;
        }

        if ($request->hasFile('image3')) {
            $image3 = $request->file('image3');
            $imageName3 = $image3->getClientOriginalName();
            $imagePath3 = $image3->move(public_path('images/rooms'), $imageName3);

            $picture3 = new Picture([
                'file_name' => $imageName3,
                'path' => $imagePath3,
                'gfi' => $image3->getClientOriginalExtension(),
            ]);
            $picture3->save();

            $room->image3 = $imageName3;
        }

        if ($request->hasFile('image4')) {
            $image4 = $request->file('image4');
            $imageName4 = $image4->getClientOriginalName();
            $imagePath4 = $image4->move(public_path('images/rooms'), $imageName4);

            $picture4 = new Picture([
                'file_name' => $imageName4,
                'path' => $imagePath4,
                'gfi' => $image4->getClientOriginalExtension(),
            ]);
            $picture4->save();

            $room->image4 = $imageName4;
        }

        if ($request->hasFile('image5')) {
            $image5 = $request->file('image5');
            $imageName5 = $image5->getClientOriginalName();
            $imagePath5 = $image5->move(public_path('images/rooms'), $imageName5);

            $picture5 = new Picture([
                'file_name' => $imageName5,
                'path' => $imagePath5,
                'gfi' => $image5->getClientOriginalExtension(),
            ]);
            $picture5->save();

            $room->image5 = $imageName5;
        }

        $room->save();
        if (($previousStatus === 'active') && ($room->status === 'maintenance' || $room->status === 'vacancy')) {
            $orderRoom = OrderRoom::where('room_id', $room->id)->first();
            if ($orderRoom) {
                $order = $orderRoom->order;
                if ($order && $order->status === 'active') {
                    $order->status = 'pending';
                    $order->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Room updated successfully.');
    }

    // delete room
    public function deleteroom($id)
    {
        $room = Room::findOrFail($id);
        $orderCount = $room->orders()->count();

        if ($orderCount > 0) {
            return redirect()->back()->with('error', 'Cannot delete room. It has associated orders.');
        }

        $room->delete();
        $picture = $room->picture;
        if ($picture) {
            $picture->delete();
        }
    
        return redirect()->back()->with('success', 'Room deleted successfully.');
    }
    
    // show orders
    public function getorders()
    {
        $currentDateTime = Carbon::now();
        $completedOrders = Order::where('check_out_date', '<=', $currentDateTime)
            ->where('status', '!=', 'finished')
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

        return view('backend.orders', compact('orders','users'));
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

    //button active
    public function orderactivate($id)
    {
        $order = Order::findOrFail($id);
        $orderRoom = OrderRoom::where('order_id', $order->id)->first();
        if ($orderRoom) {
            $room = Room::findOrFail($orderRoom->room_id);
            if ($room->status === 'active') {
                return redirect()->back()->with('error', 'This room is already active.');
            }
        }

        $order->status = 'active';
        $order->save();

        if ($orderRoom) {
            $room->status = 'active';
            $room->save();
        }

        return redirect()->back()->with('success', 'Order activated successfully.');
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

        $order->services()->sync($request->input('service_id'));

        $orderRoom = OrderRoom::where('order_id', $order->id)->first();
        $room = Room::findOrFail($orderRoom->room_id);

        if ($order->status === 'active' && $room->status === 'vacancy') {
            $room->status = 'active';
            $room->save();
        }

        if ($request->input('status') === 'cancelled' || $request->input('status') === 'finished' || $request->input('status') === 'pending') {
            $room->status = 'vacancy';
        }
        $room->save();

        $roomRate = $room->price;
        $serviceIds = $request->input('service_id');
        $totalServiceAmount = 0;

        foreach ($serviceIds as $key => $serviceId) {
            $quantity = $request->input('quantity.' . $key, 0);
            $service = Service::findOrFail($serviceId);
            $totalServiceAmount += $quantity * $service->price;
            $orderService = OrderServices::where('order_id', $order->id)
                ->where('service_id', $serviceId)
                ->first();
            $orderService->quantity = $quantity;
            $orderService->save();
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
}
