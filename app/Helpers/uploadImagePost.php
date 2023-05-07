<?php

use Illuminate\Support\Facades\Storage;

function uploadImagePost($image) {
    return Storage::disk('uploadImagePost')->put('', $image);
}

function deleteImagePost($image) {
    return Storage::disk('uploadImagePost')->delete($image);
}
