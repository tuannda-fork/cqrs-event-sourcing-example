<?php
/**
 * This file is part of list-maker.
 * (c) Renan Taranto <renantaranto@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Taranto\ListMaker\Item\Infrastructure\Validation;

use Symfony\Component\Validator\Constraint;

/**
 * Class AddItemPosition
 * @package Taranto\ListMaker\Item\Infrastructure\Validation
 * @author Renan Taranto <renantaranto@gmail.com>
 */
final class AddItemPosition extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Invalid position.';

    /**
     * @return array|string
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
