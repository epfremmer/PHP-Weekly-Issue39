<?php
/**
 * File NumberFactory.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Factory;

use PHPWeekly\Issue39\Entity\Numeric as Entity;
use PHPWeekly\Issue39\Exception\InvalidNumberException;

/**
 * Class NumberFactory
 *
 * @package PHPWeekly\Issue39\Factory
 */
class NumberFactory
{
    const NUMERIC_PATTERN = '/^(?P<integer>[+|-]?\d+)\.?(?P<fractional>\d+)?$/i';

    /**
     * @var IntegerFactory
     */
    private $integerFactory;

    /**
     * @var DecimalFactory
     */
    private $decimalFactory;

    /**
     * NumberFactory constructor
     *
     * @param IntegerFactory $integerFactory
     * @param DecimalFactory $decimalFactory
     */
    public function __construct(IntegerFactory $integerFactory, DecimalFactory $decimalFactory)
    {
        $this->integerFactory = $integerFactory;
        $this->decimalFactory = $decimalFactory;
    }

    /**
     * Return new Number entity
     *
     * @param string $number
     * @return Entity\Number
     * @throws InvalidNumberException
     */
    public function make($number)
    {
        if (!preg_match(self::NUMERIC_PATTERN, $number, $matches)) {
            throw new InvalidNumberException($number);
        }

        return new Entity\Number(
            $this->integerFactory->make($matches['integer']),
            $this->decimalFactory->make(@$matches['fractional'])
        );
    }
}
