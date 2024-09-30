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
 * NewFileCreationTypes enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2023-present by Nguyen Van Nguyen.
 */
enum NewFileCreationTypes: string
{
    /**
     * Constant for value 'document'
     * @return string 'document'
     */
    case DOCUMENT = "document";

    /**
     * Constant for value 'presentation'
     * @return string 'presentation'
     */
    case PRESENTATION = "presentation";

    /**
     * Constant for value 'spreadsheet'
     * @return string 'spreadsheet'
     */
    case SPREADSHEET = "spreadsheet";
}
