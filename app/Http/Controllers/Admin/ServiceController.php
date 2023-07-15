<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // show services
    public function getservices()
    {
        $orders = Order::all();
        $users = User::all();
        $services = Service::all();
        return view('backend.services', compact('services', 'users', 'orders'));
    }

    // show add service form
    public function getserviceadd()
    {
        $users = User::all();
        $orders = Order::all();
        return view('backend.serviceadd', compact('users', 'orders'));
    }

    // add service
    public function postserviceadd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path('images/services');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $fileName);
        } else {
            $fileName = 'noname.jpg';
        }


        $service = new Service([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $fileName,
        ]);
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
    
        $imagePath = public_path('images/services/' . $service->image);
    
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    
        $service->delete();
    
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }

    // Edit service
    public function postserviceedit(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,gif,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/services'), $fileName);
            $data['image'] = $fileName;

            $previousImagePath = public_path('images/services/' . $service->image);
            if (file_exists($previousImagePath)) {
                unlink($previousImagePath);
            }
        }

        $service->update($data);

        return redirect()->back()->with('success', 'Service updated successfully.');
    }

    // show edit service form
    public function getserviceedit($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return redirect()->back()->with('error', 'Service not found.');
        }

        $users = User::all();
        $orders = Order::all();

        return view('backend.serviceedit', compact('service', 'users', 'orders'));
    }
}
