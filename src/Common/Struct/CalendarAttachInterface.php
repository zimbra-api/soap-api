<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Struct;

/**
 * CalendarAttachInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface CalendarAttachInterface
{
    function setUri(string $uri): self;
    function setContentType(string $contentType): self;
    function setBinaryB64Data(string $binaryB64Data): self;
    function getUri(): ?string;
    function getContentType(): ?string;
    function getBinaryB64Data(): ?string;
}
