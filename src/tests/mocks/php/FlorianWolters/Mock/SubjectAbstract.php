<?php
namespace FlorianWolters\Mock;

use FlorianWolters\Component\Util\Observer\SubjectInterface;
use FlorianWolters\Component\Util\Observer\SubjectTrait;

abstract class SubjectAbstract implements SubjectInterface
{
    use SubjectTrait;
}
