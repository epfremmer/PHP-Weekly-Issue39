<?php
/**
 * File NumberToShortestCommand.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class NumberToShortestCommand
 *
 * @package PHPWeekly\Issue36\Command
 */
class NumberToShortestCommand extends ContainerAwareCommand
{
    const COMMAND_NAME = 'app:convert:number:to:shortest';
    const NUMBER_ARGUMENT = 'number';

    /**
     * @var DecimalToScientificCommand
     */
    private $decimalToScientificCommand;

    /**
     * @var ScientificToDecimalCommand
     */
    private $scientificToDecimalCommand;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME)
            ->setDescription('Convert number to shortest possible format')
            ->addArgument(
                self::NUMBER_ARGUMENT,
                InputArgument::REQUIRED,
                'Numeric value to convert'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $this->decimalToScientificCommand = $this->getApplication()->find(DecimalToScientificCommand::COMMAND_NAME);
        $this->scientificToDecimalCommand = $this->getApplication()->find(ScientificToDecimalCommand::COMMAND_NAME);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();
        $number = $input->getArgument(self::NUMBER_ARGUMENT);
        $buffer = new BufferedOutput();

        if ($this->isNumeric($number)) {
            $number = $container->get('app.factory.number')->make($number);

            $this->decimalToScientificCommand->run($input, $buffer);
        } else {
            $number = $container->get('app.factory.scientific_notation')->make($number);

            $this->scientificToDecimalCommand->run($input, $buffer);
        }

        $result = trim($buffer->fetch());
        $number = (string) $number;

        if (strlen($number) < strlen($result)) {
            $output->writeln($number);
        } elseif (strlen($number) === strlen($result) && $this->isNumeric($number)) {
            $output->writeln($number);
        } else {
            $output->writeln($result);
        }
    }

    /**
     * Test if string is numeric
     *
     * @param string $number
     * @return bool
     */
    private function isNumeric($number)
    {
        return is_numeric($number);
    }
}
