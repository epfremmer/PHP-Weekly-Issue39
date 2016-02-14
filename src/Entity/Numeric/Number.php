<?php
/**
 * File Number.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Numeric;

use PHPWeekly\Issue39\Entity\Numeric as Entity;

/**
 * Class Number
 *
 * @package PHPWeekly\Issue39\Entity\Numeric
 */
class Number implements NumericInterface
{
    /**
     * @var Entity\Integer
     */
    private $integer;

    /**
     * @var Entity\Decimal
     */
    private $fractional;

    /**
     * Number constructor
     *
     * @param Entity\Integer $integer
     * @param Entity\NumericInterface $fractional
     */
    public function __construct(Entity\Integer $integer, Entity\NumericInterface $fractional = null)
    {
        $this->integer = $integer;
        $this->fractional = $fractional;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        if ($this->isInt()) {
            return (string) $this->integer;
        }

        return sprintf('%s.%s', $this->integer, $this->fractional);
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        if ($this->isInt()) {
            return $this->integer->getValue();
        }

        return sprintf('%s.%s', $this->integer->getValue(), $this->fractional->getValue());
    }

    /**
     * @return Entity\Integer
     */
    public function getInteger()
    {
        return $this->integer;
    }

    /**
     * @return Entity\Decimal
     */
    public function getFractional()
    {
        return $this->fractional;
    }

    /**
     * Test if number is an int
     *
     * @return bool
     */
    public function isInt()
    {
        return $this->fractional instanceof NullNumber;
    }

    /**
     * Test if number is a float
     *
     * @return bool
     */
    public function isFloat()
    {
        return $this->fractional instanceof Entity\Decimal;
    }
}
