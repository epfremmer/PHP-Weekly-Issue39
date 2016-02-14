<?php
/**
 * File CodeCoverage.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Tests;

/**
 * Class CodeCoverage
 *
 * @package PHPWeekly\Issue39\Tests
 */
class CodeCoverage
{
    /**
     * @var \PHP_CodeCoverage
     */
    private $coverage;

    /**
     * @var \PHP_CodeCoverage_Report_HTML
     */
    private $writer;
    private $context;

    /**
     * CodeCoverage constructor
     *
     * @param string $context - Context class name
     */
    public function __construct($context)
    {
        $filter = new \PHP_CodeCoverage_Filter();
        $filter->addDirectoryToWhitelist(__DIR__ . '/../app');
        $filter->addDirectoryToWhitelist(__DIR__ . '/../src');

        $this->context = $context;
        $this->coverage = new \PHP_CodeCoverage(null, $filter);
        $this->writer = new \PHP_CodeCoverage_Report_PHP();
    }

    /**
     * Start code coverage
     *
     * @param string $title
     */
    public function start($title = 'Behat Coverage')
    {
        $this->coverage->start($title);
    }

    /**
     * Stop code coverage
     *
     * @return void
     */
    public function stop()
    {
        $this->coverage->stop();
    }

    /**
     * Process coverage
     *
     * @param string $name
     */
    public function process($name)
    {
        $directory = __DIR__ . '/../build/coverage/behat/';

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $this->writer->process($this->coverage, $directory . $name . '.cov');
    }

    /**
     * Merge coverage reports to HTML
     *
     * @return void
     */
    public function merge()
    {
        shell_exec('bin/phpcov merge --html=build/coverage/html -- build/coverage/behat');
    }
}
