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

use MyCLabs\Enum\Enum;

/**
 * NewFileCreationTypes enum class
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Enum
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2023-present by Nguyen Van Nguyen.
 */
class NewFileCreationTypes extends Enum
{
    /**
     * Constant for value 'document'
     * @return string 'document'
     */
    protected const DOCUMENT = 'document';

    /**
     * Constant for value 'presentation'
     * @return string 'presentation'
     */
    protected const PRESENTATION = 'presentation';

    /**
     * Constant for value 'spreadsheet'
     * @return string 'spreadsheet'
     */
    protected const SPREADSHEET = 'spreadsheet';
}
