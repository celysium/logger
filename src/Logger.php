<?php

namespace Celysium\Logger;

use Celysium\Request\Exceptions\BadRequestHttpException;
use Celysium\Request\Facades\RequestBuilder;
use Illuminate\Support\Collection;

trait Logger
{
    /**
     * @return Collection
     * @throws BadRequestHttpException
     */
    public function logs(): Collection
    {
        $response = RequestBuilder::request()
            ->post('/services/log/api/internal/fetch', [
                'model_id'   => $this->id,
                'model_type' => self::class
            ])->onError(fn($response) => throw new BadRequestHttpException($response));
        return collect($response);
    }
}
