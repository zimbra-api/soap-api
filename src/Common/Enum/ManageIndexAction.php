<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Enum;

/**
 * ManageIndexAction enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2025-present by Nguyen Van Nguyen.
 */
enum ManageIndexAction: string
{
    /**
     * Enable indexing and create index 
     * 
     * @return string 'enableIndexing'
     */
    case ENABLE = "enableIndexing";

    /**
     * Disable indexing and delete index
     * 
     * @return string 'disableIndexing'
     */
    case DISABLE = "disableIndexing";
}
