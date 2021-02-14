<?php

namespace App\Http\Controllers;

use App\Testimoni;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimoniController extends Controller
{
    public function index()
    {
       $testimonis = Testimoni::paginate(5);

       return view('testimonis.index', compact('testimonis'));
    }
    public function store()
    {
        $testimoni = Testimoni::create($this->validateRequest());

        $this->storeImage($testimoni);

        return redirect()->back()->with(['success' => 'berhasil menambahkan testimoni terimakasih, silahkan buat upload testimoni kembali']);
    }
    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        return view('testimonis.edit', compact('testimoni'));
    }
    public function update(Testimoni $testimoni)
    {
        $testimoni->update($this->validateRequest());

        $this->storeImage($testimoni);

       return redirect()->back()->with(['success' => 'testimoni berhasil di perbarui']);
    }
    public function destroy(Testimoni $testimoni)
    {
        $testimoni->delete();

        if(\File::exists(public_path('storage/' . $testimoni->images))){
            \File::delete(public_path('storage/' . $testimoni->images));
        }

        return redirect()->back()->with(['success' => 'Testimoni berhasil di hapus']);
    }
    private function validateRequest(){
        return tap(request()->validate([
            'name' => 'required',
            'images'    => 'required|image|max:500000',
        ]), function(){
            if(request()->hasFile('images')){
                request()->validate([
                    'images'    => 'required|image|max:500000',
                ]);
            }
        });
    }
    private function storeImage($testimoni){
        if (request()->has('images')){
            $testimoni->update([
                'images' => request()->images->store('testimonis', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $testimoni->images))->fit(300, 300, null, 'top-left');
            $image->save();
        }
    }
}
