<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseApiController extends Controller
{
    /**
     * Return a success JSON response.
     */
    protected function success(mixed $data = null, ?string $message = null, int $statusCode = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'data' => $data,
        ];

        if ($message) {
            $response['message'] = $message;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return an error JSON response.
     */
    protected function error(string $message, int $statusCode = 400, array $errors = []): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (! empty($errors)) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Return a paginated JSON response (mobile-friendly).
     */
    protected function paginated(LengthAwarePaginator $paginator, ?string $resourceClass = null): JsonResponse
    {
        $data = $paginator->items();

        if ($resourceClass && class_exists($resourceClass)) {
            $data = $resourceClass::collection($data);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
        ]);
    }

    /**
     * Return a created JSON response.
     */
    protected function created(mixed $data = null, string $message = 'Resource created successfully'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    /**
     * Return a no content response.
     */
    protected function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }

    /**
     * Return a not found response.
     */
    protected function notFound(string $message = 'Resource not found'): JsonResponse
    {
        return $this->error($message, 404);
    }

    /**
     * Return an unauthorized response.
     */
    protected function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->error($message, 401);
    }

    /**
     * Return a forbidden response.
     */
    protected function forbidden(string $message = 'Forbidden'): JsonResponse
    {
        return $this->error($message, 403);
    }
}
