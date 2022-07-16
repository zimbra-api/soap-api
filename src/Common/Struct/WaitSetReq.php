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
 * CreateWaitSetReq interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface WaitSetReq
{
    function setBlock(bool $block): self;
    function setDefaultInterests(string $defaultInterests): self;
    function setTimeout(int $timeout): self;
    function setAddAccounts(array $addAccounts): self;
    function addAddAccount(WaitSetAddSpec $addAccount): self;
    function setUpdateAccounts(array $updateAccounts): self;
    function addUpdateAccount(WaitSetAddSpec $updateAccount): self;
    function setRemoveAccounts(array $removeAccounts): self;
    function addRemoveAccount(Id $removeAccount): self;
    function setExpand(bool $expand): self;

    function getWaitSetId(): ?string;
    function getLastKnownSeqNo(): ?string;
    function getBlock(): ?bool;
    function getDefaultInterests(): ?string;
    function getTimeout(): ?int;
    function getAddAccounts(): array;
    function getUpdateAccounts(): array;
    function getRemoveAccounts(): array;
    function getExpand(): ?bool;
}
