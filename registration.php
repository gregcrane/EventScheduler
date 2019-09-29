<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'LeviathanStudios_Scheduler',
    __DIR__
);