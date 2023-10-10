<?php

namespace App\Classes;

use Config\Services;

class RedisQueue{

    private $redis;
    private $queueName = 'queue';


    public function __construct()
    {
        /** @var redishandler $cache */
        $cache = Services::cache();

        $this->redis = $cache->getRedis();
    }


    public function enqueue($message){
        $this->redis->rpush($this->queueName,$message);
    }

    public function dequeue(){
        return $this->redis->lpop($this->queueName);
    }

    public function getSize(){
        return $this->redis->llen($this->queueName);
    }


}