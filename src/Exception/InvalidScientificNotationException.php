<?php
/**
 * File InvalidScientificNotationException.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Exception;

/**
 * Class InvalidScientificNotationException
 *
 * @package PHPWeekly\Issue39\Exception
 */
class InvalidScientificNotationException extends \InvalidArgumentException
{
    /**
     * InvalidNumberException constructor
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Expected scientific notation. Got "%s"', $value));
    }
}
