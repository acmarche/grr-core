<?php


namespace Grr\Core\Setting\Traits;


trait SettingTrait
{
    public function name(): string
    {
        return self::NAME;
    }

    public static function getDefaultIndexName(): string
    {
        return self::NAME;
    }

    public function bindValue($value): string
    {
        return (string)$value;
    }
}
