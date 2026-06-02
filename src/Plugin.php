<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use Exception;

final class Plugin extends Base
{
    protected array $config = [
        'Deployment' => '/deployment?action=GetList',
        'SetupPackage' => '/plugin?action=a&name=deployment&s=SetupPackage',
        'GetSpeed' => '/deployment?action=GetSpeed',
    ];

    public function deployment(): mixed
    {
        $data = ['type' => 1];
        try {
            return $this->httpPostCookie($this->getUrl('Deployment'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setupPackage(string $sourceName, string $siteName, string $phpVersion): mixed
    {
        $data = [
            'dname' => $sourceName,
            'site_name' => $siteName,
            'php_version' => $phpVersion,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('SetupPackage'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getSpeed(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetSpeed'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}