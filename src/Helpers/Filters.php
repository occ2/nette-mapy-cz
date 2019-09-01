<?php declare(strict_types=1);

namespace MapyCZ\Helpers;

use Latte\Runtime\Html;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * Class Filters
 */
class Filters
{
    /**
     * @param $data
     * @return Html
     * @throws JsonException
     */
    public static function json($data): Html
    {
        return new Html(Json::encode($data));
    }
}
