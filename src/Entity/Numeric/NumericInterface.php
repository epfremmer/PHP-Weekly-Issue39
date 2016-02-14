<?php
/**
 * File NumericInterface.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Numeric;

/**
 * Interface NumericInterface
 *
 * @package PHPWeekly\Issue39\Entity\Numeric
 */
interface NumericInterface
{
    /**
     * Return raw value
     *
     * @return string
     */
    public function getValue();

    /**
     * Return string value
     *
     * @return mixed
     */
    public function __toString();
}
