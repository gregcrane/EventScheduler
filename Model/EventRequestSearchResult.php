<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model;

use LeviathanStudios\Scheduler\Api\Data\EventRequestResultInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class EventRequestSearchResult
 *
 * @package LeviathanStudios\RequestContact\Model
 */
class EventRequestSearchResult extends SearchResults implements EventRequestResultInterface
{

}
