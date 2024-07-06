<?php

namespace Fernandod1\RedisCaching;

require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable('../');
$dotenv->safeLoad();

$redisConnParams = [
    'scheme' => $_ENV["REDIS_SCHEME"],
    'host'   => $_ENV["REDIS_HOST"],
    'port'   => $_ENV["REDIS_PORT"]
];

// Initializing the cache
$cache = new Caching($redisConnParams);
// Defining one cache key
$key = 'my_key_name';
// Checking if key is already in the cache
$data = $cache->getData($key);

if ($data === null) {
    // If not in the cache, simulate any random query
    $data = 'Example of data stored in database.';
    // Storing data in the cache for X seconds
    $cache->setData($key, $data, 30);
    echo "New data storing in the cache.\n";
} else echo "Old data recieved from the cache.\n";

echo "Cached data: $data";

// $cache->deleteData($key); // Method to delete a key/data from cache
