<?php
namespace Userlist;

class Token
{
    private $config;
    private $payload;
    private $header;
    private $key;

    public static function generate($identifier, $config = [])
    {
        $config = new Config($config);

        $pushKey = $config->get('push_key');
        $pushId = $config->get('push_id');
        $tokenLifetime = $config->get('token_lifetime');

        if ($identifier == null) {
            throw new \InvalidArgumentException('Missing required identifier');
        }

        if ($pushKey == null || $pushId == null) {
            return null;
        }

        $now = time();

        $header = [
            'kid' => $pushId,
            'alg' => 'HS256'
        ];

        $payload = [
            'sub' => $identifier,
            'exp' => $now + $tokenLifetime,
            'iat' => $now
        ];

        return new self($payload, $header, $pushKey);
    }

    public function __construct($payload = [], $header = [], $key = null)
    {
        $this->payload = $payload;
        $this->header = $header;
        $this->key = $key;
    }

    public function __toString()
    {
        $encodedHeader = $this->base64($this->json($this->header));
        $encodedPayload = $this->base64($this->json($this->payload));
        $encodedHeaderAndPayload = "$encodedHeader.$encodedPayload";

        $encodedSignature = $this->base64($this->hmac256($encodedHeaderAndPayload, $this->key));

        return "$encodedHeader.$encodedPayload.$encodedSignature";
    }

    private function base64($string)
    {
        return rtrim(strtr(base64_encode($string), '+/', '-_'), '=');
    }

    private function json($data)
    {
        return json_encode($data);
    }

    private function hmac256($data, $key)
    {
        return hash_hmac('SHA256', $data, $key, true);
    }
}
