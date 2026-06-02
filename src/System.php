<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use Exception;

final class System extends Base
{
    protected array $config = [
        'GetSystemTotal' => '/system?action=GetSystemTotal',
        'GetDiskInfo' => '/system?action=GetDiskInfo',
        'GetNetWork' => '/ajax?action=GetNetWork',
        'GetTaskCount' => '/ajax?action=GetTaskCount',
        'UpdatePanel' => '/ajax?action=UpdatePanel',
        'GetConfig' => '/config?action=get_config',
    ];

    public function getSystemTotal(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetSystemTotal'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getDiskInfo(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetDiskInfo'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getNetWork(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetNetWork'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function GetConfig(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetConfig'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getTaskCount(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetTaskCount'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function checkUpdate(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('UpdatePanel'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}