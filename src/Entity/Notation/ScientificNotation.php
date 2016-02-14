<?php
/**
 * File ScientificNotation.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Entity\Notation;

use PHPWeekly\Issue39\Entity\Numeric as Entity;
use PHPWeekly\Issue39\Entity\SignableInterface;

/**
 * Class ScientificNotation
 *
 * @package PHPWeekly\Issue39\Entity
 */
class ScientificNotation implements NotationInterface
{
    const NOTATION_DELIMINATOR = 'x10^';

    /**
     * @var Entity\Number
     */
    private $coefficient;

    /**
     * @var Entity\Integer
     */
    private $exponent;

    /**
     * ScientificNotation constructor
     *
     * @param Entity\Number $coefficient
     * @param Entity\Integer $exponent
     */
    public function __construct(Entity\Number $coefficient, Entity\Integer $exponent)
    {
        $this->coefficient = $coefficient;
        $this->exponent = $exponent;
    }

    /**
     * @inheritdoc
     */
    function __toString()
    {
        return sprintf('%s%s%s', $this->coefficient, static::NOTATION_DELIMINATOR, $this->exponent);
    }

    /**
     * @inheritdoc
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * @inheritdoc
     */
    public function getExponent()
    {
        return $this->exponent;
    }
}
