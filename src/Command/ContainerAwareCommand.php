<?php
/**
 * File ContainerAwareCommand.php
 *
 * @author Edward Pfremmer <epfremme@nerdery.com>
 */
namespace PHPWeekly\Issue39\Command;

use PHPWeekly\Issue39\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\DependencyInjection\Container;

/**
 * Class ContainerAwareCommand
 *
 * @package PHPWeekly\Issue39\Command
 */
class ContainerAwareCommand extends Command
{
    /**
     * @return Application
     */
    public function getApplication()
    {
        return parent::getApplication();
    }

    /**
     * @return Container
     */
    protected function getContainer()
    {
        return $this->getApplication()->getContainer();
    }
}
