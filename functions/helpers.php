<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

if (!function_exists('jsonResponse')) {
    /**
     * Return a new formatted response from the application.
     *
     * @param int               $status
     * @param array             $headers
     * @param array|string|null $message
     * @param array             $mergeContent
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function jsonResponse(
        int $status = 200,
        array|string|null $message = null,
        array $mergeContent = [],
        array $headers = []
    ): JsonResponse {
        $content = array_filter([
            'success' => $status >= 200 && $status < 300,
            'status' => $status,
            'time' => now(),
            'message' => $message ?: Response::$statusTexts[$status],
        ], fn($value) => !null);

        $content = array_merge($content, $mergeContent);

        return new JsonResponse(
            $content,
            $status,
            $headers,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES
        );
    }
}

if (!function_exists('getDatePrefix')) {
    /**
     * @return string
     */
    function getDatePrefix(): string
    {
        $int = 0;
        $files = glob(database_path('migrations/*'));
        $today = date('Y_m_d_');
        foreach ($files as $file) {
            $file = basename($file);
            if (str_starts_with($file, $today)) {
                $int = (int) substr($file, 11, 6);
            }
        }

        $int = ceil($int / 10) * 10;

        return $today . str_pad($int + 10, 6, 0, STR_PAD_LEFT);
    }
}
