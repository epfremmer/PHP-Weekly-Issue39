<?php
/**
 * File DecimalFormatTransformer.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Transformer;

use PHPWeekly\Issue39\Entity\Numeric as Entity;
use PHPWeekly\Issue39\Entity\Notation\NotationInterface;
use PHPWeekly\Issue39\Factory\NumberFactory;

/**
 * Class DecimalFormatTransformer
 *
 * @package PHPWeekly\Issue39\Transformer
 */
class DecimalFormatTransformer
{
    /**
     * @var NumberFactory
     */
    private $numberFactory;

    /**
     * DecimalFormatTransformer constructor
     *
     * @param NumberFactory $numberFactory
     */
    public function __construct(NumberFactory $numberFactory)
    {
        $this->numberFactory = $numberFactory;
    }

    /**
     * Transform notation entity into numeric
     *
     * @param NotationInterface $notation
     * @return Entity\Number
     */
    public function transform(NotationInterface $notation)
    {
        $exponent = $notation->getExponent();
        $coefficient = $notation->getCoefficient();
        $integer = $coefficient->getInteger();

        $padLength = strlen($integer->getValue()) + abs($exponent->getValue());
        $result = str_pad($integer->getValue(), $padLength, '0', $exponent->isNegative()
            ? STR_PAD_LEFT
            : STR_PAD_RIGHT
        );

        if ($exponent->isNegative()) {
            $result = sprintf('%s%s', $result, $coefficient->getFractional());
            $result = substr_replace($result, '.', 1, 0);
        } else {
            $result = substr_replace($result, $coefficient->getFractional(),
                strlen($integer->getValue()),
                strlen($coefficient->getFractional())
            );

            if ($coefficient->isFloat()) {
                $result = substr_replace($result, '.', (int)$exponent->getValue() + 1, 0);
            }
        }

        $result = sprintf('%s%s', $coefficient->getInteger()->getSign(), $result);

        return $this->numberFactory->make($result);
    }
}
