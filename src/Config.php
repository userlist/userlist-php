<?php
namespace Userlist;

class Config
{
    const DEFAULT_CONFIGURATION = [
        'push_key' => null,
        'push_id' => null,
        'push_endpoint' => 'https://push.userlist.com/',
        'token_lifetime' => 300,
        'guzzle' => []
    ];

    protected $config;

    public function __construct($configFromConstructor = [])
    {
        $configFromConstructor ??= [];

        if ($configFromConstructor instanceof self) {
            $configFromConstructor = $configFromConstructor->config;
        }

        $this->config = array_merge(
            $this->defaultConfig(),
            $configFromConstructor,
            $this->configFromEnvironment()
        );
    }

    public function get($key)
    {
        return $this->config[$key];
    }

    public function set($key, $value)
    {
        $this->config[$key] = $value;
    }

    private function defaultConfig()
    {
        return self::DEFAULT_CONFIGURATION;
    }

    private function configFromEnvironment()
    {
        $config = [];
        $keys = array_keys($this->defaultConfig());

        foreach ($keys as $key) {
            $value = getenv("USERLIST_" . strtoupper($key), true);

            if ($value) {
                $config[$key] = $value;
            }
        }

        return $config;
    }
}
