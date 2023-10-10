<?php
namespace App\Classes;

use CodeIgniter\Cache\Handlers\RedisHandler as HandlersRedisHandler;

 class redishandler extends HandlersRedisHandler{

    public function getKeys(){
        return $this->redis->keys('*');
    }

    public function getRedis() {
        return $this->redis;
    }

}