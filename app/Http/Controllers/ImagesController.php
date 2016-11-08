<?php

namespace App\Http\Controllers;

use App\Img;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'image' => 'required|mimes:jpg,jpeg,png,gif|max:2000',
        ];

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);

        } else {

            $file = $request->file('image');


            $img = Img::create(['file'=>$file]);

            flash('Image has been successfully uploaded','success');
            return view('imageViewer')->with(compact('img'));

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Img::destroy($id);
    }

    public function showImage($type,$id)
    {
        $img = Img::find($id);

        switch($type){
            case 'product':
                $file = $img->getProductImage();
                break;
            case 'icon':
                $file = $img->getIconImage();
                break;
            case 'thumbnail':
                $file = $img->getThumbnailImage();
                break;
            default:
                $file = $img->getOriginalImage();
                break;
        }

        return Image::make(Storage::get($file))->response();
    }

}
