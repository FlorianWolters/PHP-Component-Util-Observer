<?php
namespace FlorianWolters;

use FlorianWolters\Component\Util\Observer\ObserverInterface;
use FlorianWolters\Component\Util\Observer\SubjectInterface;
use FlorianWolters\Component\Util\Observer\SubjectTrait;

require __DIR__ . '/../../vendor/autoload.php';

class User
{
}

class UserFactory implements SubjectInterface
{
    use SubjectTrait;

    /**
     * @staticvar UserFactory $instance
     * @return UserFactory
     */
    public static function getInstance()
    {
        static $instance = null;

        if (null === $instance) {
             $instance = new self;
        }

        return $instance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * @return User
     */
    public function createUser()
    {
        $result = new User;

        $this->notify();

        return $result;
    }
}

class InstanceCountObserver implements ObserverInterface
{
    /**
     * @var integer
     */
    private $numberOfInstances = 0;

    public function getNumberOfInstances()
    {
        return $this->numberOfInstances;
    }

    public function reset()
    {
        $this->numberOfInstances = 0;
    }

    // Implementation of interface
    // FlorianWolters\Component\Util\Observer\ObserverInterface

    public function update(SubjectInterface $subject, $data = null)
    {
        ++$this->numberOfInstances;
    }
}

/**
 * The class {@see InstanceCountObserverExample} implements a simple command
 * line application to demonstrate the component
 * **FlorianWolters\Component\Util\Observer**.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Class available since Release 0.1.0
 */
final class InstanceCountObserverExample
{
    /**
     * Runs the {@see InstanceCountObserverExample}.
     *
     * @param integer $argc The number of arguments.
     * @param array   $argv The arguments.
     *
     * @return integer Always `0`.
     */
    public static function main($argc, array $argv = array())
    {
        $self = new self;
        $self->run();

        return 0;
    }

    /**
     * @return void
     */
    private function run()
    {
        $observer = new InstanceCountObserver;
        UserFactory::getInstance()->attach($observer);

        $this->writeLine($observer->getNumberOfInstances());
        UserFactory::getInstance()->createUser();
        UserFactory::getInstance()->createUser();
        $this->writeLine($observer->getNumberOfInstances());

        UserFactory::getInstance()->detach($observer);
        UserFactory::getInstance()->detach($observer);
        UserFactory::getInstance()->attach($observer);
        UserFactory::getInstance()->detachAll();
    }

    /**
     * @return void
     */
    private function writeLine($text = '')
    {
        echo $text . \PHP_EOL;
    }
}

exit(InstanceCountObserverExample::main($argc, $argv));
