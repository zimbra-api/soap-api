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
 * CalOrganizerInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface CalOrganizerInterface
{
    function setAddress(string $address): self;
    function setUrl(string $url): self;
    function setDisplayName(string $displayName): self;
    function setSentBy(string $sentBy): self;
    function setDir(string $dir): self;
    function setLanguage(string $language): self;

    function getAddress(): ?string;
    function getUrl(): ?string;
    function getDisplayName(): ?string;
    function getSentBy(): ?string;
    function getDir(): ?string;
    function getLanguage(): ?string;

    function addXParam(XParamInterface $xParam): self;
    function setXParams(array $xParams): self;
    function getXParams(): array;
}
