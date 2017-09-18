<?php

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * GameStatusType
 */
final class GameStatusType extends AbstractEnumType
{

    const CURRENT = 'C';
    const FUTURE = 'F';
    const PAST = 'P';

    /**
     * @var array
     */
    protected static $choices = [
        self::CURRENT => 'Current',
        self::FUTURE  => 'Future',
        self::PAST    => 'Past'
    ];

}
