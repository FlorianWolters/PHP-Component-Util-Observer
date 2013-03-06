<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * The interface {@see ObserverInterface} can be implemented by a class when it
 * wants to be informed of changes in observable objects.
 *
 * The interface {@see ObserverInterface} implements the *Observer* part of the
 * *Observer* behavioural design pattern.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Interface available since Release 0.1.0
 */
interface ObserverInterface
{
    /**
     * This method is called whenever the observed object is changed.
     *
     * An application calls an {@see SubjectInterface} object's {@see
     * SubjectInterface::notify} method to have all the object's observers
     * notified of the change.
     *
     * * The method {@see update} can use *pulling* to retrieve information 
     *   from the subject to observe via the `$subject` argument.
     * * The method {@see update} can use *pushing* to retrieve information 
     *   from the subject to observe via the `$notifyInformation` argument.
     *
     * @param SubjectInterface $subject  The subject to observe.
     * @param mixed            $data     The optional data passed to the
     *                                   `notify` method of the subject.
     *
     * @return void
     */
    public function update(SubjectInterface $subject, $data = null);
}
