<?php
/**
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.08
 * @link      https://fabrika-klientov.ua
 * */

namespace Hedera\Services;

use Closure;
use Hedera\Models\SharedAmocrm;
use Hedera\Models\SharedIntegrations;
use Hedera\Models\SharedOauth;

class AnemoneOAuth2Service
{
    /**
     * @var static $context
     * */
    private static $context;
    /**
     * @var \Illuminate\Support\Collection $collect
     * */
    protected static $collect;
    /**
     * @var \Illuminate\Support\Collection $listeners
     * */
    protected $listeners;

    /**
     * @return void
     * */
    public function __construct()
    {
        static::$context = $this;
        static::$collect = collect();
        $this->listeners = collect();
    }

    /**
     * @param SharedAmocrm $sharedAmocrm
     * @param SharedOauth $sharedOauth
     * @param SharedIntegrations $sharedIntegrations
     * @return $this
     * */
    public function add(
        SharedAmocrm $sharedAmocrm,
        SharedOauth $sharedOauth,
        SharedIntegrations $sharedIntegrations
    ) {
        static::$collect->push(
            [
                'amocrm' => $sharedAmocrm,
                'oauth' => $sharedOauth,
                'integration' => $sharedIntegrations,
            ]
        );

        return $this;
    }

    /**
     * @param Closure|string $amoDomain
     * @return void
     * */
    public function remove($amoDomain): void
    {
        static::$collect = static::$collect
            ->filter(
                $amoDomain instanceof Closure ? $amoDomain : function ($item) use ($amoDomain) {
                    return $item['amocrm']->getDomain() != $amoDomain;
                }
            );
    }

    /**
     * @return \Illuminate\Support\Collection
     * */
    public function items()
    {
        return static::$collect;
    }

    /**
     * @param Closure|string $amoDomain
     * @return \Illuminate\Support\Collection
     * */
    public function find($amoDomain)
    {
        return static::$collect->filter(
            $amoDomain instanceof Closure ? $amoDomain : function ($item) use ($amoDomain) {
                return $item['amocrm']->getDomain() == $amoDomain;
            }
        );
    }

    /**
     * in closure set new SharedOauth instance
     * @param Closure $closure
     * @return void
     */
    public function addListener(Closure $closure): void
    {
        $this->listeners->add($closure);
    }

    /**
     * @param SharedOauth $oauth
     * @return void
     */
    public function event(SharedOauth $oauth): void
    {
        $this->listeners->each(
            function (Closure $closure) use ($oauth) {
                $closure($oauth);
            }
        );
    }

    /**
     * @return static
     * */
    public static function context()
    {
        return static::$context;
    }
}
