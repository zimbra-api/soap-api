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

use Zimbra\Common\Enum\ZimletPresence;

/**
 * ZimletContextInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface ZimletContextInterface
{
    function setZimletBaseUrl(string $baseUrl): self;
    function setZimletPriority(int $priority): self;
    function setZimletPresence(ZimletPresence $presence): self;

    function getZimletBaseUrl(): ?string;
    function getZimletPriority(): ?int;
    function getZimletPresence(): ?ZimletPresence;
}
