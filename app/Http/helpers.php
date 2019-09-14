<?php

function upload($new_file, $old_file=null)
{
    delete_file($old_file);
    if ($new_file) {
        $relarive_path = "storage/app/public";
        $file_name = random_sha(20) . '.' . $new_file->getClientOriginalExtension();
        $result = $new_file->move(base_path($relarive_path),$file_name);
        return 'storage/' . $file_name;
    }else {
        return null;
    }
}

function delete_file($file)
{
    if ($file && file_exists($file)) {
        \File::delete($file);
    }
}

function random_sha($l=10)
{
	return substr(md5(rand()), 0, $l);
}
