<?php
/**
 * File InvalidNumberException.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Exception;

/**
 * Class InvalidNumberException
 *
 * @package PHPWeekly\Issue39\Exception
 */
class InvalidNumberException extends \InvalidArgumentException
{
    /**
     * InvalidNumberException constructor
     *
     * @param string $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Expected number. Got "%s"', $value));
    }
}
