<?php
/**
 * File Application.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39;

use PHPWeekly\Issue39\Command\DecimalToScientificCommand;
use PHPWeekly\Issue39\Command\NumberToShortestCommand;
use PHPWeekly\Issue39\Command\ScientificToDecimalCommand;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class Application
 *
 * @package PHPWeekly\Issue39
 */
class Application extends BaseApplication
{
    /**
     * @var Container
     */
    private $container;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('console', '1.0.0');

        $this->addCommands([
            new DecimalToScientificCommand(),
            new ScientificToDecimalCommand(),
            new NumberToShortestCommand(),
        ]);

        $this->container = new ContainerBuilder();

        $loader = new YamlFileLoader($this->container, new FileLocator(__DIR__));
        $loader->load('services.yaml');
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
