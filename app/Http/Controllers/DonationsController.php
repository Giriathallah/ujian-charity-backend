<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class DonationsController extends Controller
{
    // Menampilkan semua donasi
    public function index()
    {
        $donations = Donation::all();

        $donations->each(function ($donation) {
            $donation->image_url = $donation->image_path ? Storage::url('images/' . $donation->image_path) : null;
        });

        return response()->json($donations);
    }

    // Menyimpan donasi baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'in:active,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'nullable|string|max:255',
            'visibility' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);
            $input['image_path'] = $fileName;
        }

        $donation = Donation::create($input);

        return response()->json(['message' => 'Donation created successfully', 'donation' => $donation], 201);
    }

    // Mendapatkan detail donasi berdasarkan ID
    public function getById($id)
    {
        $donation = Donation::findOrFail($id);

        $donation->image_url = $donation->image_path
            ? url('images/' . $donation->image_path)
            : null;

        return response()->json(['donation' => $donation], 200);
    }

    // Memperbarui donasi
    public function update(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'target_amount' => 'sometimes|numeric|min:0',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after_or_equal:start_date',
            'status' => 'sometimes|in:active,completed,cancelled',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'nullable|string|max:255',
            'visibility' => 'boolean',
            'created_by' => 'nullable|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($donation->image_path && file_exists(public_path('images/' . $donation->image_path))) {
                unlink(public_path('images/' . $donation->image_path));
            }

            $image = $request->file('image');
            $fileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $fileName);
            $input['image_path'] = $fileName;
        }

        $donation->update($input);

        return response()->json(['message' => 'Donation updated successfully', 'donation' => $donation]);
    }

    // Menghapus donasi
    public function delete($id)
    {
        $donation = Donation::findOrFail($id);

        if ($donation->image_path && file_exists(public_path('images/' . $donation->image_path))) {
            unlink(public_path('images/' . $donation->image_path));
        }

        $donation->delete();

        return response()->json(['message' => 'Donation deleted successfully']);
    }
}