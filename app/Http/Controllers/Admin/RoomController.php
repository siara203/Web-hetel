<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\RoomType;
use App\Models\Order;
use App\Models\OrderRoom;
use App\Models\OrderServices;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
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
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

        $imagePaths = [];

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/rooms'), $imageName);
                $imagePaths['image' . $i] = $imageName;
            }
        }

        $room->update($imagePaths);

        return redirect()->back()->with('success', 'Room added successfully.');
    }
   
    // edit room
    public function getroomedit($id)
    {
        $orders = Order::all();
        $users = User::all();
        $room = Room::findOrFail($id);
        $roomTypes = RoomType::all();

        return view('backend.roomedit', compact('room', 'roomTypes','users', 'orders'));
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
            'image1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image4' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image5' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required',
        ]);

        $room = Room::findOrFail($id);

        $imagePaths = [];

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile('image' . $i)) {
                $image = $request->file('image' . $i);
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/rooms'), $imageName);
                $imagePaths['image' . $i] = $imageName;
            }
        }

        $room->update($imagePaths);
        $room->update([
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'type_id' => $request->type_id,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Room updated successfully.');
    }

    // delete room
    public function deleteroom($id)
    {
        $room = Room::findOrFail($id);

        if ($room->orders()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete room as it has associated orders.');
        }

        // Delete images
        for ($i = 1; $i <= 5; $i++) {
            $imagePath = $room['image' . $i];
            if (!empty($imagePath) && Storage::exists(public_path('images/rooms/' . $imagePath))) {
                Storage::delete(public_path('images/rooms/' . $imagePath));
            }
        }

        $room->delete();

        return redirect()->back()->with('success', 'Room deleted successfully.');
    }
}
