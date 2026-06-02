<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use tobycroft\Bt\Exceptions\BtException;

class Base
{
    protected array $config = [];
    protected string $btPanel = '';
    protected string $btKey = '';
    protected string $cookiePath = '';
    protected string|null $error = null;

    public function __construct(string $panel, string $key, string $cookiePath)
    {
        $this->btPanel = $panel;
        $this->btKey = $key;
        $this->cookiePath = $cookiePath;
    }

    public function panel(string $host): self
    {
        $this->btPanel = $host;
        return $this;
    }

    public function key(string $key): self
    {
        $this->btKey = $key;
        return $this;
    }

    protected function error(string $errorMsg): bool
    {
        $this->error = $errorMsg;
        return false;
    }

    public function getError(): string|null
    {
        return $this->error;
    }

    private function getData(array $data): array
    {
        $time = time();
        return [...$data,
            'request_token' => md5($time . md5($this->btKey)),
            'request_time'  => $time,
        ];
    }

    protected function getUrl(string $key): string
    {
        if (!isset($this->config[$key])) {
            throw new \InvalidArgumentException("Unknown config key: $key");
        }
        return $this->config[$key];
    }

    public function httpPostCookie(string $url, array $data = [], int $timeout = 60): mixed
    {
        if (empty($this->btPanel)) {
            throw new BtException(101);
        }
        if (empty($this->btKey)) {
            throw new BtException(102);
        }

        $cookieFile = join(DIRECTORY_SEPARATOR, [
            $this->cookiePath,
            'bt',
            sha1($this->btPanel) . '.cookie'
        ]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->btPanel . $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getData($data));
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);

        if ($output !== false) {
            if (is_array($output)) {
                return $output;
            }
            return json_decode($output, true);
        }

        throw new \RuntimeException('返回内容解析失败');
    }
}