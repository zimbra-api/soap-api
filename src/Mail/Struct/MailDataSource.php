<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Enum\ConnectionType;
use Zimbra\Struct\DataSource;

/**
 * MailDataSource struct class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 */
class MailDataSource implements DataSource
{
    /**
     * Unique ID for data source
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * Name for data source
     * @Accessor(getter="getName", setter="setName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlAttribute
     */
    private $name;

    /**
     * Folder ID for data source
     * @Accessor(getter="getFolderId", setter="setFolderId")
     * @SerializedName("l")
     * @Type("string")
     * @XmlAttribute
     */
    private $folderId;

    /**
     * Flag whether or not the data source is enabled
     * @Accessor(getter="isEnabled", setter="setEnabled")
     * @SerializedName("isEnabled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $enabled;

    /**
     * indicates that this datasource is used for one way (incoming) import versus two-way sync
     * @Accessor(getter="isImportOnly", setter="setImportOnly")
     * @SerializedName("importOnly")
     * @Type("bool")
     * @XmlAttribute
     */
    private $importOnly;

    /**
     * Name of server
     * e.g. "imap.myisp.com"
     * @Accessor(getter="getHost", setter="setHost")
     * @SerializedName("host")
     * @Type("string")
     * @XmlAttribute
     */
    private $host;

    /**
     * Port number of server
     * e.g. "143"
     * @Accessor(getter="getPort", setter="setPort")
     * @SerializedName("port")
     * @Type("integer")
     * @XmlAttribute
     */
    private $port;

    /**
     * Which security layer to use for connection (cleartext, ssl, tls, or tls if available).
     * If not set on data source, fallback to the id on global config.
     * @Accessor(getter="getConnectionType", setter="setConnectionType")
     * @SerializedName("connectionType")
     * @Type("Zimbra\Enum\ConnectionType")
     * @XmlAttribute
     */
    private $connectionType;

    /**
     * Login string on data-source-server, for example a user name
     * @Accessor(getter="getUsername", setter="setUsername")
     * @SerializedName("username")
     * @Type("string")
     * @XmlAttribute
     */
    private $username;

    /**
     * Login password for data source
     * @Accessor(getter="getPassword", setter="setPassword")
     * @SerializedName("password")
     * @Type("string")
     * @XmlAttribute
     */
    private $password;

    /**
     * Polling interval.  For instance "10m"
     * @Accessor(getter="getPollingInterval", setter="setPollingInterval")
     * @SerializedName("pollingInterval")
     * @Type("string")
     * @XmlAttribute
     */
    private $pollingInterval;

    /**
     * Email address for the data-source
     * @Accessor(getter="getEmailAddress", setter="setEmailAddress")
     * @SerializedName("emailAddress")
     * @Type("string")
     * @XmlAttribute
     */
    private $emailAddress;

    /**
     * Whether sending outbound mail using external SMTP server is enabled in this data source.
     * @Accessor(getter="isSmtpEnabled", setter="setSmtpEnabled")
     * @SerializedName("smtpEnabled")
     * @Type("bool")
     * @XmlAttribute
     */
    private $smtpEnabled;

    /**
     * Name of SMTP server. e.g. "smtp.myisp.com"
     * @Accessor(getter="getSmtpHost", setter="setSmtpHost")
     * @SerializedName("smtpHost")
     * @Type("string")
     * @XmlAttribute
     */
    private $smtpHost;

    /**
     * Port number of SMTP server. e.g. "465"
     * @Accessor(getter="getSmtpPort", setter="setSmtpPort")
     * @SerializedName("smtpPort")
     * @Type("integer")
     * @XmlAttribute
     */
    private $smtpPort;

    /**
     * Which security layer to use for connecting to SMTP host associated with this data source.
     * @Accessor(getter="getSmtpConnectionType", setter="setSmtpConnectionType")
     * @SerializedName("smtpConnectionType")
     * @Type("Zimbra\Enum\ConnectionType")
     * @XmlAttribute
     */
    private $smtpConnectionType;

    /**
     * Whether SMTP server associated with this data source requires authentication.
     * @Accessor(getter="isSmtpAuthRequired", setter="setSmtpAuthRequired")
     * @SerializedName("smtpAuthRequired")
     * @Type("bool")
     * @XmlAttribute
     */
    private $smtpAuthRequired;

    /**
     * Login username for SMTP server
     * @Accessor(getter="getSmtpUsername", setter="setSmtpUsername")
     * @SerializedName("smtpUsername")
     * @Type("string")
     * @XmlAttribute
     */
    private $smtpUsername;

    /**
     * Login password for SMTP server
     * @Accessor(getter="getSmtpPassword", setter="setSmtpPassword")
     * @SerializedName("smtpPassword")
     * @Type("string")
     * @XmlAttribute
     */
    private $smtpPassword;

    /**
     * When forwarding or replying to messages sent to this data source, this flags whether
     * or not to use the email address of the data source for the from address and the designated signature/replyTo
     * of the data source for the outgoing message.
     * @Accessor(getter="isUseAddressForForwardReply", setter="setUseAddressForForwardReply")
     * @SerializedName("useAddressForForwardReply")
     * @Type("bool")
     * @XmlAttribute
     */
    private $useAddressForForwardReply;

    /**
     * ID for default signature
     * @Accessor(getter="getDefaultSignature", setter="setDefaultSignature")
     * @SerializedName("defaultSignature")
     * @Type("string")
     * @XmlAttribute
     */
    private $defaultSignature;

    /**
     * Forward / Reply Signature ID for data source
     * @Accessor(getter="getForwardReplySignature", setter="setForwardReplySignature")
     * @SerializedName("forwardReplySignature")
     * @Type("string")
     * @XmlAttribute
     */
    private $forwardReplySignature;

    /**
     * Personal part of email address to put in the from header
     * @Accessor(getter="getFromDisplay", setter="setFromDisplay")
     * @SerializedName("fromDisplay")
     * @Type("string")
     * @XmlAttribute
     */
    private $fromDisplay;

    /**
     * Email address to put in the reply-to header
     * @Accessor(getter="getReplyToAddress", setter="setReplyToAddress")
     * @SerializedName("replyToAddress")
     * @Type("string")
     * @XmlAttribute
     */
    private $replyToAddress;

    /**
     * Personal part of Email address to put in the reply-to header
     * @Accessor(getter="getReplyToDisplay", setter="setReplyToDisplay")
     * @SerializedName("replyToDisplay")
     * @Type("string")
     * @XmlAttribute
     */
    private $replyToDisplay;

    /**
     * Data import class used bt this data source
     * @Accessor(getter="getImportClass", setter="setImportClass")
     * @SerializedName("importClass")
     * @Type("string")
     * @XmlAttribute
     */
    private $importClass;

    /**
     * Failing Since
     * @Accessor(getter="getFailingSince", setter="setFailingSince")
     * @SerializedName("failingSince")
     * @Type("integer")
     * @XmlAttribute
     */
    private $failingSince;

    /**
     * Last Error
     * @Accessor(getter="getLastError", setter="setLastError")
     * @SerializedName("lastError")
     * @Type("string")
     * @XmlElement(cdata = false)
     */
    private $lastError;

    /**
     * refresh token for refreshing data source oauth token
     * @Accessor(getter="getRefreshToken", setter="setRefreshToken")
     * @SerializedName("refreshToken")
     * @Type("string")
     * @XmlAttribute
     */
    private $refreshToken;

    /**
     * refreshTokenUrl for refreshing data source oauth token
     * @Accessor(getter="getRefreshTokenUrl", setter="setRefreshTokenUrl")
     * @SerializedName("refreshTokenUrl")
     * @Type("string")
     * @XmlAttribute
     */
    private $refreshTokenUrl;

    /**
     * Properties for the data source
     * @Accessor(getter="getAttributes", setter="setAttributes")
     * @SerializedName("a")
     * @Type("array<string>")
     * @XmlList(inline = true, entry = "a")
     */
    private $attributes;

    /**
     * Constructor method for MailDataSource
     * 
     * @param  string $id
     * @param  string $name
     * @param  string $folderId
     * @param  bool   $enabled
     * @param  bool   $importOnly
     * @param  string $host
     * @param  int    $port
     * @param  ConnectionType $connectionType
     * @param  string $username
     * @param  string $password
     * @param  string $pollingInterval
     * @param  string $emailAddress
     * @param  bool   $smtpEnabled
     * @param  string $smtpHost
     * @param  int    $smtpPort
     * @param  ConnectionType $smtpConnectionType
     * @param  bool   $smtpAuthRequired
     * @param  string $smtpUsername
     * @param  string $smtpPassword
     * @param  bool   $useAddressForForwardReply
     * @param  string $defaultSignature
     * @param  string $forwardReplySignature
     * @param  string $fromDisplay
     * @param  string $replyToAddress
     * @param  string $replyToDisplay
     * @param  string $importClass
     * @param  int    $failingSince
     * @param  string $lastError
     * @param  string $refreshToken
     * @param  string $refreshTokenUrl
     * @param  array  $attributes
     * @return self
     */
    public function __construct(
        ?string $id = NULL,
        ?string $name = NULL,
        ?string $folderId = NULL,
        ?bool $enabled = NULL,
        ?bool $importOnly = NULL,
        ?string $host = NULL,
        ?int $port = NULL,
        ?ConnectionType $connectionType = NULL,
        ?string $username = NULL,
        ?string $password = NULL,
        ?string $pollingInterval = NULL,
        ?string $emailAddress = NULL,
        ?bool $smtpEnabled = NULL,
        ?string $smtpHost = NULL,
        ?int $smtpPort = NULL,
        ?ConnectionType $smtpConnectionType = NULL,
        ?bool $smtpAuthRequired = NULL,
        ?string $smtpUsername = NULL,
        ?string $smtpPassword = NULL,
        ?bool $useAddressForForwardReply = NULL,
        ?string $defaultSignature = NULL,
        ?string $forwardReplySignature = NULL,
        ?string $fromDisplay = NULL,
        ?string $replyToAddress = NULL,
        ?string $replyToDisplay = NULL,
        ?string $importClass = NULL,
        ?int $failingSince = NULL,
        ?string $lastError = NULL,
        ?string $refreshToken = NULL,
        ?string $refreshTokenUrl = NULL,
        array $attributes = []
    )
    {
        if (NULL !== $id) {
            $this->setId($id);
        }
        if (NULL !== $name) {
            $this->setName($name);
        }
        if (NULL !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (NULL !== $enabled) {
            $this->setEnabled($enabled);
        }
        if (NULL !== $importOnly) {
            $this->setImportOnly($importOnly);
        }
        if (NULL !== $host) {
            $this->setHost($host);
        }
        if (NULL !== $port) {
            $this->setPort($port);
        }
        if ($connectionType instanceof ConnectionType) {
            $this->setConnectionType($connectionType);
        }
        if (NULL !== $username) {
            $this->setUsername($username);
        }
        if (NULL !== $password) {
            $this->setPassword($password);
        }
        if (NULL !== $pollingInterval) {
            $this->setPollingInterval($pollingInterval);
        }
        if (NULL !== $emailAddress) {
            $this->setEmailAddress($emailAddress);
        }
        if (NULL !== $smtpEnabled) {
            $this->setSmtpEnabled($smtpEnabled);
        }
        if (NULL !== $smtpHost) {
            $this->setSmtpHost($smtpHost);
        }
        if (NULL !== $smtpPort) {
            $this->setSmtpPort($smtpPort);
        }
        if ($smtpConnectionType instanceof ConnectionType) {
            $this->setSmtpConnectionType($smtpConnectionType);
        }
        if (NULL !== $smtpAuthRequired) {
            $this->setSmtpAuthRequired($smtpAuthRequired);
        }
        if (NULL !== $smtpUsername) {
            $this->setSmtpUsername($smtpUsername);
        }
        if (NULL !== $smtpPassword) {
            $this->setSmtpPassword($smtpPassword);
        }
        if (NULL !== $useAddressForForwardReply) {
            $this->setUseAddressForForwardReply($useAddressForForwardReply);
        }
        if (NULL !== $defaultSignature) {
            $this->setDefaultSignature($defaultSignature);
        }
        if (NULL !== $forwardReplySignature) {
            $this->setForwardReplySignature($forwardReplySignature);
        }
        if (NULL !== $fromDisplay) {
            $this->setFromDisplay($fromDisplay);
        }
        if (NULL !== $replyToAddress) {
            $this->setReplyToAddress($replyToAddress);
        }
        if (NULL !== $replyToDisplay) {
            $this->setReplyToDisplay($replyToDisplay);
        }
        if (NULL !== $importClass) {
            $this->setImportClass($importClass);
        }
        if (NULL !== $failingSince) {
            $this->setFailingSince($failingSince);
        }
        if (NULL !== $lastError) {
            $this->setLastError($lastError);
        }
        if (NULL !== $refreshToken) {
            $this->setRefreshToken($refreshToken);
        }
        if (NULL !== $refreshTokenUrl) {
            $this->setRefreshTokenUrl($refreshTokenUrl);
        }
        if (NULL !== $attributes) {
            $this->setAttributes($attributes);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets name
     *
     * @param  string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Sets folderId
     *
     * @param  string $folderId
     * @return self
     */
    public function setFolderId(string $folderId): self
    {
        $this->folderId = $folderId;
        return $this;
    }

    /**
     * Gets enabled
     *
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * Sets enabled
     *
     * @param  bool $enabled
     * @return self
     */
    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Gets importOnly
     *
     * @return bool
     */
    public function isImportOnly(): ?bool
    {
        return $this->importOnly;
    }

    /**
     * Sets importOnly
     *
     * @param  bool $importOnly
     * @return self
     */
    public function setImportOnly(bool $importOnly): self
    {
        $this->importOnly = $importOnly;
        return $this;
    }

    /**
     * Gets host
     *
     * @return string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Sets host
     *
     * @param  string $host
     * @return self
     */
    public function setHost(string $host): self
    {
        $this->host = $host;
        return $this;
    }

    /**
     * Gets port
     *
     * @return int
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * Sets port
     *
     * @param  int $port
     * @return self
     */
    public function setPort(int $port): self
    {
        $this->port = $port;
        return $this;
    }

    /**
     * Gets connectionType
     *
     * @return ConnectionType
     */
    public function getConnectionType(): ?ConnectionType
    {
        return $this->connectionType;
    }

    /**
     * Sets connectionType
     *
     * @param  ConnectionType $connectionType
     * @return self
     */
    public function setConnectionType(ConnectionType $connectionType): self
    {
        $this->connectionType = $connectionType;
        return $this;
    }

    /**
     * Gets username
     *
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Sets username
     *
     * @param  string $username
     * @return self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets password
     *
     * @param  string $password
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Gets pollingInterval
     *
     * @return string
     */
    public function getPollingInterval(): ?string
    {
        return $this->pollingInterval;
    }

    /**
     * Sets pollingInterval
     *
     * @param  string $pollingInterval
     * @return self
     */
    public function setPollingInterval(string $pollingInterval): self
    {
        $this->pollingInterval = $pollingInterval;
        return $this;
    }

    /**
     * Gets emailAddress
     *
     * @return string
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * Sets emailAddress
     *
     * @param  string $emailAddress
     * @return self
     */
    public function setEmailAddress(string $emailAddress): self
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * Gets smtpEnabled
     *
     * @return bool
     */
    public function isSmtpEnabled(): ?bool
    {
        return $this->smtpEnabled;
    }

    /**
     * Sets smtpEnabled
     *
     * @param  bool $smtpEnabled
     * @return self
     */
    public function setSmtpEnabled(bool $smtpEnabled): self
    {
        $this->smtpEnabled = $smtpEnabled;
        return $this;
    }

    /**
     * Gets smtpHost
     *
     * @return string
     */
    public function getSmtpHost(): ?string
    {
        return $this->smtpHost;
    }

    /**
     * Sets smtpHost
     *
     * @param  string $smtpHost
     * @return self
     */
    public function setSmtpHost(string $smtpHost): self
    {
        $this->smtpHost = $smtpHost;
        return $this;
    }

    /**
     * Gets smtpPort
     *
     * @return int
     */
    public function getSmtpPort(): ?int
    {
        return $this->smtpPort;
    }

    /**
     * Sets smtpPort
     *
     * @param  int $smtpPort
     * @return self
     */
    public function setSmtpPort(int $smtpPort): self
    {
        $this->smtpPort = $smtpPort;
        return $this;
    }

    /**
     * Gets smtpConnectionType
     *
     * @return ConnectionType
     */
    public function getSmtpConnectionType(): ?ConnectionType
    {
        return $this->smtpConnectionType;
    }

    /**
     * Sets smtpConnectionType
     *
     * @param  ConnectionType $smtpConnectionType
     * @return self
     */
    public function setSmtpConnectionType(ConnectionType $smtpConnectionType): self
    {
        $this->smtpConnectionType = $smtpConnectionType;
        return $this;
    }

    /**
     * Gets smtpAuthRequired
     *
     * @return bool
     */
    public function isSmtpAuthRequired(): ?bool
    {
        return $this->smtpAuthRequired;
    }

    /**
     * Sets smtpAuthRequired
     *
     * @param  bool $smtpAuthRequired
     * @return self
     */
    public function setSmtpAuthRequired(bool $smtpAuthRequired): self
    {
        $this->smtpAuthRequired = $smtpAuthRequired;
        return $this;
    }

    /**
     * Gets smtpUsername
     *
     * @return string
     */
    public function getSmtpUsername(): ?string
    {
        return $this->smtpUsername;
    }

    /**
     * Sets smtpUsername
     *
     * @param  string $smtpUsername
     * @return self
     */
    public function setSmtpUsername(string $smtpUsername): self
    {
        $this->smtpUsername = $smtpUsername;
        return $this;
    }

    /**
     * Gets smtpPassword
     *
     * @return string
     */
    public function getSmtpPassword(): ?string
    {
        return $this->smtpPassword;
    }

    /**
     * Sets smtpPassword
     *
     * @param  string $smtpPassword
     * @return self
     */
    public function setSmtpPassword(string $smtpPassword): self
    {
        $this->smtpPassword = $smtpPassword;
        return $this;
    }

    /**
     * Gets useAddressForForwardReply
     *
     * @return bool
     */
    public function isUseAddressForForwardReply(): ?bool
    {
        return $this->useAddressForForwardReply;
    }

    /**
     * Sets useAddressForForwardReply
     *
     * @param  bool $useAddressForForwardReply
     * @return self
     */
    public function setUseAddressForForwardReply(bool $useAddressForForwardReply): self
    {
        $this->useAddressForForwardReply = $useAddressForForwardReply;
        return $this;
    }

    /**
     * Gets defaultSignature
     *
     * @return string
     */
    public function getDefaultSignature(): ?string
    {
        return $this->defaultSignature;
    }

    /**
     * Sets defaultSignature
     *
     * @param  string $defaultSignature
     * @return self
     */
    public function setDefaultSignature(string $defaultSignature): self
    {
        $this->defaultSignature = $defaultSignature;
        return $this;
    }

    /**
     * Gets forwardReplySignature
     *
     * @return string
     */
    public function getForwardReplySignature(): ?string
    {
        return $this->forwardReplySignature;
    }

    /**
     * Sets forwardReplySignature
     *
     * @param  string $forwardReplySignature
     * @return self
     */
    public function setForwardReplySignature(string $forwardReplySignature): self
    {
        $this->forwardReplySignature = $forwardReplySignature;
        return $this;
    }

    /**
     * Gets fromDisplay
     *
     * @return string
     */
    public function getFromDisplay(): ?string
    {
        return $this->fromDisplay;
    }

    /**
     * Sets fromDisplay
     *
     * @param  string $fromDisplay
     * @return self
     */
    public function setFromDisplay(string $fromDisplay): self
    {
        $this->fromDisplay = $fromDisplay;
        return $this;
    }

    /**
     * Gets replyToAddress
     *
     * @return string
     */
    public function getReplyToAddress(): ?string
    {
        return $this->replyToAddress;
    }

    /**
     * Sets replyToAddress
     *
     * @param  string $replyToAddress
     * @return self
     */
    public function setReplyToAddress(string $replyToAddress): self
    {
        $this->replyToAddress = $replyToAddress;
        return $this;
    }

    /**
     * Gets replyToDisplay
     *
     * @return string
     */
    public function getReplyToDisplay(): ?string
    {
        return $this->replyToDisplay;
    }

    /**
     * Sets replyToDisplay
     *
     * @param  string $replyToDisplay
     * @return self
     */
    public function setReplyToDisplay(string $replyToDisplay): self
    {
        $this->replyToDisplay = $replyToDisplay;
        return $this;
    }

    /**
     * Gets importClass
     *
     * @return string
     */
    public function getImportClass(): ?string
    {
        return $this->importClass;
    }

    /**
     * Sets importClass
     *
     * @param  string $importClass
     * @return self
     */
    public function setImportClass(string $importClass): self
    {
        $this->importClass = $importClass;
        return $this;
    }

    /**
     * Gets failingSince
     *
     * @return int
     */
    public function getFailingSince(): ?int
    {
        return $this->failingSince;
    }

    /**
     * Sets failingSince
     *
     * @param  int $failingSince
     * @return self
     */
    public function setFailingSince(int $failingSince): self
    {
        $this->failingSince = $failingSince;
        return $this;
    }

    /**
     * Gets lastError
     *
     * @return string
     */
    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    /**
     * Sets lastError
     *
     * @param  string $lastError
     * @return self
     */
    public function setLastError(string $lastError): self
    {
        $this->lastError = $lastError;
        return $this;
    }

    /**
     * Gets attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Sets attributes
     *
     * @param  array $attributes
     * @return self
     */
    public function setAttributes(array $attributes): self
    {
        $this->attributes = [];
        foreach ($attributes as $attribute) {
            $this->addAttribute($attribute);
        }
        return $this;
    }

    /**
     * add attribute
     *
     * @param  string $attribute
     * @return self
     */
    public function addAttribute(string $attribute): self
    {
        $attribute = trim($attribute);
        if (!in_array($attribute, $this->attributes)) {
            $this->attributes[] = $attribute;
        }
        return $this;
    }

    /**
     * Gets refreshToken
     *
     * @return string
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * Sets refreshToken
     *
     * @param  string $refreshToken
     * @return self
     */
    public function setRefreshToken(string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    /**
     * Gets refreshTokenUrl
     *
     * @return string
     */
    public function getRefreshTokenUrl(): ?string
    {
        return $this->refreshTokenUrl;
    }

    /**
     * Sets refreshTokenUrl
     *
     * @param  string $refreshTokenUrl
     * @return self
     */
    public function setRefreshTokenUrl(string $refreshTokenUrl): self
    {
        $this->refreshTokenUrl = $refreshTokenUrl;
        return $this;
    }
}
