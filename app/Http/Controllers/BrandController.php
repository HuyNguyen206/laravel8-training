<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware(['verified', 'auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'image_path' => 'required|image',
            'name' => 'required'
        ]);
        $file =  $request->file('image_path');
        $extension = $file->getClientOriginalExtension();
        $uniqueId = hexdec(uniqid()).'.'.$extension;
        $imagePath = "brands/$uniqueId";
        Image::make($file)->resize(300, 200)->save(storage_path('app/public/'.$imagePath));
//        $path = $request->file('image_path')->storeAs('brands',$uniqueId);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image_path = $imagePath;
        $brand->save();
        return redirect()->back()->with('success', 'Brand was created successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $request->validate([
            'name' => 'required'
        ]);
        $brand = Brand::find($id);
        if($request->hasFile('image_path'))
        {
            if(Storage::exists($brand->image_path))
            {
                unlink(public_path('storage/').$brand->image_path);
//                Storage::delete($brand->image_path);
            }
            $file =  $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $uniqueId = hexdec(uniqid()).'.'.$extension;
//            $path = $request->file('image_path')->storeAs('brands',$uniqueId);
            $imagePath = "brands/$uniqueId";
            Image::make($file)->resize(300, 200)->save(storage_path('app/public/'.$imagePath));
            $brand->name = $request->name;
            $brand->image_path = $imagePath;
            $brand->save();
            return redirect()->back()->with('success', 'Brand was updated successfully!');
        }
        else
        {
            $brand->name = $request->name;
            $brand->save();
            return redirect()->back()->with('success', 'Brand was updated successfully!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $brand = Brand::findOrFail($id);
//        if(Storage::exists($brand->image_path))
//        {
//            Storage::delete($brand->image_path);
//        }
        $brand->delete();
        return redirect()->back()->with('success', 'Brand was deleted successfully!');
    }

    public function getAllImages()
    {
        $images = Multipic::latest()->paginate(5);
        return view('admin.multipic.index', compact('images'));
    }
    public function storeImages(Request $request)
    {
//        dd($request->file('image_path'));
        $request->validate([
            'image_path' => 'required'
        ]);
        $images = $request->file('image_path');
        foreach ($images as $image)
        {
            $extension = $image->getClientOriginalExtension();
            $uniqueId = hexdec(uniqid()).'.'.$extension;
            $imagePath = "multipic/$uniqueId";
            Image::make($image)->resize(300, 200)->save(storage_path('app/public/'.$imagePath));
//        $path = $request->file('image_path')->storeAs('brands',$uniqueId);
            $pic = new Multipic();
            $pic->image_path = $imagePath;
            $pic->save();
        }
        return redirect()->back()->with('success', 'Multipic was created successfully!');
    }
}
