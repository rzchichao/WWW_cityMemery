<?php
/**
 * Created by PhpStorm.
 * User: chichao
 * Date: 2016/12/22
 * Time: 12:31
 */

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;
use Illuminate\Http\UploadedFile;
if (! function_exists('upload_one'))
{
    /*
     * 上传一张照片
     */
function upload_one($file)
{
    $originalName = $file->getClientOriginalName(); // 文件原名
    $ext = $file->getClientOriginalExtension();     // 扩展名
    $realPath = $file->getRealPath();   //临时文件的绝对路径
    $type = $file->getClientMimeType();     // image/jpeg
    $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
    // 使用我们新建的uploads本地存储空间（目录）
    $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
    $filenameSmall = "uploads/small/" . $filename;
    $filenameBig = "uploads/big/" . $filename;
    $img= ImageManagerStatic::make($file);
    $img->resize(1000, null, function ($constraint){
        $constraint->aspectRatio();
    })->save($filenameBig,90);
    $img->save($filenameSmall,50);
    $filenameBig=SITE_PATH.$filenameBig;
    return $filenameBig;
}
}

if (! function_exists('return_json'))
{
    /*
     * 上传一张照片
     */
    function return_json($status = -2,$message = "无状态", $data = "")
    {
        $arr=['status'=>$status,'message'=>$message,'data'=>$data];
        return $arr;
    }
}