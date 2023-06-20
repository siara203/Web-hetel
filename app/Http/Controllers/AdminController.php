<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller

{
    public function getdashboard()
    {
        return view('backend.dashboard');
    }
// services
    public function getserviceadd()
    {
        return view('backend.serviceadd');
    }
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
    
    // delete service
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
// edit service
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
        // Xử lý lưu ảnh mới nếu người dùng đã chọn ảnh
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

    public function getservices()
    {
        $services = Service::all();
        return view('backend.services', compact('services'));
    }
    // orders
    public function getorders()
    {
        return view('backend.orders');
    }
    public function getorderadd()
    {
        return view('backend.orderadd');
    }
    // users
       public function getusers()
    {
        $users = User::all(); 

        return view('backend.users', compact('users'));
    }     
    //add user
      public function getuseradd()
    {
        return view('backend.useradd');
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

}
?>