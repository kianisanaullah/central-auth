<?php

namespace Kiani\CentralAuth\Support;

use Illuminate\Support\Facades\Cache;

class CentralAuth
{
    public static function enabled(): bool
    {
        return (bool) config('central-auth.enabled', true);
    }

    public static function isSharedDb(): bool
    {
        return (bool) config('central-auth.shared_db', true);
    }

    public static function connectionName(): ?string
    {
        if (!self::enabled()) return null;
        if (!self::isSharedDb()) return null;

        return config('central-auth.connection');
    }

    public static function table(string $key): string
    {
        return (string) config("central-auth.tables.$key", $key);
    }

    public static function pivotKey(string $key): string
    {
        return (string) config("central-auth.pivot_keys.$key", $key);
    }

    public static function roleColumn(): string
    {
        return (string) config('central-auth.role_column', 'name');
    }

    public static function cacheEnabled(): bool
    {
        return (bool) config('central-auth.cache.enabled', false);
    }

    public static function cacheTtl(): int
    {
        return (int) config('central-auth.cache.ttl', 300);
    }

    public static function cachePrefix(): string
    {
        return (string) config('central-auth.cache.prefix', 'central_auth');
    }

    public static function cacheKey(string $suffix): string
    {
        return self::cachePrefix() . ':' . $suffix;
    }

    public static function remember(string $suffix, \Closure $callback)
    {
        if (!self::cacheEnabled()) {
            return $callback();
        }

        return Cache::remember(self::cacheKey($suffix), self::cacheTtl(), $callback);
    }
}
