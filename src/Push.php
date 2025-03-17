<?php
namespace Userlist;

use \Userlist\Push\Relation;
use \Userlist\Push\User;
use \Userlist\Push\Company;
use \Userlist\Push\Relationship;
use \Userlist\Push\Event;
use \Userlist\Push\Message;

class Push
{
    public $users;
    public $companies;
    public $events;
    public $relationships;
    public $messages;

    public function __construct($config = null)
    {
        $config = new Config($config);
        $client = new Push\Client($config);

        $this->users = new Relation(User::class, $client);
        $this->companies = new Relation(Company::class, $client);
        $this->relationships = new Relation(Relationship::class, $client);
        $this->events = new Relation(Event::class, $client);
        $this->messages = new Relation(Message::class, $client);
    }

    public function user($payload = [])
    {
        $this->users->push($payload);
    }

    public function company($payload = [])
    {
        $this->companies->push($payload);
    }

    public function relationship($payload = [])
    {
        $this->relationships->push($payload);
    }

    public function event($payload = [])
    {
        $this->events->push($payload);
    }

    public function message($payload = [])
    {
        $this->messages->push($payload);
    }
}
