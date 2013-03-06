<?php
namespace FlorianWolters;

use FlorianWolters\Component\Util\Observer\ObserverInterface;
use FlorianWolters\Component\Util\Observer\SubjectInterface;
use FlorianWolters\Component\Util\Observer\SubjectTrait;

require __DIR__ . '/../../vendor/autoload.php';

interface CommandInterface
{
    public function execute($data = null);
}

interface KeyboardEventInterface extends CommandInterface
{
}

class KeyboardInputCharacterEventSource implements
    KeyboardEventInterface,
    SubjectInterface
{
    use SubjectTrait;

    public function execute($data = null)
    {
        $line = $this->readCharacter();
        $this->notify($line);

        return $line;
    }

    private function readCharacter()
    {
        return \trim(\fgetc(\STDIN));
    }
}

class KeyboardInputLineEventSource implements
    KeyboardEventInterface,
    SubjectInterface
{
    use SubjectTrait;

    public function execute($data = null)
    {
        $line = $this->readLine();
        $this->notify($line);

        return $line;

    }

    private function readLine()
    {
        return \trim(\fgets(\STDIN));
    }
}

class KeyboardEventStdoutObserver implements ObserverInterface
{
    // onEnterKeyPress
    public function update(SubjectInterface $subject, $data = null)
    {
        if (false === ($subject instanceof KeyboardEventInterface)) {
            throw new \InvalidArgumentException('Invalid object.');
        }

        echo 'Received keyboard input: ' . $data . \PHP_EOL;
    }
}

/**
 * The class {@see KeyboardInputObserverExample} implements a simple command
 * line application to demonstrate the component
 * **FlorianWolters\Component\Util\Observer**.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Class available since Release 0.1.0
 */
final class KeyboardInputObserverExample
{
    /**
     * Runs the {@see KeyboardInputObserverExample}.
     *
     * @param integer $argc The number of arguments.
     * @param array   $argv The arguments.
     *
     * @return integer Always `0`.
     */
    public static function main($argc, array $argv = array())
    {
        $eventHandler = new KeyboardInputCharacterEventSource;
        $eventHandler->attach(new KeyboardEventStdoutObserver);

        while (true) {
            echo 'Please enter any keyboard input (\'q\' to quit) and proceed with ENTER.'
                . \PHP_EOL;
            if ('q' === $eventHandler->execute()) {
                break;
            }
        }

        return 0;
    }
}

exit(KeyboardInputObserverExample::main($argc, $argv));
