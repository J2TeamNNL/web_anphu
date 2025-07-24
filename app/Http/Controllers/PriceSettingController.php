<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Price;

class PriceSettingController extends Controller
{
    public function index()
    {
        $prices = Price::all();
        return view('admins.settings.price.index', compact('prices'));
    }

    public function create()
    {
        return view('admins.settings.price.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Price::create($request->all());

        return redirect()->route('settings.price.index')->with('success', 'Thêm giá thành công');
    }

    public function edit($id)
    {
        $price = Price::findOrFail($id);
        return view('admins.settings.price.edit', compact('price'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $price = Price::findOrFail($id);
        $price->update($request->all());

        return redirect()->route('settings.price.index')->with('success', 'Cập nhật giá thành công');
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();

        return redirect()->route('settings.price.index')->with('success', 'Xóa giá thành công');
    }
}
