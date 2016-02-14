<?php
/**
 * File IntegerFactory.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Factory;

use PHPWeekly\Issue39\Entity\Numeric as Entity;

/**
 * Class IntegerFactory
 *
 * @package PHPWeekly\Issue39\Factory
 */
class IntegerFactory
{
    /**
     * Return new Integer entity
     *
     * @param string $integer
     * @return Entity\Integer
     */
    public function make($integer)
    {
        $integer = preg_replace_callback('/[-|+]?/', function($matches) use (&$sign) {
            if (empty($matches[0])) return;

            $sign = $matches[0];
        }, $integer);

        $integer = ltrim($integer, '0') ?: '0';

        return new Entity\Integer($integer, $sign);
    }
}
