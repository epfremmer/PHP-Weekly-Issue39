<?php
/**
 * File NullNumber.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Numeric;

/**
 * Class NullNumber
 *
 * @package PHPWeekly\Issue39\Entity
 */
class NullNumber implements NumericInterface
{
    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return '';
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return '';
    }
}
