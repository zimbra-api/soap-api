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
use Zimbra\Mail\Struct\AccountWithModifications;

/**
 * WaitSetResp interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface WaitSetResp
{
    function setCanceled(bool $canceled): self;
    function setSeqNo(string $seqNo): self;
    function setSignalledAccounts(array $signalledAccounts): self;
    function setErrors(array $errors): self;
    function setWaitSetId(string $waitSetId): self;

    function getWaitSetId(): ?string;
    function getCanceled(): ?bool;
    function getSeqNo(): ?string;
    function getSignalledAccounts(): array;
    function getErrors(): array;
}
