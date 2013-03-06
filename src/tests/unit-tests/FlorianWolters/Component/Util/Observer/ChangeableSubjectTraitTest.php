<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * Test class for {@see ChangeableSubjectTrait}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Class available since Release 0.1.0
 *
 * @covers    FlorianWolters\Component\Util\Observer\ChangeableSubjectTrait
 */
class ChangeableSubjectTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObserverInterface
     */
    private static $observer;

    /**
     * @var ChangeableSubjectInterface
     */
    private $subject;

    public static function setUpBeforeClass()
    {
        self::$observer = \PHPUnit_Framework_MockObject_Generator::getMock(
            __NAMESPACE__ . '\ObserverInterface'
        );
    }

    /**
     * Sets up the fixture.
     *
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->subject = $this->getMockForAbstractClass(
            'FlorianWolters\Mock\ChangeableSubjectAbstract'
        );
    }

    /**
     * @return void
     *
     * @coversDefaultClass hasChanged
     * @test
     */
    public function testHasChangedIsFalseIfNoObserverAttached()
    {
        $this->assertFalse($this->subject->hasChanged());
    }

    /**
     * @return void
     *
     * @coversDefaultClass hasChanged
     * @coversDefaultClass markChanged
     * @test
     */
    public function testMarkChangedSetsHasChangedToTrue()
    {
        $this->subject->markChanged();

        $this->assertTrue($this->subject->hasChanged());
    }

    /**
     * @return void
     *
     * @coversDefaultClass notify
     * @test
     * @todo
     */
    public function testUpdateIsNotExecutedWithoutMarkChanged()
    {
        self::$observer->expects($this->once())
            ->method('update');
        $this->subject->attach(self::$observer);
        $this->subject->notify();

        $this->assertTrue(true);
    }

    /**
     * @return void
     *
     * @coversDefaultClass hasChanged
     * @coversDefaultClass markChanged
     * @coversDefaultClass notify
     * @test
     * @todo
     */
    public function testUpdateIsExecutedAfterMarkChanged()
    {
        self::$observer->expects($this->once())
            ->method('update');
        $this->subject->attach(self::$observer);
        $this->subject->markChanged();

        $this->subject->notify();

        $this->assertFalse($this->subject->hasChanged());
    }
}
