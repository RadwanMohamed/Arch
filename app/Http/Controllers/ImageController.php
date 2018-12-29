<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use ImageIntervention;
use File;
class ImageController extends Controller
{
    /**
     * files name container
     * @var array
     */
    private $fileNames = [];

    /**
     * upload one file
     * @param $file
     * @return mixed
     */

    protected function uploadFile($file)
    {

        $fileName = date('y-m-d-h-i-s-v') . $file->getClientOriginalName();
        $file->move('images',$fileName);
        return $fileName;
    }

    /**upload multiple file
     * @param ImageRequest $request
     * @return array
     */

    protected function uploadMultiple($files)
    {
        foreach ($files as $key => $file)
        {
            $this->fileNames[] = $this->uploadFile($file);
            $this->imageIntervention('images/'.$this->fileNames[$key]);
        }
        return $this->fileNames;
    }

    /**
     * check whether the file is exist or not
     * @param $file
     * @return bool
     */
    protected function fileIsExist($file)
    {
        return file_exists($file);
    }
    /**
     * add file url into database
     * @param $imageable_id
     * @param $imageable_type
     * @return bool
     */
    protected function addUrl($imageable_id,$imageable_type,$filename)
    {

        Image::create([
            'image_url' =>$filename,
            'imageable_id' => $imageable_id,
            'imageable_type'=> $imageable_type
        ]);
    }
    /**
     * update file url into database
     * @param $imageable_id
     * @param $imageable_type
     * @return bool
     */
    protected function updateUrl($image,$filename)
    {
        $image->update([
            'image_url' =>$filename,
        ]);

    }
    /**
     * add multiple file url into database
     * @param $imageable_id
     * @param $imageable_type
     * @return bool
     */
    protected function addAllUrl($imageable_id,$imageable_type)
    {
        foreach ($this->fileNames as $file)
        {
            $this->addUrl($imageable_id,$imageable_type,$file);
        }
        return true;
    }

    /**
     * delete file
     * @param $file
     */
    protected function delete($file)
    {
        if ($this->fileIsExist($file))
            File::delete($file);



    }

    /**
     * delete file row from database
     * @param $url
     */
    protected function removeUrl($url)
    {
        $url->delete();
    }

    /**
     * delete all files
     * @param $files
     */
    protected function deleteAll($files)
    {
        foreach ($files as $file)
        {
            $this->delete($file->image_url);
        }
    }

    /**
     * remove all images url in database
     * @param $urls
     */
    protected function removeAllUrl($urls)
    {
        foreach ($urls as $url)
        {
            $this->removeUrl($url);
        }
    }
    /**
     * resize image dimensions
     * @param $image
     */
    protected function imageIntervention($image)
    {
        $img = ImageIntervention::make($image);
        $img->resize(400,450);
        $img->save($image);
    }



}
