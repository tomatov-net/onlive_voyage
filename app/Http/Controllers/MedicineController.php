<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\MedicineCategory;
use App\MedicineManufacturer;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param \Illuminate\Database\Eloquent\Model $medicine
     * @return \Illuminate\Http\Response
     */
    public function index(Medicine $medicine)
    {
        $data['medicines'] = $medicine->with(['manufacturer', 'category'])->get();
        return view('medicines.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MedicineCategory $category, MedicineManufacturer $manufacturer)
    {

        return view('medicines.create-edit', [
            'categories' => $category->all(),
            'manufacturers' => $manufacturer->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $all = $request->all();
        if($request->file('image')){
            $image = $this->saveImage($request->image);
            $all['image'] = '/'.$image;;
        }
        $medicine = Medicine::create($all);
        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    public function saveImage($img)
    {
        $image = explode( ',', $img)[1];
        $ext = '.jpg';
        if(str_contains(explode( ',', $img)[0], 'jpeg')){
            $ext = '.jpg';
        }
        elseif(str_contains(explode( ',', $img)[0], 'png')){
            $ext = '.png';
        }
        $path = 'images/'.str_random().$ext;
        file_put_contents($path, base64_decode($image));

        $this->setWaterMark($path);

        return $path;
    }

    public function setWaterMark($path)
    {
        // Load the stamp and the photo to apply the watermark to
        if(str_contains($path, 'jpg')){
            $im = imagecreatefromjpeg($path);
        }
        else{
            $im = imagecreatefrompng($path);
        }

        $image_width = imagesx($im);
        $image_height = imagesy($im);

        $stamp = imagecreatetruecolor($image_width/2, $image_height/2);
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
        imagestring($stamp, 14, $sx/4, $sy/4, 'Watermark', 0xA4A4A4);

        imagecopymerge($im, $stamp, $image_width/2, $image_height/2, 0, 0, imagesx($stamp), imagesy($stamp), 50);

        if(str_contains($path, 'jpg')){
            imagejpeg($im, $path);
        }
        else{
            imagepng($im, $path);
        }

        imagedestroy($im);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, MedicineCategory $category, MedicineManufacturer $manufacturer)
    {
        return view('medicines.create-edit', [
            'data' => Medicine::find($id),
            'categories' => $category->all(),
            'manufacturers' => $manufacturer->all(),
        ]);
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
        $data = $request->all();
        if($request->image){
            $path = $this->saveImage($request->image);

            $data['image'] = '/'.$path;
        }
        $medicine = Medicine::updateOrCreate(['id' => $id], $data);
        return response()->json('ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Medicine::find($id)->delete();
        return response()->json('ok');
    }
}
