<?php

namespace App\Enums;

enum ServiceIcon: string
{
    case Code = 'code';
    case Server = 'server';
    case Phone = 'phone';
    case Db = 'db';

    public function label(): string
    {
        return match ($this) {
            self::Code => 'Code',
            self::Server => 'Server',
            self::Phone => 'Phone',
            self::Db => 'Database',
        };
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn (self $case) => [$case->value => $case->label()])
            ->all();
    }
}
