<?php

namespace App\Http\Controllers;

use App\Mitra;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MitraController extends Controller
{
    public function index()
    {
        $mitras = Mitra::paginate(5);
       return view('mitras.index', compact('mitras'));
    }
    public function edit($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('mitras.create', compact('mitra'));
    }
    public function update(Mitra $mitra)
    {
        $mitra->update($this->validateRequest());

        $this->storeImage($mitra);

       return redirect()->back()->with(['success' => 'Mitra berhasil di perbarui']);
    }
    public function store()
    {
        $mitras = Mitra::create($this->validateRequest());

        $this->storeImage($mitras);

        return redirect()->back()->with(['success' => 'berhasil menambahkan mitra terimakasih, silahkan buat upload mitra kembali']);
    }
    public function destroy(Mitra $mitra)
    {
        $mitra->delete();

        if(\File::exists(public_path('storage/' . $mitra->images))){
            \File::delete(public_path('storage/' . $mitra->images));
        }

        return redirect()->back()->with(['success' => 'Mitra berhasil di hapus']);
    }
    private function validateRequest(){
        return tap(request()->validate([
            'name' => 'required',
            'images'    => 'required|imagemax:500000',
            'info' => 'required',
        ]), function(){
            if(request()->hasFile('images')){
                request()->validate([
                    'images'    => 'required|imagemax:500000',
                ]);
            }
        });
    }
    private function storeImage($mitras){
        if (request()->has('images')){
            $mitras->update([
                'images' => request()->images->store('uploads', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $mitras->images))->fit(300, 300, null, 'top-left');
            $image->save();
        }
    }
}
