<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * The interface {@see ChangeableSubjectInterface} can be implemented by a class
 * to represent an observable object, or "data" in the model-view paradigm.
 *
 * It can be implemented to represent an object that the application wants to
 * have observed.
 *
 * The interface {@see ChangeableSubjectInterface} implements the *Subject* part
 * of the *Observer* behavioural design pattern.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Interface available since Release 0.1.0
 */
interface ChangeableSubjectInterface extends SubjectInterface
{
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
    public function hasChanged();

    /**
     * Marks this object as having been changed; the {@see hasChanged} method
     * will now return `true`.
     *
     * @return void
     * @see hasChanged
     */
    public function markChanged();
}
