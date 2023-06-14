<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
    public function getdashboard()
    {
        return view('admin.dashboard');
    }

    public function getserviceadd()
    {
        return view('admin.serviceadd');
    }

    public function getservices()
    {
        return view('admin.services');
    }
    public function getorders()
    {
        return view('admin.orders');
    }
    public function getorderadd()
    {
        return view('admin.orderadd');
    }
       public function getusers()
    {
        $users = User::all(); 

        return view('admin.users', compact('users'));
    }     
    //users
      public function getuseradd()
    {
        return view('admin.useradd');
    }
    // add user
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
    ],[
        'email.unique' => 'The email has already been taken.',
        'confirm_password.same' => 'The password confirmation does not match.',
        
    ]);
    $user->full_name = $validatedData['full_name'];
    $user->phone = $validatedData['phone'];
    $user->email = $validatedData['email'];
    $user->password = $validatedData['password'];
    $user->save();
    return redirect()->back()->with('success', 'User updated successfully');
}

    public function getuseredit($id)
    {
            $user = User::findOrFail($id);
            if ($user->email === 'admin@admin.com') {
                return redirect()->back()->with('error', 'Cannot edit admin account');
            }
            return view('admin.useredit', compact('user'));
    }

}
?>