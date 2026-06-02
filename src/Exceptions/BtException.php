<?php

declare(strict_types=1);

namespace tobycroft\Bt\Exceptions;

use Exception;

final class BtException extends Exception
{
    protected static array $errors = [
        '101' => '请设置宝塔/aaPanel请求地址',
        '102' => '请设置宝塔/aaPanel请求密钥',
    ];

    public function __construct(int $code)
    {
        parent::__construct(self::$errors[(string)$code] ?? "Unknown error code: $code", $code);
    }
}