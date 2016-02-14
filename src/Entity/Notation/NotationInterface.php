<?php
/**
 * File NotationInterface.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Notation;

use PHPWeekly\Issue39\Entity\Numeric as Entity;

/**
 * Interface NotationInterface
 *
 * @package PHPWeekly\Issue39\Entity
 */
interface NotationInterface
{
    /**
     * @return Entity\Number
     */
    public function getCoefficient();

    /**
     * @return Entity\Integer
     */
    public function getExponent();
}
