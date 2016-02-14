<?php
/**
 * File ScientificToDecimalCommand.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Command;

use PHPWeekly\Issue39\Factory\ScientificNotationFactory;
use PHPWeekly\Issue39\Filter\WhiteSpaceFilter;
use PHPWeekly\Issue39\Transformer\DecimalFormatTransformer;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ScientificToDecimalCommand
 *
 * @package PHPWeekly\Issue36\Command
 */
class ScientificToDecimalCommand extends ContainerAwareCommand
{
    const COMMAND_NAME = 'app:convert:scientific:to:decimal';
    const NUMBER_ARGUMENT = 'number';

    /**
     * @var ScientificNotationFactory
     */
    private $factory;

    /**
     * @var DecimalFormatTransformer
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
            ->setDescription('Convert scientific notation to decimal format')
            ->addArgument(
                self::NUMBER_ARGUMENT,
                InputArgument::REQUIRED,
                'Scientific value to convert'
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
        $this->factory = $container->get('app.factory.scientific_notation');
        $this->transformer = $container->get('app.transformer.decimal');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $notation = $input->getArgument(self::NUMBER_ARGUMENT);
        $notation = $this->filter->filter($notation);

        $scientificNotation = $this->factory->make($notation);
        $decimalFormat = $this->transformer->transform($scientificNotation);

        $output->writeLn((string)$decimalFormat);
    }
}
