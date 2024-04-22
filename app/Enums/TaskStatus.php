<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Attributes\Description;
use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TaskStatus extends Enum
{
    #[Description('To Do')]
    const TODO = 'to-do';

    #[Description('In Progress')]
    const INPROGRESS = 'in-progress';

    #[Description('Done')]
    const DONE = 'done';
}
