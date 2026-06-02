<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use Exception;

final class Database extends Base
{
    protected array $config = [
        'List' => '/data?action=getData&table=databases',
        'Add' => '/database?action=AddDatabase',
        'setPassword' => '/database?action=ResDatabasePassword',
        'Delete' => '/database?action=DeleteDatabase',
        'Backup' => '/data?action=getData&table=backup',
        'ToBackup' => '/database?action=ToBackup',
        'DelBackup' => '/database?action=DelBackup',
        'InputSql' => '/database?action=InputSql',
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

    public function add(string $name, string $username, string $password, string $ps, string $access = '127.0.0.1', string $address = '127.0.0.1', string $coding = 'utf8', string $type = 'MySQL'): mixed
    {
        $data = [
            'name' => $name,
            'codeing' => $coding,
            'db_user' => $username,
            'password' => $password,
            'dtype' => $type,
            'dataAccess' => $access,
            'address' => $address,
            'ps' => $ps,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('Add'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setPwd(int|string $id, string $name, string $password): mixed
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'password' => $password,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('setPassword'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete(int|string $id, string $name): mixed
    {
        $data = [
            'id' => $id,
            'name' => $name,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('Delete'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getBackups(string $search = '', int $page = 1, int $limit = 5): mixed
    {
        $data = [
            'type' => 1,
            'limit' => $limit,
            'p' => $page,
            'search' => $search,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('Backup'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function backupAdd(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('ToBackup'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function backupDel(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('DelBackup'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function inputSql(string $filePath, string $databaseName): mixed
    {
        $data = [
            'file' => $filePath,
            'name' => $databaseName,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('InputSql'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}