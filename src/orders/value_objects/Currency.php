<?php

namespace Src\orders\value_objects;

use AmountExceedsAllowedDecimalsException;
use Src\orders\exception\CurrencyCodeIsNotSupportedException;

/**
 * @package Src\orders\value_objects
 *
 * Represents a currency in the domain for payments entities
 */
class Currency
{

    /**
     * @param string $code
     * @param string $symbol
     * @param int $decimals (default: 2)
     *
     * @throws CurrencyCodeIsNotSupportedException
     */
    public function __construct(
        private string $code, 
        private string $symbol, 
        private int $decimals = 2
    ) {
        $code = strtoupper($code);

        if (!in_array($code, ['USD', 'EUR', 'UYU'])) {
            throw new CurrencyCodeIsNotSupportedException($code);
        }

        $this->code = $code;
        $this->symbol = $symbol;
        $this->decimals = $decimals;
    }

    public function code(): string
    {
        return $this->code;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function decimals(): int
    {
        return $this->decimals;
    }

    public function assertValidAmount(float $value): void
    {
        if (round($value, $this->decimals()) != $value) {
            throw new AmountExceedsAllowedDecimalsException();
        }
    }

    public function equals(Currency $other): bool
    {
        return $this->code === $other->code;
    }
}

