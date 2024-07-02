<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $previewFile = $request->hasFile('preview_image') ? $request->file('preview_image') : null;
        $mainFile = $request->hasFile('main_image') ? $request->file('main_image') : null;

        $post = $this->service->update($data, $post, $previewFile, $mainFile);

// Возвращаем вид с обновленными данными поста
        return view('admin.posts.show', compact('post'));

        /* $data = $request->validated();
        $tagIds = $data['tag_ids'];
        unset($data['tag_ids']);
        $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
        $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
        $post->update($data);
        $post->tags()->sync($tagIds);
        return view('admin.posts.show', compact('post'));*/
    }
}
