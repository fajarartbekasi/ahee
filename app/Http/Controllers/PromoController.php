<?php

namespace App\Http\Controllers;

use App\Promo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::paginate(5);

        return view('promo.index', compact('promos'));
    }

    public function store()
    {
        $promo = Promo::create($this->validateRequest());

        $this->storeImage($promo);

        return redirect()->back()->with(['success' => 'berhasil menambahkan promo terimakasih, silahkan buat upload promo kembali']);
    }
    public function edit($id)
    {
        $promo = Promo::findOrFail($id);

        return view('promo.edit', compact('promo'));
    }
    public function update(Promo $promo)
    {
        $promo->update($this->validateRequest());

        $this->storeImage($promo);

       return redirect()->back()->with(['success' => 'Promo berhasil di perbarui']);
    }
    public function destroy(Promo $promo)
    {
        $promo->delete();

        if(\File::exists(public_path('storage/' . $promo->images))){
            \File::delete(public_path('storage/' . $promo->images));
        }

        return redirect()->back()->with(['success' => 'Promo berhasil di hapus']);
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
    private function storeImage($promo){
        if (request()->has('images')){
            $promo->update([
                'images' => request()->images->store('promos', 'public'),
            ]);

            $image = Image::make(public_path('storage/' . $promo->images))->fit(300, 300, null, 'top-left');
            $image->save();
        }
    }
}
