<?php
/**
 * File FeatureContext.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Tests\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use PHPUnit_Framework_Assert as PHPUnit;
use PHPWeekly\Issue39\Tests\Context\Traits\CodeCoverageTrait;

/**
 * Class FeatureContext
 *
 * @package PHPWeekly\Issue39\Tests\Context
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    use CodeCoverageTrait;

    /**
     * @var string
     */
    private $cwd;

    /**
     * @BeforeScenario
     */
    public function before()
    {
        $this->cwd = getcwd();
    }

    /**
     * @AfterScenario
     */
    public function after()
    {
        chdir($this->cwd);
    }

    /**
     * @Given I am in the :path path
     * @param string $path
     */
    public function iAmInThePath($path)
    {
        $this->fileShouldExist($path);

        chdir($path);
    }

    /**
     * @Then file :path should exist
     */
    public function fileShouldExist($path)
    {
        PHPUnit::assertFileExists($path);
    }

    /**
     * @Then file :path should be executable
     */
    public function fileShouldBeExecutable($path)
    {
        PHPUnit::assertTrue(is_executable($path));
    }

    /**
     * @Then :file file should contain:
     *
     * @param string $file
     * @param PyStringNode $strings
     */
    public function fileShouldContain($file, PyStringNode $strings)
    {
        PHPUnit::assertFileExists($file);

        $contents = file_get_contents($file);
        $strings = $strings->getStrings();

        array_walk($strings, function($string) use ($contents) {
            PHPUnit::assertContains($string, $contents);
        });
    }
}
