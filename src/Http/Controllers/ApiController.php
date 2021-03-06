<?php

namespace TypiCMS\Modules\Users\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(config('auth.providers.users.model'))
            ->allowedSorts(['first_name', 'last_name', 'email', 'superuser'])
            ->allowedFilters([
                AllowedFilter::custom('first_name,last_name,email', new FilterOr()),
            ])
            ->paginate($request->input('per_page'));

        return $data;
    }

    public function updatePreferences(Request $request): void
    {
        $user = $request->user();
        $user->preferences = array_merge((array) $user->preferences, request()->all());
        $user->save();
    }

    public function destroy($userId): JsonResponse
    {
        $user = app(config('auth.providers.users.model'))->findOrFail($userId);
        $deleted = $user->delete();

        return response()->json([
            'error' => !$deleted,
        ]);
    }
}
