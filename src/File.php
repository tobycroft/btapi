<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use Exception;

final class File extends Base
{
    protected array $config = [
        'Upload' => '/files?action=upload'
    ];

    public function upload(string $uploadPath, string $localFilePath): mixed
    {
        file($localFilePath);
        $fileName = explode('/', $localFilePath);
        $data = [
            'f_path' => $uploadPath,
            'f_name' => end($fileName),
            'f_size' => filesize($localFilePath),
            'f_start' => 0,
            'blob' => new \CURLFile($localFilePath, '', 'blob'),
        ];
        try {
            return $this->httpPostCookie($this->getUrl('Upload'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}