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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //dashboard show
    public function getdashboard()
    {
        return view('backend.dashboard');
    }
    // services show
    public function getserviceadd()
    {
        return view('backend.serviceadd');
    }
    //service add 
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
    
    //service delete 
    public function deleteservice($id)
    {
    $service = Service::findOrFail($id);
     
    $service->delete();
    
    $picture = $service->picture;
    if ($picture) {
        $picture->delete();
    }
   
    return redirect()->back()->with('success', 'Service deleted successfully.');
    }

    //service edit 
    public function postserviceedit(Request $request, $id)
    { $service = Service::find($id);
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

    public function getserviceedit($id)
    {
    $service = Service::find($id);

    if (!$service) {
        return redirect()->back()->with('error', 'Service not found.');
    }

    return view('backend.serviceedit', compact('service'));
    }

    //services show
    public function getservices()
    {
        $services = Service::all();
        return view('backend.services', compact('services'));
    }
    
    // users show
       public function getusers()
    {
        $users = User::all(); 

        return view('backend.users', compact('users'));
    }     
    //user add 
      public function getuseradd()
    {
        return view('backend.useradd');
    }
    
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
        $user->delete();

        return back()->with('success', 'User deleted successfully');      
    }
    //edit user
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

    public function getuseredit($id)
    {
            $user = User::findOrFail($id);
            if ($user->email === 'admin@admin.com') {
                return redirect()->back()->with('error', 'Cannot edit admin account');
            }
            return view('backend.useredit', compact('user'));
    }


    //room types show
     public function getroomtypes()
    {
        $roomTypes = RoomType::all();
        return view('backend.roomtypes', compact('roomTypes'));
    }
    //room type add
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

    public function getroomtypeadd()
    {
        return view('backend.roomtypeadd');
    }
   //roomtype delete 
   public function deleteroomtype($id)
   {
        $roomtype = RoomType::findOrFail($id);
            
        $roomtype->delete();
        return back()->with('success', 'Room Type deleted successfully');       
    }
    //roomtype edit
    public function getroomtypeedit($id)
    {
    $roomType = RoomType::find($id);

    if (!$roomType) {
        return redirect()->back()->with('error', 'Room Type not found.');
    }

    return view('backend.roomtypeedit', compact('roomType'));
    }

    public function postroomtypeedit(Request $request, $id)
    {
    $request->validate([
        'name' => 'required',
        'description' => 'required',
    ]);
    $roomType = RoomType::find($id);
    if (!$roomType) {
        return redirect()->back()->with('error', 'Room Type not found.');
    }

    $roomType->name = $request->name;
    $roomType->description = $request->description;
    $roomType->save();

    return redirect()->back()->with('success', 'Room Type updated successfully.');
    } 
    //rooms show
    public function getrooms()
    {
        $rooms = Room::all();
        
        return view('backend.rooms', compact('rooms'));
    }
    
   //room add
    public function getroomadd()
    {
        $roomTypes = RoomType::all();
        $room = new Room();
        return view('backend.roomadd', compact('roomTypes', 'room'));
    }

    public function postroomadd(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:rooms',
            'size' => 'required',
            'price' => 'required',
            'type_id' => 'required',
            'status' => 'required',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = $image->getClientOriginalName();
                $imagePath = $image->move(public_path('images/rooms'), $imageName);

                $picture = new Picture([
                    'file_name' => $imageName,
                    'path' => $imagePath,
                    'gfi' => $image->getClientOriginalExtension(),
                ]);
                $picture->save();

                $room = new Room([
                    'name' => $request->name,
                    'size' => $request->size,
                    'price' => $request->price,
                    'status' => $request->status,
                    'type_id' => $request->type_id,
                    'description' => $request->description,
                ]);
                $room->save();
                $room->picture()->associate($picture);
                $room->save();
            }
        }

        return redirect()->back()->with('success', 'Room added successfully.');
    }

    //orders show
    public function getorders()
    {
        return view('backend.orders');
    }
    //order add
    public function getorderadd()
    {
        return view('backend.orderadd');
    }
}
