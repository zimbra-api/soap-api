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

use Zimbra\Mail\Struct\NewContactAttr;
use Zimbra\Mail\Struct\NewContactGroupMember;

/**
 * SpecifyContact interface
 *
 * @package   Zimbra
 * @category  Struct
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface SpecifyContact
{
    function setId(int $id): self;
    function setTagNames(string $tagNames): self;
    function setAttrs(array $attrs): self;
    function addAttr(NewContactAttr $attr): self;
    function setContactGroupMembers(array $contactGroupMembers): self;
    function addContactGroupMember(NewContactGroupMember $contactGroupMember): self;

    function getId(): ?int;
    function getTagNames(): ?string;
    function getAttrs(): array;
    function getContactGroupMembers(): array;
}
