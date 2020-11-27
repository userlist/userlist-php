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
        $this->client->post($resource::$url, $resource->serialize());
    }

    public function create($payload = [])
    {
        $this->push($payload);
    }

    public function delete($payload = [])
    {
        $resource = $this->build($payload);
        $this->client->delete($resource->url());
    }

    private function build($payload = [])
    {
        $resourceType = $this->resourceType;
        return new $resourceType($payload);
    }
}