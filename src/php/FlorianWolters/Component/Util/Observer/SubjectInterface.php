<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * The interface {@see SubjectInterface} can be implemented by a class to
 * represent an observable object, or "data" in the model-view paradigm.
 *
 * It can be implemented to represent an object that the application wants to
 * have observed.
 *
 * The interface {@see SubjectInterface} implements the *Subject* part of the
 * *Observer* behavioural design pattern.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Interface available since Release 0.1.0
 */
interface SubjectInterface
{
    /**
     * Adds the given observer to the set of observers for this subject,
     * provided that it is not the same as some observer already in the set.
     *
     * The order in which notifications will be delivered to multiple observers
     * is not specified.
     *
     * @param ObserverInterface $observer The *Observer* to be added.
     *
     * @return void
     */
    public function attach(ObserverInterface $observer);

    /**
     * Deletes the given observer from the set of observers of this subject.
     *
     * @param ObserverInterface $observer The *Observer* to be deleted.
     *
     * @return void
     */
    public function detach(ObserverInterface $observer);

    /**
     * Clears the observer list so that this object no longer has any observers.
     *
     * @return void
     */
    public function detachAll();

    /**
     * Notify all observers of this subject.
     *
     * @param mixed $data The optional data to pass to the `update` method of
     *                    the observers.
     *
     * @return void
     * @see ObserverInterface::update
     */
    public function notify($data = null);

    /**
     * Returns the number of observers of this object.
     *
     * @return integer The number of observers.
     */
    public function count();
}
