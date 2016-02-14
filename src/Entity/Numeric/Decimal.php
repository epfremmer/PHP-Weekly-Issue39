<?php
/**
 * File Decimal.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Numeric;

/**
 * Class Decimal
 *
 * @package PHPWeekly\Issue39\Entity
 */
class Decimal implements NumericInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * Decimal constructor
     *
     * @param string|int $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }
}
