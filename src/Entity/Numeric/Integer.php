<?php
/**
 * File Integer.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Numeric;

use PHPWeekly\Issue39\Entity\SignableInterface;

/**
 * Class Integer
 *
 * @package PHPWeekly\Issue39\Entity
 */
class Integer implements SignableInterface, NumericInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * @var string
     */
    private $sign;

    /**
     * Integer constructor
     *
     * @param string|int $value
     * @param string $sign
     */
    public function __construct($value, $sign = '')
    {
        $this->value = (string) $value;
        $this->sign = $sign;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return sprintf('%s%s', $this->sign, $this->value);
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @inheritdoc
     */
    public function isNegative()
    {
        return $this->sign === '-';
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore - Currently unused
     */
    public function isPositive()
    {
        return $this->sign !== '-';
    }
}
