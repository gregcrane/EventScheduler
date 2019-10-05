<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model;

use LeviathanStudios\Scheduler\Api\Data\ApprovedEventResultInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Class ApprovedEventSearchResult
 *
 * @package LeviathanStudios\Scheduler\Model
 */
class ApprovedEventSearchResult extends SearchResults implements ApprovedEventResultInterface
{

}
