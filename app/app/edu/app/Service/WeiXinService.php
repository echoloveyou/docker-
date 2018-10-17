<?php
namespace App\Service;

use GuzzleHttp\Client;
class WeiXinService
{
    private $serverUrl;
    private $appId;
    private $appSecret;

    private $config = [
      "code2Session_url" => "sns/jscode2session",
      "grant_type"       => "authorization_code",
    ];

    public function __construct($serverUrl, $appId, $appSecret)
    {
        $this->serverUrl = $serverUrl;
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

     public function getOpenId($code)
    {
        $params = [
            "appid"     => $this->appId,
            "secret"    => $this->appSecret,
            "js_code"   => $code,
            "grant_type"=> $this->grant_type
        ];
        $res = $this->getClient()->request('GET',
            $this->code2Session_url,
            ["query" => $params]);
        if($res->getStatusCode() == 200) {
            $data = $res->getBody();
            return json_decode($data, true);
        }
    }

    public function getClient()
    {
        return new Client([
            "base_uri" => $this->serverUrl,
            "timeout"  => 10,
            "allow_redirects" => false
        ]);
    }

    public function __get($name)
    {
        return $this->config[$name];
    }
}
?>