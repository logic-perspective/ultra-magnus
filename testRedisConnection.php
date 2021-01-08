<?php
echo 'running script';
$redis = new Redis();
//Connecting to Redis
$redis->connect('tls://sendmarc-tools.redis.cache.windows.net', 6380);
$redis->auth('Hba2XZiJdM+T8Fj+wyxC5vroIqwcPJol4nln9VFKgb0=');
try {
    if ($redis->ping('')) {
        echo "PONGn";
    }
} catch (RedisException $e) {
    echo $e;
}

