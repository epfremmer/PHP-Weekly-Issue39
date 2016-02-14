<?php
/**
 * File DecimalFactory.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Factory;

use PHPWeekly\Issue39\Entity\Numeric as Entity;

/**
 * Class DecimalFactory
 *
 * @package PHPWeekly\Issue39\Factory
 */
class DecimalFactory
{
    /**
     * Return new Decimal entity
     *
     * @param null $integer
     * @return null|Entity\Decimal
     */
    public function make($integer = null)
    {
        if (is_null($integer)) {
            return new Entity\NullNumber();
        }

        $integer = rtrim($integer, '0');

        return new Entity\Decimal($integer);
    }
}
