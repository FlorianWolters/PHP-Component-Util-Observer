<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * The trait {@see ChangeableSubjectTrait} represents an observable object, or
 * "data" in the model-view paradigm.
 *
 * It can be used to represent an object that the application wants to have
 * observed.
 *
 * An observable object can have one or more observers. An observer may be any
 * object that implements interface {@see ObserverInterface}. After an
 * observable instance changes, an application calling the {@see
 * ChangeableSubjectTrait}'s {@see notify} method causes all of its observers to
 * be notified of he change by a call to their update method.
 *
 * The order in which notifications will be delivered is unspecified. The
 * default implementation provided in the {@see ChangeableSubjectTrait} trait will
 * notify observers in the order in which they registered interest, but using
 * classes may change this order, use no guaranteed order, or may guarantee that
 * their subclass follows this order, as they choose.
 *
 * When an observable object is newly created, its set of observers is empty.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Trait available since Release 0.1.0
 */
trait ChangeableSubjectTrait
{
    use SubjectTrait {
        notify as private doNotify;
    }

    /**
     * Checks whether this object has changed.
     *
     * @return boolean `true` if and only if the {@see setChanged} method has
     *                 been called more recently than the {@see clearChanged}
     *                 method on this object; `false` otherwise.
     *
     * @see clearChanged
     * @see markChanged
     */
    public function hasChanged()
    {
        return $this->changed;
    }

    /**
     * Marks this object as having been changed; the {@see hasChanged} method
     * will now return `true`.
     *
     * @return void
     */
    public function markChanged()
    {
        $this->changed = true;
    }

    /**
     * Whether the state of this observable subject has changed.
     *
     * @var boolean
     */
    private $changed = false;

    /**
     * If this object has changed then notify all of its observers.
     *
     * @param mixed $data The optional data to pass to the `update` method of
     *                    the observers.
     *
     * @return void
     *
     * @see clearChanged
     * @see hasChanged
     * @see ObserverInterface::update
     */
    public function notify($data = null)
    {
        if (true === $this->hasChanged()) {
            $this->doNotify($data);
            $this->clearChanged();
        }
    }

    /**
     * Indicates that this object has no longer changed, or that it has already
     * notified all of its observers of its most recent change, so that the
     * {@see hasChanged} method will now return `false`.
     *
     * This method is called automatically by the {@see notify} method.
     *
     * @return void
     * @see notify
     */
    protected function clearChanged()
    {
        $this->changed = false;
    }
}
