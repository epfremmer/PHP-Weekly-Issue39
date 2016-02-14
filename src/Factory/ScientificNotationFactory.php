<?php
/**
 * File ScientificNotationFactory.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Factory;

use PHPWeekly\Issue39\Entity\Notation\ScientificNotation;
use PHPWeekly\Issue39\Exception\InvalidScientificNotationException;

/**
 * Class ScientificNotationFactory
 *
 * @package PHPWeekly\Issue39\Factory
 */
class ScientificNotationFactory
{
    const SCIENTIFIC_NOTATION_PATTERN = '/^(?P<coefficient>[+|-]?\d+(\.\d+)?)x10\^(?P<exponent>[+|-]?\d+)$/i';

    /**
     * @var NumberFactory
     */
    private $numberFactory;
    /**
     * @var IntegerFactory
     */
    private $integerFactory;

    /**
     * NumberFactory constructor
     *
     * @param NumberFactory $numberFactory
     * @param IntegerFactory $integerFactory
     */
    public function __construct(NumberFactory $numberFactory, IntegerFactory $integerFactory)
    {
        $this->numberFactory = $numberFactory;
        $this->integerFactory = $integerFactory;
    }

    /**
     * Return new ScientificNotation entity
     *
     * @param string $notation
     * @return ScientificNotation
     */
    public function make($notation)
    {
        if (!preg_match(self::SCIENTIFIC_NOTATION_PATTERN, $notation, $matches)) {
            throw new InvalidScientificNotationException($notation);
        }

        $coefficient = $this->numberFactory->make($matches['coefficient']);
        $exponent = $this->integerFactory->make($matches['exponent']);

        return new ScientificNotation($coefficient, $exponent);
    }
}
