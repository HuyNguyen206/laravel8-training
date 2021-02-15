<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Database\Events\SchemaLoaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sliders = Slider::paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image_path' => 'image|required'
        ]);
        $file = $request->file('image_path');
        $extension = $file->getClientOriginalExtension();
        $uniqueId = hexdec(uniqid()) . '.' . $extension;
        $imagePath = "sliders/$uniqueId";
        Image::make($file)->resize(1920, 1088)->save(storage_path('app/public/' . $imagePath));
//        $path = $request->file('image_path')->storeAs('brands',$uniqueId);
        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image_path = $imagePath;
        $slider->save();
        return redirect()->back()->with('success', 'Slider was created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $slider = Slider::findOrFail($id);
        if ($request->hasFile('image_path')) {
            if (Storage::exists($slider->image_path)) {
                unlink(public_path('storage/') . $slider->image_path);
//                Storage::delete($slider->image_path);
            }
            $file = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $uniqueId = hexdec(uniqid()) . '.' . $extension;
//            $path = $request->file('image_path')->storeAs('brands',$uniqueId);
            $imagePath = "sliders/$uniqueId";
            Image::make($file)->resize(1920, 1800)->save(storage_path('app/public/' . $imagePath));
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->image_path = $imagePath;
            $slider->save();
            return redirect()->back()->with('success', 'Slider was updated successfully!');
        } else {
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->save();
            return redirect()->back()->with('success', 'Slider was updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //
        $slider = Slider::findOrFail($id);
//        if(Storage::exists($slider->image_path))
//        {
//            Storage::delete($slider->image_path);
//        }
        $slider->delete();
        return redirect()->back()->with('success', 'Slider was deleted successfully!');
    }
}
