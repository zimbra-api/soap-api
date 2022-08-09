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
 * CreateWaitSetResp interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface CreateWaitSetResp
{
    function setErrors(array $errors = []): self;
    function getErrors(): array;
    function setWaitSetId(string $wsid): self;
    function getWaitSetId(): ?string;
    function setDefaultInterests(string $defInterests): self;
    function getDefaultInterests(): ?string;
    function setSequence(int $seq): self;
    function getSequence(): ?int;
}
