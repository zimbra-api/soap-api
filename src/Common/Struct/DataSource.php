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

use Zimbra\Common\Enum\ConnectionType;

/**
 * DataSource interface
 *
 * @package    Zimbra
 * @subpackage Common
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
interface DataSource
{
    function setId(string $id): self;
    function setName(string $name): self;
    function setFolderId(string $folderId): self;
    function setEnabled(bool $enabled): self;
    function setImportOnly(bool $importOnly): self;
    function setHost(string $host): self;
    function setPort(int $port): self;
    function setConnectionType(ConnectionType $connectionType): self;
    function setUsername(string $username): self;
    function setPassword(string $password): self;
    function setPollingInterval(string $pollingInterval): self;
    function setEmailAddress(string $emailAddress): self;
    function setUseAddressForForwardReply(bool $useAddressForForwardReply): self;
    function setDefaultSignature(string $defaultSignature): self;
    function setForwardReplySignature(string $forwardReplySignature): self;
    function setFromDisplay(string $fromDisplay): self;
    function setReplyToAddress(string $replyToAddress): self;
    function setReplyToDisplay(string $replyToDisplay): self;
    function setImportClass(string $importClass): self;
    function setFailingSince(int $failingSince): self;
    function setLastError(string $lastError): self;
    function setAttributes(array $attributes): self;
    function addAttribute(string $attribute): self;
    function setRefreshToken(string $refreshToken): self;
    function setRefreshTokenUrl(string $refreshTokenUrl): self;

    function getId(): ?string;
    function getName(): ?string;
    function getFolderId(): ?string;
    function isEnabled(): ?bool;
    function isImportOnly(): ?bool;
    function getHost(): ?string;
    function getPort(): ?int;
    function getConnectionType(): ?ConnectionType;
    function getUsername(): ?string;
    function getPassword(): ?string;
    function getPollingInterval(): ?string;
    function getEmailAddress(): ?string;
    function isUseAddressForForwardReply(): ?bool;
    function getDefaultSignature(): ?string;
    function getForwardReplySignature(): ?string;
    function getFromDisplay(): ?string;
    function getReplyToAddress(): ?string;
    function getReplyToDisplay(): ?string;
    function getImportClass(): ?string;
    function getFailingSince(): ?int;
    function getLastError(): ?string;
    function getAttributes(): array;
    function getRefreshToken(): ?string;
    function getRefreshTokenUrl(): ?string;
}
