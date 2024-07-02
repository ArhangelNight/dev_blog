<?php


namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            Db::beginTransaction();
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }
            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $post = Post::firstOrCreate($data);
            if (isset($tagIds)) {
                $post->tags()->attach($tagIds);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post, $previewFile = null, $mainFile = null)
    {
        try {
            Db::beginTransaction();
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }
            // Получаем текущие значения изображений поста
            $currentPreviewImage = $post->preview_image;
            $currentMainImage = $post->main_image;
            // Проверяем, было ли загружено новое превью изображение
            if ($previewFile != null) {
                // Удаляем старое превью изображение, если оно существует
                if ($currentPreviewImage && Storage::disk('public')->exists($currentPreviewImage)) {
                    Storage::disk('public')->delete($currentPreviewImage);
                }
                // Сохраняем новое превью изображение
                $data['preview_image'] = Storage::disk('public')->put('/images', $previewFile);
            } else {
                // Если новое превью изображение не было загружено, сохраняем старое
                $data['preview_image'] = $currentPreviewImage;
            }
            // Проверяем, было ли загружено новое основное изображение
            if ($mainFile != null) {
                // Удаляем старое основное изображение, если оно существует
                if ($currentMainImage && Storage::disk('public')->exists($currentMainImage)) {
                    Storage::disk('public')->delete($currentMainImage);
                }
                // Сохраняем новое основное изображение
                $data['main_image'] = Storage::disk('public')->put('/images', $mainFile);
            } else {
                // Если новое основное изображение не было загружено, сохраняем старое
                $data['main_image'] = $currentMainImage;
            }
            // Обновляем данные поста
            $post->update($data);
            // Обновляем теги поста
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
        return $post;
    }

}
