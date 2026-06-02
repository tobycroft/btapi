<?php

declare(strict_types=1);

namespace tobycroft\Bt;

use Exception;

final class Site extends Base
{
    protected array $config = [
        'Websites' => '/data?action=getData&table=sites',
        'WebTypes' => '/site?action=get_site_types',
        'GetPHPVersion' => '/site?action=GetPHPVersion',
        'GetSitePHPVersion' => '/site?action=GetSitePHPVersion',
        'SetPHPVersion' => '/site?action=SetPHPVersion',
        'AddSite' => '/site?action=AddSite',
        'DeleteSite' => '/site?action=DeleteSite',
        'StopSite' => '/site?action=SiteStop',
        'StartSite' => '/site?action=SiteStart',
        'SetExpired' => '/site?action=SetEdate',
        'SetPs' => '/data?action=setPs&table=sites',
        'WebBackups' => '/data?action=getData&table=backup',
        'ToBackup' => '/site?action=ToBackup',
        'DelBackup' => '/site?action=DelBackup',
        'DomainList' => '/data?action=getData&table=domain',
        'AddDomain' => '/site?action=AddDomain',
        'DelDomain' => '/site?action=DelDomain',
        'GetRewriteList' => '/site?action=GetRewriteList',
        'GetSiteRewrite' => '/site?action=GetSiteRewrite',
        'SetSiteRewrite' => '/site?action=SetSiteRewrite',
        'WebPath' => '/data?action=getKey&table=sites&key=path',
        'SetHasPwd' => '/site?action=SetHasPwd',
        'CloseHasPwd' => '/site?action=CloseHasPwd',
        'GetDirUserINI' => '/site?action=GetDirUserINI',
        'GetDirBinding' => '/site?action=GetDirBinding',
        'AddDirBinding' => '/site?action=AddDirBinding',
        'DelDirBinding' => '/site?action=DelDirBinding',
        'GetDirRewrite' => '/site?action=GetDirRewrite',
        'SetSiteRunPath' => '/site?action=SetSiteRunPath',
        'GetSiteLogs' => '/site?action=GetSiteLogs',
        'GetSecurity' => '/site?action=GetSecurity',
        'SetSecurity' => '/site?action=SetSecurity',
        'SetSecurityL' => '/site?action=SetSecurity',
        'GetSSL' => '/site?action=GetSSL',
        'get_iis_ssl_bydomain' => '/site?action=get_iis_ssl_bydomain',
        'HttpToHttps' => '/site?action=HttpToHttps',
        'CloseToHttps' => '/site?action=CloseToHttps',
        'SetSSL' => '/site?action=SetSSL',
        'RenewCert' => '/acme?action=renew_cert',
        'applycertapi' => '/acme?action=apply_cert_api',
        'CloseSSLConf' => '/site?action=CloseSSLConf',
        'GetIndex' => '/site?action=GetIndex',
        'SetIndex' => '/site?action=SetIndex',
        'GetLimitNet' => '/site?action=GetLimitNet',
        'SetLimitNet' => '/site?action=SetLimitNet',
        'CloseLimitNet' => '/site?action=CloseLimitNet',
        'Get301Status' => '/site?action=Get301Status',
        'Set301Status' => '/site?action=Set301Status',
        'GetProxyList' => '/site?action=GetProxyList',
        'CreateProxy' => '/site?action=CreateProxy',
        'ModifyProxy' => '/site?action=ModifyProxy',
        'GetFileBody' => '/files?action=GetFileBody',
        'SaveFileBody' => '/files?action=SaveFileBody',
        'GetRedirectList' => '/site?action=GetRedirectList',
        'ModifyRedirect' => '/site?action=ModifyRedirect',
        'CreateRedirect' => '/site?action=CreateRedirect',
        'DeleteRedirect' => '/site?action=DeleteRedirect',
        'GetRedirectFile' => '/site?action=GetRedirectFile',
        'SaveRedirectFile' => '/site?action=SaveRedirectFile',
    ];

    public function getList(string $search = '', int $page = 1, int $limit = 200, string $type = '-1', string $order = 'id desc'): mixed
    {
        $data = [
            'search' => $search,
            'p' => $page,
            'limit' => $limit,
            'type' => $type,
            'order' => $order,
            'table' => 'sites',
        ];
        try {
            return $this->httpPostCookie($this->getUrl('Websites'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getSiteTypes(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('WebTypes'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getPHPVersion(): mixed
    {
        try {
            return $this->httpPostCookie($this->getUrl('GetPHPVersion'));
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getSitePHPVersion(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetSitePHPVersion'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function SetPHPVersion(string $siteName, string $version): mixed
    {
        $data = ['siteName' => $siteName, 'version' => $version];
        try {
            return $this->httpPostCookie($this->getUrl('SetPHPVersion'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function add(string $webName, string $path, string $ps = '', string $version = '', string $sql = 'MySQL', string $coding = 'utf8', string $dataUser = '', string $dataPassword = '', bool $ftp = false, string $ftpUsername = '', string $ftpPassword = '', int $type_id = 0, string $port = '80'): mixed
    {
        $data = [
            'webname' => json_encode([
                'domain' => $webName,
                'domainlist' => [],
                'count' => 0,
            ]),
            'path' => $path,
            'type_id' => $type_id,
            'type' => 'PHP',
            'version' => $version,
            'port' => $port,
            'ps' => $ps,
            'ftp' => $ftp,
            'ftp_username' => $ftpUsername,
            'ftp_password' => $ftpPassword,
            'sql' => $sql,
            'codeing' => $coding,
            'datauser' => $dataUser,
            'datapassword' => $dataPassword,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('AddSite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete(int $id, string $webname, int $ftp = 1, int $database = 1, int $path = 1): mixed
    {
        $data = compact('id', 'webname');
        if ($ftp >= 1) $data['ftp'] = 1;
        if ($database >= 1) $data['database'] = 1;
        if ($path >= 1) $data['path'] = 1;
        try {
            return $this->httpPostCookie($this->getUrl('DeleteSite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function stop(int $id, string $name): mixed
    {
        $data = compact('id', 'name');
        try {
            return $this->httpPostCookie($this->getUrl('StopSite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function start(int $id, string $name): mixed
    {
        $data = compact('id', 'name');
        try {
            return $this->httpPostCookie($this->getUrl('StartSite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setExpired(int $id, string $expired = '0000-00-00'): mixed
    {
        $data = ['id' => $id, 'edate' => $expired];
        try {
            return $this->httpPostCookie($this->getUrl('SetExpired'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setRemark(int $id, string $remark): mixed
    {
        $data = ['id' => $id, 'ps' => $remark];
        try {
            return $this->httpPostCookie($this->getUrl('SetPs'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getBackupList(int $id, int $page = 1, int $limit = 5): mixed
    {
        $data = ['type' => 0, 'limit' => $limit, 'p' => $page, 'search' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('WebBackups'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function addBackup(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('ToBackup'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function deleteBackup(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('DelBackup'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getDomainList(int $id): mixed
    {
        $data = ['search' => $id, 'list' => true];
        try {
            return $this->httpPostCookie($this->getUrl('DomainList'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function addDomain(int $id, string $name, string $domains): mixed
    {
        $data = ['id' => $id, 'webname' => $name, 'domain' => $domains];
        try {
            return $this->httpPostCookie($this->getUrl('AddDomain'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function deleteDomain(int $id, string $name, string $domain, int $port = 80): mixed
    {
        $data = ['id' => $id, 'webname' => $name, 'domain' => $domain, 'port' => $port];
        try {
            return $this->httpPostCookie($this->getUrl('DelDomain'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getRewriteList(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetRewriteList'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function GetSiteRewrite(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetSiteRewrite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function SetSiteRewrite(string $siteName, string $content): mixed
    {
        $data = ['siteName' => $siteName, 'data' => $content];
        try {
            return $this->httpPostCookie($this->getUrl('SetSiteRewrite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function SetSiteRunPath(int $id, string $runPath): mixed
    {
        $data = ['id' => $id, 'runPath' => $runPath];
        try {
            return $this->httpPostCookie($this->getUrl('SetSiteRunPath'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getRoot(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('WebPath'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setHasPwd(int $id, string $username, string $password): mixed
    {
        $data = ['id' => $id, 'username' => $username, 'password' => $password];
        try {
            return $this->httpPostCookie($this->getUrl('SetHasPwd'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function closeHasPwd(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('CloseHasPwd'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getSiteLogs(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetSiteLogs'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getSecurity(int $id, string $name): mixed
    {
        $data = ['id' => $id, 'name' => $name];
        try {
            return $this->httpPostCookie($this->getUrl('GetSecurity'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setSecurity(int $id, string $name, string $fix, string $domains, int $status, int $return_rule, int $none): mixed
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'fix' => $fix,
            'domains' => $domains,
            'status' => $status,
            'return_rule' => $return_rule,
            'none' => $none,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('SetSecurity'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function SetSecurityL(int $id, string $name, string $fix, string $domains, int $status, int $return_rule, int $nonestatus): mixed
    {
        $data = [
            'id' => $id,
            'name' => $name,
            'fix' => $fix,
            'domains' => $domains,
            'status' => $status,
            'return_rule' => $return_rule,
            'http_status' => $nonestatus,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('SetSecurityL'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getDirUserINI(int $id, string $path): mixed
    {
        $data = ['id' => $id, 'path' => $path];
        try {
            return $this->httpPostCookie($this->getUrl('GetDirUserINI'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function HttpToHttps(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('HttpToHttps'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function closeToHttps(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('CloseToHttps'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setSSL(int $type, string $siteName, string $key, string $csr): mixed
    {
        $data = ['type' => $type, 'siteName' => $siteName, 'key' => $key, 'csr' => $csr];
        try {
            return $this->httpPostCookie($this->getUrl('SetSSL'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function renewCert(string $index): mixed
    {
        $data = ['index' => $index];
        try {
            return $this->httpPostCookie($this->getUrl('RenewCert'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function closeSSLConf(int $updateOf, string $siteName): mixed
    {
        $data = ['updateOf' => $updateOf, 'siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('CloseSSLConf'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getSSL(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetSSL'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function get_iis_ssl_bydomain(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('get_iis_ssl_bydomain'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function applycertapi(int $id, string $domain): mixed
    {
        $data = [
            'domains' => $domain,
            'auth_type' => 'http',
            'auth_to' => $id,
            'auto_wildcard' => 0,
            'id' => $id,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('applycertapi'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function GetIndex(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('GetIndex'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function SetIndex(int $id, string $index): mixed
    {
        $data = ['id' => $id, 'Index' => $index];
        try {
            return $this->httpPostCookie($this->getUrl('SetIndex'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getLimitNet(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('GetLimitNet'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function setLimitNet(int $id, string $perserver, string $perip, string $limit_rate): mixed
    {
        $data = ['id' => $id, 'perserver' => $perserver, 'perip' => $perip, 'limit_rate' => $limit_rate];
        try {
            return $this->httpPostCookie($this->getUrl('SetLimitNet'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function closeLimitNet(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('CloseLimitNet'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function get301Status(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('Get301Status'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function set301Status(string $siteName, string $toDomain, string $srcDomain, int $type): mixed
    {
        $data = ['siteName' => $siteName, 'toDomain' => $toDomain, 'srcDomain' => $srcDomain, 'type' => $type];
        try {
            return $this->httpPostCookie($this->getUrl('Set301Status'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function GetRedirectList(string $siteName): mixed
    {
        $data = ['sitename' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetRedirectList'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function ModifyRedirect(string $sitename, string $redirectname, string $tourl, array|string $redirectdomain, string $redirectpath, int $redirecttype, int $type, int $domainorpath, int $holdpath): mixed
    {
        $data = [
            'sitename' => $sitename,
            'redirectname' => $redirectname,
            'tourl' => $tourl,
            'redirectdomain' => is_array($redirectdomain) ? json_encode($redirectdomain) : $redirectdomain,
            'redirectpath' => $redirectpath,
            'redirecttype' => $redirecttype,
            'type' => $type,
            'domainorpath' => $domainorpath,
            'holdpath' => $holdpath,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('ModifyRedirect'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function CreateRedirect(string $sitename, string $redirectname, string $tourl, array|string $redirectdomain, string $redirectpath, int $redirecttype, int $type, int $domainorpath, int $holdpath): mixed
    {
        $data = [
            'sitename' => $sitename,
            'redirectname' => $redirectname,
            'tourl' => $tourl,
            'redirectdomain' => is_array($redirectdomain) ? json_encode($redirectdomain) : $redirectdomain,
            'redirectpath' => $redirectpath,
            'redirecttype' => $redirecttype,
            'type' => $type,
            'domainorpath' => $domainorpath,
            'holdpath' => $holdpath,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('CreateRedirect'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function DeleteRedirect(string $sitename, string $redirectname): mixed
    {
        $data = ['sitename' => $sitename, 'redirectname' => $redirectname];
        try {
            return $this->httpPostCookie($this->getUrl('DeleteRedirect'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function GetRedirectFile(string $sitename, string $redirectname, string $webserver = 'nginx'): mixed
    {
        $data = ['sitename' => $sitename, 'redirectname' => $redirectname, 'webserver' => $webserver];
        try {
            return $this->httpPostCookie($this->getUrl('GetRedirectFile'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function SaveRedirectFile(string $path, string $datas, string $encoding = ''): mixed
    {
        $data = ['path' => $path, 'data' => $datas, 'encoding' => $encoding ?: 'utf-8'];
        try {
            return $this->httpPostCookie($this->getUrl('SaveRedirectFile'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getProxyList(string $siteName): mixed
    {
        $data = ['siteName' => $siteName];
        try {
            return $this->httpPostCookie($this->getUrl('GetProxyList'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function createProxy(string $siteName, string $proxyDomain, string $proxyUrl, int $status = 1, string $proxyType = 'http', int $ws = 0, int $buffer = 1): mixed
    {
        $data = [
            'siteName' => $siteName,
            'proxy_domain' => $proxyDomain,
            'proxy_url' => $proxyUrl,
            'status' => $status,
            'proxy_type' => $proxyType,
            'ws' => $ws,
            'buffer' => $buffer,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('CreateProxy'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function modifyProxy(string $siteName, string $proxyDomain, string $proxyUrl, int $status = 1, string $proxyType = 'http', int $ws = 0, int $buffer = 1): mixed
    {
        $data = [
            'siteName' => $siteName,
            'proxy_domain' => $proxyDomain,
            'proxy_url' => $proxyUrl,
            'status' => $status,
            'proxy_type' => $proxyType,
            'ws' => $ws,
            'buffer' => $buffer,
        ];
        try {
            return $this->httpPostCookie($this->getUrl('ModifyProxy'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getFileBody(string $path): mixed
    {
        $data = ['file' => $path];
        try {
            return $this->httpPostCookie($this->getUrl('GetFileBody'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function saveFileBody(string $path, string $content): mixed
    {
        $data = ['file' => $path, 'data' => $content];
        try {
            return $this->httpPostCookie($this->getUrl('SaveFileBody'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getDirBinding(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('GetDirBinding'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function addDirBinding(int $id, string $domain, string $path): mixed
    {
        $data = ['id' => $id, 'domain' => $domain, 'path' => $path];
        try {
            return $this->httpPostCookie($this->getUrl('AddDirBinding'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delDirBinding(int $id, string $domain): mixed
    {
        $data = ['id' => $id, 'domain' => $domain];
        try {
            return $this->httpPostCookie($this->getUrl('DelDirBinding'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function getDirRewrite(int $id): mixed
    {
        $data = ['id' => $id];
        try {
            return $this->httpPostCookie($this->getUrl('GetDirRewrite'), $data);
        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}