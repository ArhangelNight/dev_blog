<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Category $category)
    {
        $data =$request->validated();

        $currentImage = $category->image;

        if ($request->hasFile('image')) {
            if ($currentImage && Storage::disk('public')->exists($currentImage)) {
                Storage::disk('public')->delete($currentImage);
            }
            $data['image'] = Storage::disk('public')->put('/images/categories', $request->file('image'));
        } else {
            $data['image'] = $currentImage;
        }

        $category->update($data);

        return view('admin.categories.show', compact('category'));
    }
}
