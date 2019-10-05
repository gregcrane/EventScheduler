<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model;

use LeviathanStudios\Scheduler\Api\Data\EventRequestResultInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class EventRequestSearchResult
 */
class EventRequestSearchResult extends SearchResults implements EventRequestResultInterface
{

}
