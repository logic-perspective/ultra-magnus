<?php


namespace App\Http\Helpers;


use Illuminate\Http\JsonResponse;

class LookupResponse
{
    /**
     * @param int $code
     * @param string $message
     * @param string $host
     * @param mixed $data
     * @return JsonResponse
     */
    public static function error(int $code, string $message, string $host = '', $data = null): JsonResponse
    {
        return response()
            ->json([
                'error' => $code,
                'message' => $message,
                'host' => $host,
                'data' => $data],
                $code);
    }

    public static function success($data): JsonResponse
    {
        return response()->json($data);
    }
}
