<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MediaUpload extends Model
{
    use HasFactory;
    
    public function getMediaForOrder($order_id) {
        return DB::table('media_uploads')
            ->join('element_media_uploads', 'media_uploads.id', '=', 'element_media_uploads.media_upload_id')
            ->join('order_items', 'order_items.element_element_id', '=', 'element_media_uploads.element_element_id')
            ->where('order_items.order_id', '=', $order_id)
            ->get();
    }
    
    public function getMediaForElement($element_id) {
        return DB::table('media_uploads')
            ->join('element_media_uploads', 'media_uploads.id', '=', 'element_media_uploads.media_upload_id')
            ->where('element_media_uploads.element_element_id', '=', $element_id)
            ->get();
    }
    
}
