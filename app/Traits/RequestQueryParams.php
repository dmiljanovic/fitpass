<?php

namespace App\Traits;

/**
 * Trait RouteParameterValidation
 * @package App\Traits
 */
trait RequestQueryParams
{
    private bool $capturedRouteVars = false;

    public function all($keys = null)
    {
        return $this->captureRouteVars(parent::all());
    }

    private function captureRouteVars(array $inputs): mixed
    {
        if ($this->capturedRouteVars) {
            return $inputs;
        }

        $inputs += $this->route()?->parameters();
        $inputs = self::numbers($inputs);

        $this->replace($inputs);
        $this->capturedRouteVars = true;

        return $inputs;
    }

    private static function numbers(array $inputs): array
    {
        foreach ($inputs as $k => $input) {
            if (is_numeric($input) && !is_infinite($inputs[$k] * 1)) {
                $inputs[$k] *= 1;
            }
        }

        return $inputs;
    }
}
