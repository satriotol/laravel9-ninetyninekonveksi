<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'max:10000'
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $file = $file->storeAs('file', $file_name, 'public_uploads');

            TemporaryFile::create([
                'filename' => $file
            ]);
            return $file;
        };

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            $file_name = date('mdYHis') . '-' . $name;
            $file = $file->storeAs('image', $file_name, 'public_uploads');

            TemporaryFile::create([
                'filename' => $file
            ]);
            return $file;
        };
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $images) {
                $name = $images->getClientOriginalName();
                $image_name = date('mdYHis') . '-' . $name;
                $images = $images->storeAs('images', $image_name, 'public_uploads');

                TemporaryFile::create([
                    'filename' => $images
                ]);
                return $images;
            }
        };
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $files) {
                $name = $files->getClientOriginalName();
                $image_name = date('mdYHis') . '-' . $name;
                $files = $files->storeAs('files', $image_name, 'public_uploads');

                TemporaryFile::create([
                    'filename' => $files
                ]);
                return $files;
            }
        };
    }
    public function revert(Request $request)
    {
        $temporaryFile = TemporaryFile::where('filename', $request->getContent())->first();
        $temporaryFile->delete();
    }
}
