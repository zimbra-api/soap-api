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
 * PartInfoInterface interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
interface PartInfoInterface
{
    function setSize(int $size): self;
    function setContentDisposition(string $contentDisposition): self;
    function setContentFilename(string $contentFilename): self;
    function setContentId(string $contentId): self;
    function setLocation(string $location): self;
    function setBody(bool $body);
    function setTruncatedContent(bool $truncatedContent): self;
    function setContent(string $content): self;

    function getPart(): string;
    function getContentType(): string;
    function getSize(): ?int;
    function getContentDisposition(): ?string;
    function getContentFilename(): ?string;
    function getContentId(): ?string;
    function getLocation(): ?string;
    function getBody(): ?bool;
    function getTruncatedContent(): ?bool;
    function getContent(): ?string;

    function setMimeParts(array $mimeParts): self;
    function addMimePart(PartInfoInterface $mimePart): self;
    function getMimeParts(): array;
}
