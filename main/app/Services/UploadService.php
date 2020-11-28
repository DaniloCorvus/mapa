<?php

namespace App\Services;

class UploadService
{
	public function handleUploadedFile($file)
	{
		if (!is_null($file)) {
			$filename = '_' . time() . '_' . $file->getClientOriginalName();
			$file->move(public_path('/files'), $filename);
			return $filename;
		}
	}

	public function handleUploadedPdf($file)
	{
		if (!is_null($file)) {
			$filename = '_' . time() . '_' . $file->getClientOriginalName();
			$file->move(public_path('/pdfs'), $filename);
			return $filename;
		}
	}
}
