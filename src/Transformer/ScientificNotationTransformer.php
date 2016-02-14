<?php
/**
 * File ScientificNotationTransformer.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Transformer;

use PHPWeekly\Issue39\Entity\Numeric as Entity;
use PHPWeekly\Issue39\Entity\Notation\NotationInterface;
use PHPWeekly\Issue39\Entity\Notation\ScientificNotation;
use PHPWeekly\Issue39\Factory\ScientificNotationFactory;

/**
 * Class ScientificNotationTransformer
 *
 * @package PHPWeekly\Issue39\Transformer
 */
class ScientificNotationTransformer
{
    /**
     * @var ScientificNotationFactory
     */
    private $scientificNotationFactory;

    /**
     * DecimalFormatTransformer constructor
     *
     * @param ScientificNotationFactory $scientificNotationFactory
     */
    public function __construct(ScientificNotationFactory $scientificNotationFactory)
    {
        $this->scientificNotationFactory = $scientificNotationFactory;
    }

    /**
     * Transform number into scientific notation
     *
     * @param Entity\Number $number
     * @return NotationInterface
     */
    public function transform(Entity\Number $number)
    {
        $integer = $number->getInteger();
        $fractional = $number->getFractional();

        $result = 0;
        $power = 0;

        if (abs($number->getValue()) >= 1) {
            $power = strlen($integer->getValue()) - 1;
            $result = sprintf('%s%s', $integer->getValue(), $fractional->getValue());
            $result = rtrim($result, '0');
        } elseif ($number->getValue() != 0) {
            $result = ltrim($fractional->getValue(), '0');
            $power = strlen($result) - strlen($fractional->getValue()) - 1;
        }

        if (strlen($result) > 1) {
            $result = substr_replace($result, '.', 1, 0);
        }

        $result = sprintf('%s%s', $number->getInteger()->getSign(), $result);
        $result = sprintf('%s%s%s', $result, ScientificNotation::NOTATION_DELIMINATOR, $power);

        return $this->scientificNotationFactory->make($result);
    }
}
