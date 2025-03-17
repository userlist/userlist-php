<?php
namespace Userlist\Push;

class Relation
{
    private $resourceType;

    public function __construct($resource, $client)
    {
        $this->resourceType = $resource;
        $this->client = $client;
    }

    public function push($payload = [])
    {
        $resource = $this->build($payload);
        $this->client->post($resource::$url, $resource);
    }

    public function create($payload = [])
    {
        $this->push($payload);
    }

    public function delete($payload = [])
    {
        $resource = $this->build($payload);
        $this->client->delete($resource::$url, $resource);
    }

    public function update($payload = [])
    {
        $this->push($payload);
    }

    private function build($payload = [])
    {
        $resourceType = $this->resourceType;
        return new $resourceType($payload);
    }
}
