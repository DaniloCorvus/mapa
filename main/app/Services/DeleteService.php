<?php

namespace App\Services;

class DeleteService
{
	// public function handleDeleteedFile($file)
	// {
	// 	if (!is_null($file)) {
	// 		$filename = '_' . time() . '_' . $file->getClientOriginalName();
	// 		$file->move(public_path('/files'), $filename);
	// 		return $filename;
	// 	}
	// }

	public function handleDeleteedPdf($file): void
	{
		\File::delete(public_path('/pdfs/' . $file));
	}
}
