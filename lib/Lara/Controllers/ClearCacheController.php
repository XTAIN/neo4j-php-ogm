<?php
/**
 *
 * @package   Hedera
 * @author    Andrew <3oosor@gmail.com>
 * @copyright 2020 Fabrika-Klientov
 * @version   GIT: 20.11.18
 * @link      https://fabrika-klientov.ua
 */

namespace Hedera\Lara\Controllers;

use Hedera\Services\ConnectorService;
use Hedera\Services\SmartService;
use Illuminate\Support\Facades\Request;

class ClearCacheController
{
    /**
     * @param Request $request
     * @param string $token
     * @return mixed
     */
    public function clearSmart(Request $request, string $token)
    {
        if (empty($token)) {
            return self::resolve('clearSmart', true);
        }

        $connector = new ConnectorService();
        $service = new SmartService($connector->getConnection());
        $service->setIdentifier($token);
        $service->clear();

        return self::resolve('clearSmart', true);
    }

    /**
     * @param string $operation
     * @param mixed $data
     * @return mixed
     */
    protected function resolve(string $operation, $data)
    {
        return response()->json(
            [
                'operation' => $operation,
                'status' => true,
                'data' => $data,
            ]
        );
    }
}
