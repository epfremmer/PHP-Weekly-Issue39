<?php
/**
 * File SignableInterface.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity;

/**
 * Interface SignableInterface
 *
 * @package PHPWeekly\Issue39\Entity
 */
interface SignableInterface
{
    /**
     * Test if object is signed negative
     *
     * @return bool
     */
    public function isNegative();

    /**
     * Test if object is signed positive
     *
     * @return bool
     */
    public function isPositive();
}
