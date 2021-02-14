<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    public function index()
    {
        $gallerys = Gallery::paginate(5);

        return view('gallerys.index', compact('gallerys'));
    }

    public function store()
    {
        $gallery = Gallery::create($this->validateRequest());

        $this->storeImage($gallery);

        return redirect()->back()->with(['success' => 'berhasil menambahkan gallery terimakasih, silahkan buat upload gallery kembali']);
    }
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('gallerys.edit', compact('gallery'));
    }
    public function update(Gallery $gallery)
    {
        $gallery->update($this->validateRequest());

        $this->storeImage($gallery);

       return redirect()->back()->with(['success' => 'Gallery berhasil di perbarui']);
    }
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();

        if(\File::exists(public_path('storage/' . $gallery->images))){
            \File::delete(public_path('storage/' . $gallery->images));
        }

        return redirect()->back()->with(['success' => 'Gallery berhasil di hapus']);
    }
    private function validateRequest(){
        return tap(request()->validate([
            'title' => 'required',
            'images'    => 'required|image|max:500000',
            'descriptions' => 'required'
        ]), function(){
            if(request()->hasFile('images')){
                request()->validate([
                    'images'    => 'required|image|max:500000',
                ]);
            }
        });
    }
    private function storeImage($gallery){
        if (request()->has('images')){
            $gallery->update([
                'images' => request()->images->store('gallerys', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $gallery->images))->fit(300, 300, null, 'top-left');
            $image->save();
        }
    }
}
