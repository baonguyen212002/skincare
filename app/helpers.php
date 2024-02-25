<?php
use Intervention\Image\Facades\Image;

if (!function_exists('generateThumbnail')) {
    function generateThumbnail($path, $width, $height, $crop = false)
    {
        $fullPath = public_path($path);

        // Kiểm tra xem tệp ảnh có tồn tại không
        if (file_exists($fullPath)) {
            // Tạo đường dẫn đến thư mục thumbnail dựa trên kích thước và tùy chọn
            $thumbnailFolder = $width . 'x' . $height . ($crop ? 'x1' : '');
            $thumbnailPath = public_path('thumbnails/' . $thumbnailFolder);

            // Kiểm tra xem thư mục thumbnail có tồn tại không, nếu không thì tạo mới
            if (!file_exists($thumbnailPath)) {
                mkdir($thumbnailPath, 0777, true);
            }

            // Tạo tên tệp thumbnail dựa trên các thông số
            $thumbnailName = basename($path);

            // Đường dẫn đầy đủ đến tệp thumbnail
            $thumbnailFullPath = $thumbnailPath . '/' . $thumbnailName;

            // Nếu tệp thumbnail chưa tồn tại, tạo mới
            if (!file_exists($thumbnailFullPath)) {
                // Sử dụng Intervention Image hoặc các thư viện khác để tạo thumbnail
                // Ví dụ sử dụng Intervention Image:
                $img = Image::make($fullPath);

                // Resize hoặc crop ảnh tùy thuộc vào $crop
                if ($crop) {
                    $img->fit($width, $height);
                } else {
                    $img->resize($width, $height);
                }

                // Lưu ảnh thumbnail
                $img->save($thumbnailFullPath);
            }

            // Trả về đường dẫn đến tệp thumbnail
            return asset('thumbnails/' . $thumbnailFolder . '/' . $thumbnailName);
        }

        // Trả về đường dẫn gốc nếu tệp ảnh không tồn tại
        return asset($path);
    }
}

