<?php
/**
 * File WhiteSpaceFilter.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Filter;

/**
 * Class WhiteSpaceFilter
 *
 * @package PHPWeekly\Issue39\Filter
 */
class WhiteSpaceFilter
{
    /**
     * Filter all whitespace from string
     *
     * @param string $string
     * @return mixed
     */
    public function filter($string)
    {
        return preg_replace('/\s+/', '', $string);
    }
}
