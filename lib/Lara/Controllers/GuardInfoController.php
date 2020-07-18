<?php
/**
 *
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.07.08
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Lara\Controllers;

use Hedera\Models\SharedPeriods;
use Hedera\Services\GuardService;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class GuardInfoController
{
    protected static $percent = 0.9;

    /**
     * @param Request $request
     * @param string $token
     * @return mixed
     */
    public function index(Request $request, string $token)
    {
        $guardService = new GuardService($token);
        $apiKey = $guardService->getSmartService()->getSharedApiKey();

        if (empty($apiKey)) {
            return self::resolve('error', 'api_key_invalid');
        }

        if (!$apiKey->isActive()) {
            return self::resolve('error', 'api_key_not_active');
        }

        $sharedCS = $guardService->getSmartService()->getSharedCustomersServices();

        if (empty($sharedCS)) {
            return self::resolve('error', 'customers_service_not_exist');
        }

        if (Str::upper($sharedCS->getCode()) != Str::upper(env('APP_NAME', ''))) {
            return self::resolve('error', 'customers_service_code_invalid');
        }

        $periods = $guardService->getSmartService()->getSharedPeriods();

        if (empty($periods) || $periods->isEmpty()) {
            return self::resolve('error', 'periods_not_exist');
        }

        /**
         * @var SharedPeriods $last
         * */
        $last = collect($periods)
            ->reduce(
                function (?SharedPeriods $result, SharedPeriods $item) {
                    return (empty($result) || strtotime($result->getDateEnd()) < strtotime($item->getDateEnd()))
                        ? $item
                        : $result;
                },
                null
            );
        $currentTime = time();

        if (strtotime($last->getDateEnd()) < $currentTime) {
            return self::resolve('error', 'periods_refused', ['period_end' => $last->getDateEnd()]);
        }

        $start = strtotime($last->getDateStart());
        $end = strtotime($last->getDateEnd());
        $deltaPeriod = $end - $start;
        $deltaNow = $currentTime - $start;

        if ($deltaNow / $deltaPeriod > static::$percent) {
            return self::resolve('warning', 'periods_before_refused', ['period_end' => $last->getDateEnd()]);
        }

        return self::resolve(
            'success',
            'ok',
            ['period_start' => $last->getDateStart(), 'period_end' => $last->getDateEnd()]
        );
    }

    /**
     *
     * @param string $type
     * @param string $code
     * @param array $additional
     * @return mixed
     */
    public function resolve(string $type, string $code, array $additional = [])
    {
        return response()->json(
            [
                'type' => $type,
                'code' => $code,
                'additional' => $additional,
            ]
        );
    }
}
