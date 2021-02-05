<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Struct;

use Zimbra\Enum\AddressType;

/**
 * EmailInfoInterface interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface EmailInfoInterface
{
    function setGroup(bool $group): self;
    function setCanExpandGroupMembers(bool $canExpandGroupMembers): ?self;

    function getAddress(): ?string;
    function getDisplay(): ?string;
    function getPersonal(): ?string;
    function getAddressType(): ?AddressType;
    function getGroup(): ?bool;
    function getCanExpandGroupMembers(): ?bool;
}