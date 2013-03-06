<?php
namespace FlorianWolters\Component\Util\Observer;

/**
 * Test class for {@see SubjectTrait}.
 *
 * @author    Florian Wolters <wolters.fl@gmail.com>
 * @copyright 2010-2013 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt LGPL-3.0+
 * @link      http://github.com/FlorianWolters/PHP-Component-Util-Observer
 * @since     Class available since Release 0.1.0
 *
 * @covers    FlorianWolters\Component\Util\Observer\SubjectTrait
 */
class SubjectTraitTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ObserverInterface
     */
    private static $observer;

    /**
     * @var SubjectInterface
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
            'FlorianWolters\Mock\SubjectAbstract'
        );
    }

    /**
     * @return void
     *
     * @coversDefaultClass count
     * @test
     */
    public function testCountIsZeroIfNoObserverAttached()
    {
        $expected = 0;
        $actual = $this->subject->count();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return void
     *
     * @coversDefaultClass attach
     * @test
     */
    public function testAttachIncrementsNumberOfObservers()
    {
        $this->subject->attach(self::$observer);
        $this->assertEquals(1, $subject->count());

        $this->subject->attach(
            $this->getMock(__NAMESPACE__ . '\ObserverInterface')
        );
        $this->assertEquals(2, $subject->count());

        return $this->subject;
    }

    /**
     * @return void
     *
     * @coversDefaultClass attach
     * @test
     */
    public function testAttachDoesNotAddEqualObserver()
    {
        $this->subject->attach(self::$observer);
        $this->subject->attach(self::$observer);
        $this->assertEquals(1, $subject->count());
    }

    /**
     * @return void
     *
     * @coversDefaultClass notify
     * @depends testAttachIncrementsNumberOfObservers
     * @test
     */
    public function testObserversAreUpdated(SubjectInterface $subject)
    {
        self::$observer->expects($this->once())
            ->method('update')
            ->with($this->equalTo($subject));
        $subject->notify();
        // TODO How to assert?
        $this->assertTrue(true);
    }

    /**
     * @return void
     *
     * @coversDefaultClass detach
     * @depends testAttachIncrementsNumberOfObservers
     * @test
     */
    public function testDetachDecrementsNumberOfObservers(
        SubjectInterface $subject
    ) {
        $subject->detach(self::$observer);
        $this->assertEquals(1, $subject->count());
    }

    /**
     * @return void
     *
     * @coversDefaultClass detachAll
     * @depends testAttachIncrementsNumberOfObservers
     * @test
     */
    public function testDetachAll(SubjectInterface $subject)
    {
        $this->subject->detachAll();
        $this->assertEquals(0, $subject->count());
    }
}
