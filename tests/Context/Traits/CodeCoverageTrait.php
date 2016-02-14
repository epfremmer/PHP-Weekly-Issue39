<?php
/**
 * File CodeCoverageTrait.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Tests\Context\Traits;

use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Testwork\Hook\Scope\AfterSuiteScope;
use PHPWeekly\Issue39\Tests\CodeCoverage;

/**
 * Class CodeCoverageTrait
 *
 * @package PHPWeekly\Issue39\Tests\Context\Traits
 */
trait CodeCoverageTrait
{
    /**
     * @var CodeCoverage
     */
    static private $coverage;

    /**
     * @BeforeSuite
     */
    static public function setup()
    {
        self::$coverage = self::$coverage ?: new CodeCoverage(__CLASS__);
    }

    /**
     * @AfterSuite
     *
     * @param AfterSuiteScope $event
     */
    static public function tearDown(AfterSuiteScope $event)
    {
        self::$coverage->process($event->getSuite()->getName());
        self::$coverage->merge();
    }

    /**
     * @BeforeScenario
     * @param BeforeScenarioScope $event
     */
    public function start(BeforeScenarioScope $event)
    {
        self::$coverage->start($event->getScenario()->getTitle());
    }

    /**
     * @AfterScenario
     */
    public function stop()
    {
        self::$coverage->stop();
    }
}
