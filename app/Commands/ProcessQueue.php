<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Services;
use App\Classes\RedisQueue;
use App\Classes\Test;

class ProcessQueue extends BaseCommand
{
    /**
     * The Command's Group
     *
    //  * @var string
    //  */
    // protected $group = 'CodeIgniter';

    protected $group       = 'Custom';
    protected $name        = 'queue:process';
    protected $description = 'Process items from a Redis queue and execute a function';

    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $queue = new RedisQueue();
        // $data = [Test::class, 'sayHello', ['Mohammad']];
        // $data2 = [Test::class, 'sayHello', ['Qusai']];
        // $data3 = [Test::class, 'sayHello', ['Tareq']];
        // $data4 = [Test::class, 'sayHello', ['Mazen']];
        // $data5 = [Test::class, 'sayHello', ['Faisal']];
        // $queue->enqueue(json_encode($data, JSON_UNESCAPED_UNICODE));
        // $queue->enqueue(json_encode($data2, JSON_UNESCAPED_UNICODE));
        // $queue->enqueue(json_encode($data3, JSON_UNESCAPED_UNICODE));
        // $queue->enqueue(json_encode($data4, JSON_UNESCAPED_UNICODE));
        // $queue->enqueue(json_encode($data5, JSON_UNESCAPED_UNICODE));
        
        while ($message = $queue->dequeue()) {
            
            if ($message === false) break;
            $message = json_decode($message, true);
            [$class, $function, $arguments] = $message;
            $classObject = new $class();
            $classObject->$function($arguments[0]);
            
            // call_user_func_array()
            echo PHP_EOL;
        }
    }
}
