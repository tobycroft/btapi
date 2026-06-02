<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use Exception;

final class Ftp extends Base
{
    protected array $config = [
        'List' => '/data?action=getData&table=ftps',
        'SetUserPassword' => '/ftp?action=SetUserPassword',
        'SetStatus' => '/ftp?action=SetStatus',
        'DeleteUser' => '/ftp?action=DeleteUser',
    ];

    public function getList(string $search = '', int $page = 1, int $limit = 20): mixed
    {
        $data = [
            'search' => $search,
            'limit' => $limit,
            'p' => $page,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('List'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setUserPwd(int $id, string $username, string $password): mixed
    {
        $data = [
            'id' => $id,
            'ftp_username' => $username,
            'new_password' => $password,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('SetUserPassword'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setStatus(int $id, string $username, int $status): mixed
    {
        $data = [
            'id' => $id,
            'username' => $username,
            'status' => $status,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('SetStatus'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete(int $id, string $username): mixed
    {
        $data = [
            'id' => $id,
            'username' => $username,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('DeleteUser'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}