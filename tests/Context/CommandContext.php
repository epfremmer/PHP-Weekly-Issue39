<?php
/**
 * File CommandContext.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Tests\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\TableNode;
use PHPUnit_Framework_Assert as PHPUnit;
use PHPWeekly\Issue39\Application;
use PHPWeekly\Issue39\Tests\Context\Traits\CodeCoverageTrait;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class CommandContext
 *
 * @package PHPWeekly\Issue39\Tests\Context
 */
class CommandContext implements Context, SnippetAcceptingContext
{
    /**
     * @var array
     */
    private $args = [];

    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $output;

    /**
     * @var \Exception
     */
    private $error;

    /**
     * @BeforeScenario
     */
    public function setup()
    {
        $this->args = [];
        $this->code = null;
        $this->output = null;
        $this->error = null;
    }

    /**
     * @Given I run the :name command
     *
     * @param string $name
     */
    public function iRunTheApplication($name)
    {
        $application = new Application();
        $command = $application->find($name);
        $commandTester = new CommandTester($command);

        $args = array_merge($this->args, [
            'command' => $command->getName()
        ]);

        try {
            $this->code = $commandTester->execute($args);
        } catch (\Exception $e) {
            $this->error = $e;
        }

        $this->output = $commandTester->getDisplay();
    }

    /**
     * @Given I have arguments:
     *
     * @param TableNode $args
     */
    public function iHaveArguments(TableNode $args)
    {
        $this->args = $args->getRowsHash();
        array_shift($this->args);
    }

    /**
     * @Then I should not get any errors
     */
    public function iShouldNotGetAnyErrors()
    {
        PHPUnit::assertEmpty($this->error);
    }

    /**
     * @Then I should get an error
     */
    public function iShouldGetAnError()
    {
        PHPUnit::assertInstanceOf(\InvalidArgumentException::class, $this->error);
    }

    /**
     * @Given I have the numeric value :number
     */
    public function iHaveTheHexValue($number)
    {
        $this->args = [
            'number' => $number
        ];
    }

    /**
     * @Then the response should equal :response
     */
    public function iShouldGetResponse($response)
    {
        PHPUnit::assertEquals($response, trim($this->output));
    }

    /**
     * @Then I should get a response that contains :text
     */
    public function iShouldGetAResponseThatContains($text)
    {
        PHPUnit::assertContains($text, $this->output);
    }

    /**
     * @Then the error message should contain :text
     */
    public function theErrorMessageShouldContain($text)
    {
        PHPUnit::assertContains($text, $this->error->getMessage());
    }
}
