<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * The trait {@see SubjectTrait} represents an observable object, or "data" in
 * the model-view paradigm.
 *
 * It can be used to represent an object that the application wants to have
 * observed.
 *
 * An observable object can have one or more observers. An observer may be any
 * object that implements interface {@see ObserverInterface}. After an
 * observable instance changes, an application calling the {@see SubjectTrait}'s
 * {@see notify} method causes all of its observers to be notified of he change
 * by a call to their update method.
 *
 * The order in which notifications will be delivered is unspecified. The
 * default implementation provided in the {@see SubjectTrait} trait will notify
 * observers in the order in which they registered interest, but using classes
 * may change this order, use no guaranteed order, or may guarantee that their
 * subclass follows this order, as they choose.
 *
 * When an observable object is newly created, its set of observers is empty.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Trait available since Release 0.1.0
 */
trait SubjectTrait
{
    /**
     * The set of observer for this subject.
     *
     * @var ObserverInterface[]
     */
    private $observers = [];

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
    public function attach(ObserverInterface $observer)
    {
        if (false === $this->position($observer)) {
            $this->observers[] = $observer;
        }
    }

    /**
     * Retrieves the index of the specified observer.
     *
     * @param ObserverInterface $observer The observer to check.
     *
     * @return integer|boolean The index of the observer `$observer` on success;
     *                         `false` on failure.
     */
    private function position(ObserverInterface $observer)
    {
        return \array_search($observer, $this->observers);
    }

    /**
     * Deletes the given observer from the set of observers of this subject.
     *
     * @param ObserverInterface $observer The *Observer* to be deleted.
     *
     * @return void
     */
    public function detach(ObserverInterface $observer)
    {
        $index = $this->position($observer);
        if (false !== $index) {
            unset($this->observers[$index]);
            $this->observers = \array_values($this->observers);
        }
    }

    /**
     * Clears the observer list so that this object no longer has any observers.
     *
     * @return void
     */
    public function detachAll()
    {
        $this->observers = [];
    }

    /**
     * Notify all observers of this subject.
     *
     * @param mixed $data The optional data to pass to the `update` method of
     *                    the observers.
     *
     * @return void
     * @see ObserverInterface::update
     */
    public function notify($notifyInformation = null)
    {
        /* @var $observer ObserverInterface */
        foreach ($this->observers as $observer) {
            $observer->update($this, $notifyInformation);
        }
    }

    /**
     * Returns the number of observers of this object.
     *
     * @return integer The number of observers.
     */
    public function count()
    {
        return \count($this->observers);
    }
}
