<?php
/**
 * File DecimalToScientificCommand.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Command;

use PHPWeekly\Issue39\Factory\NumberFactory;
use PHPWeekly\Issue39\Filter\WhiteSpaceFilter;
use PHPWeekly\Issue39\Transformer\ScientificNotationTransformer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DecimalToScientificCommand
 *
 * @package PHPWeekly\Issue36\Command
 */
class DecimalToScientificCommand extends ContainerAwareCommand
{
    const COMMAND_NAME = 'app:convert:decimal:to:scientific';
    const NUMBER_ARGUMENT = 'number';

    /**
     * @var NumberFactory
     */
    private $factory;

    /**
     * @var ScientificNotationTransformer
     */
    private $transformer;

    /**
     * @var WhiteSpaceFilter
     */
    private $filter;

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        parent::configure();

        $this->setName(self::COMMAND_NAME)
            ->setDescription('Convert decimal number to scientific notation format')
            ->addArgument(
                self::NUMBER_ARGUMENT,
                InputArgument::REQUIRED,
                'Decimal value to convert'
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        parent::initialize($input, $output);

        $container = $this->getContainer();

        $this->filter = $container->get('app.filter.whitespace');
        $this->factory = $container->get('app.factory.number');
        $this->transformer = $container->get('app.transformer.scientific_notation');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $number = $input->getArgument(self::NUMBER_ARGUMENT);
        $number = $this->filter->filter($number);

        $decimalFormat = $this->factory->make($number);
        $scientificNotation = $this->transformer->transform($decimalFormat);

        $output->writeLn((string)$scientificNotation);
    }
}
