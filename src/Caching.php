<?php

namespace Fernandod1\RedisCaching;

require '../vendor/autoload.php';
use Predis\Client;

/**
 * Caching class using Redis PHP
 */
class Caching {
    private $redis;

    /**
     * Constructor
     * 
     * Constructor recieving parameters to connect to Redir server
     *
     * @param array $redisConnParams
     */
    public function __construct(array $redisConnParams) {
        $this->redis = new Client($redisConnParams);
    }

    /**
     * getData
     * 
     * Gets data from the cache based on key name.
     *
     * @param string $key
     * @return mixed|null
     */
    public function getData(string $key) {
        $data = $this->redis->get($key);
        if ($data !== null)
            return unserialize($data);
        return null;
    }

    /**
     * setData
     * 
     * Store data in the cacke with key mane and TTL of X seconds
     *
     * @param string $key
     * @param mixed $data
     * @param integer $ttl
     * @return void
     */
    public function setData(string $key, mixed $data, int $ttl = 3600) {
        // Serialize the data before storing
        $data = serialize($data);
        $this->redis->setex($key, $ttl, $data);
    }

    /**
     * deleteData
     * 
     * Delete key/data from the cache
     *
     * @param string $key
     * @return void
     */
    public function deleteData(string $key) {
        $this->redis->del($key);
    }
}