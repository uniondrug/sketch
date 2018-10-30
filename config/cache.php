<?php
/**
 * 缓存的配置文件。
 * lifetime: 缓存有效期，也可以在使用缓存的时候设置：$di->getCache(80)。都不设置默认3600。
 * adapter: 缓存服务的适配器，可选的包括：file, redis, memory, xcache, apc, apcu, memcache, libmemcached
 * options: 缓存服务的配置参数，根据适配器的不同，参数也不一样，参考如下：
 * <code>
 *        // Use file adapter
 *        'adapter'  => 'file',
 *        'options'  => [
 *            'prefix'   => '_key',
 *            'cacheDir' => __DIR__ . '/../tmp/cache',
 *        ],
 *        // Use Redis
 *        'adapter'  => 'redis',
 *        'options'  => [
 *            'prefix' => '', // Key的前缀
 *            'host' => 'localhost',
 *            'port' => 6379,
 *            'auth' => 'foobared',
 *            'persistent' => false, // 持久化连接，默认不持久化
 *            'index' => 0,
 *            'statsKey' => '', //Used to tracking of cached keys.
 *        ],
 *        // Use libmemcached
 *        'adapter'  => 'libmemcached',
 *        'options'  => [
 *            'persistent_id' => '',
 *            'prefix' => '',
 *            'statsKey' => '', //Used to tracking of cached keys.
 *            'client' => [
 *                \Memcached::OPT_HASH       => \Memcached::HASH_MD5,
 *                \Memcached::OPT_PREFIX_KEY => "prefix.",
 *            ],
 *            'servers'] => [
 *                [
 *                    'host' => '127.0.0.1',
 *                    'port' => 11211,
 *                    'weight' => 1',
 *                ],
 *            ],
 *        ],
 *        // Use memcache
 *        'adapter'  => 'memcache',
 *        'options'  => [
 *            'prefix' => '', // Key的前缀
 *            'host' => 'localhost',
 *            'port' => 11211,
 *            'persistent' => false, // 持久化连接，默认不持久化
 *            'statsKey' => '', //Used to tracking of cached keys.
 *        ],
 *        // Use others: apc / apcu / xcache / memory
 *        'adapter'  => 'apc',
 *        'options'  => [
 *            'prefix' => '', // Key的前缀
 *        ],
 * </code>
 */
return [
    'default' => [
        'lifetime' => 3600,
        'adapter' => 'memory',
        'options' => [
            'prefix' => '_key_',
        ]
    ]
];