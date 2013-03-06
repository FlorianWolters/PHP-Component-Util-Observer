<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Util\Observer\ChangeableSubjectInterface;
use FlorianWolters\Component\Util\Observer\ChangeableSubjectTrait;

abstract class ChangeableSubjectAbstract implements ChangeableSubjectInterface
{
    use ChangeableSubjectTrait;
}
