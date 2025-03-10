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

use JMS\Serializer\Annotation\{
    Accessor,
    SerializedName,
    Type,
    XmlAttribute,
    XmlElement,
    XmlList
};
use Zimbra\Common\Enum\ConnectionType;
use Zimbra\Common\Struct\DataSource;

/**
 * MailDataSource struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MailDataSource implements DataSource
{
    /**
     * Unique ID for data source
     *
     * @var string
     */
    #[Accessor(getter: "getId", setter: "setId")]
    #[SerializedName("id")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $id = null;

    /**
     * Name for data source
     *
     * @var string
     */
    #[Accessor(getter: "getName", setter: "setName")]
    #[SerializedName("name")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $name = null;

    /**
     * Folder ID for data source
     *
     * @var string
     */
    #[Accessor(getter: "getFolderId", setter: "setFolderId")]
    #[SerializedName("l")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $folderId = null;

    /**
     * Flag whether or not the data source is enabled
     *
     * @var bool
     */
    #[Accessor(getter: "isEnabled", setter: "setEnabled")]
    #[SerializedName("isEnabled")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $enabled = null;

    /**
     * indicates that this datasource is used for one way (incoming) import versus two-way sync
     *
     * @var bool
     */
    #[Accessor(getter: "isImportOnly", setter: "setImportOnly")]
    #[SerializedName("importOnly")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $importOnly = null;

    /**
     * Name of server
     * e.g. "imap.myisp.com"
     *
     * @var string
     */
    #[Accessor(getter: "getHost", setter: "setHost")]
    #[SerializedName("host")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $host = null;

    /**
     * Port number of server
     * e.g. "143"
     *
     * @var int
     */
    #[Accessor(getter: "getPort", setter: "setPort")]
    #[SerializedName("port")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $port = null;

    /**
     * Which security layer to use for connection (cleartext, ssl, tls, or tls if available).
     * If not set on data source, fallback to the id on global config.
     *
     * @var ConnectionType
     */
    #[Accessor(getter: "getConnectionType", setter: "setConnectionType")]
    #[SerializedName("connectionType")]
    #[XmlAttribute]
    private ?ConnectionType $connectionType;

    /**
     * Login string on data-source-server, for example a user name
     *
     * @var string
     */
    #[Accessor(getter: "getUsername", setter: "setUsername")]
    #[SerializedName("username")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $username = null;

    /**
     * Login password for data source
     *
     * @var string
     */
    #[Accessor(getter: "getPassword", setter: "setPassword")]
    #[SerializedName("password")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $password = null;

    /**
     * Polling interval. For instance "10m"
     *
     * @var string
     */
    #[Accessor(getter: "getPollingInterval", setter: "setPollingInterval")]
    #[SerializedName("pollingInterval")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $pollingInterval = null;

    /**
     * Email address for the data-source
     *
     * @var string
     */
    #[Accessor(getter: "getEmailAddress", setter: "setEmailAddress")]
    #[SerializedName("emailAddress")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $emailAddress = null;

    /**
     * Whether sending outbound mail using external SMTP server is enabled in this data source.
     *
     * @var bool
     */
    #[Accessor(getter: "isSmtpEnabled", setter: "setSmtpEnabled")]
    #[SerializedName("smtpEnabled")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $smtpEnabled = null;

    /**
     * Name of SMTP server. e.g. "smtp.myisp.com"
     *
     * @var string
     */
    #[Accessor(getter: "getSmtpHost", setter: "setSmtpHost")]
    #[SerializedName("smtpHost")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $smtpHost = null;

    /**
     * Port number of SMTP server. e.g. "465"
     *
     * @var int
     */
    #[Accessor(getter: "getSmtpPort", setter: "setSmtpPort")]
    #[SerializedName("smtpPort")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $smtpPort = null;

    /**
     * Which security layer to use for connecting to SMTP host associated with this data source.
     *
     * @var ConnectionType
     */
    #[
        Accessor(
            getter: "getSmtpConnectionType",
            setter: "setSmtpConnectionType"
        )
    ]
    #[SerializedName("smtpConnectionType")]
    #[XmlAttribute]
    private ?ConnectionType $smtpConnectionType;

    /**
     * Whether SMTP server associated with this data source requires authentication.
     *
     * @var bool
     */
    #[Accessor(getter: "isSmtpAuthRequired", setter: "setSmtpAuthRequired")]
    #[SerializedName("smtpAuthRequired")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $smtpAuthRequired = null;

    /**
     * Login username for SMTP server
     *
     * @var string
     */
    #[Accessor(getter: "getSmtpUsername", setter: "setSmtpUsername")]
    #[SerializedName("smtpUsername")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $smtpUsername = null;

    /**
     * Login password for SMTP server
     *
     * @var string
     */
    #[Accessor(getter: "getSmtpPassword", setter: "setSmtpPassword")]
    #[SerializedName("smtpPassword")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $smtpPassword = null;

    /**
     * When forwarding or replying to messages sent to this data source, this flags whether
     * or not to use the email address of the data source for the from address and the designated signature/replyTo
     * of the data source for the outgoing message.
     *
     * @var bool
     */
    #[
        Accessor(
            getter: "isUseAddressForForwardReply",
            setter: "setUseAddressForForwardReply"
        )
    ]
    #[SerializedName("useAddressForForwardReply")]
    #[Type("bool")]
    #[XmlAttribute]
    private ?bool $useAddressForForwardReply = null;

    /**
     * ID for default signature
     *
     * @var string
     */
    #[Accessor(getter: "getDefaultSignature", setter: "setDefaultSignature")]
    #[SerializedName("defaultSignature")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $defaultSignature = null;

    /**
     * Forward / Reply Signature ID for data source
     *
     * @var string
     */
    #[
        Accessor(
            getter: "getForwardReplySignature",
            setter: "setForwardReplySignature"
        )
    ]
    #[SerializedName("forwardReplySignature")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $forwardReplySignature = null;

    /**
     * Personal part of email address to put in the from header
     *
     * @var string
     */
    #[Accessor(getter: "getFromDisplay", setter: "setFromDisplay")]
    #[SerializedName("fromDisplay")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $fromDisplay = null;

    /**
     * Email address to put in the reply-to header
     *
     * @var string
     */
    #[Accessor(getter: "getReplyToAddress", setter: "setReplyToAddress")]
    #[SerializedName("replyToAddress")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $replyToAddress = null;

    /**
     * Personal part of Email address to put in the reply-to header
     *
     * @var string
     */
    #[Accessor(getter: "getReplyToDisplay", setter: "setReplyToDisplay")]
    #[SerializedName("replyToDisplay")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $replyToDisplay = null;

    /**
     * Data import class used bt this data source
     *
     * @var string
     */
    #[Accessor(getter: "getImportClass", setter: "setImportClass")]
    #[SerializedName("importClass")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $importClass = null;

    /**
     * Failing Since
     *
     * @var int
     */
    #[Accessor(getter: "getFailingSince", setter: "setFailingSince")]
    #[SerializedName("failingSince")]
    #[Type("int")]
    #[XmlAttribute]
    private ?int $failingSince = null;

    /**
     * Last Error
     *
     * @var string
     */
    #[Accessor(getter: "getLastError", setter: "setLastError")]
    #[SerializedName("lastError")]
    #[Type("string")]
    #[XmlElement(cdata: false, namespace: "urn:zimbraMail")]
    private ?string $lastError = null;

    /**
     * refresh token for refreshing data source oauth token
     *
     * @var string
     */
    #[Accessor(getter: "getRefreshToken", setter: "setRefreshToken")]
    #[SerializedName("refreshToken")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $refreshToken = null;

    /**
     * refreshTokenUrl for refreshing data source oauth token
     *
     * @var string
     */
    #[Accessor(getter: "getRefreshTokenUrl", setter: "setRefreshTokenUrl")]
    #[SerializedName("refreshTokenUrl")]
    #[Type("string")]
    #[XmlAttribute]
    private ?string $refreshTokenUrl = null;

    /**
     * Properties for the data source
     *
     * @var array
     */
    #[Accessor(getter: "getAttributes", setter: "setAttributes")]
    #[Type("array<string>")]
    #[XmlList(inline: true, entry: "a", namespace: "urn:zimbraMail")]
    private array $attributes = [];

    /**
     * Constructor
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
        ?string $id = null,
        ?string $name = null,
        ?string $folderId = null,
        ?bool $enabled = null,
        ?bool $importOnly = null,
        ?string $host = null,
        ?int $port = null,
        ?ConnectionType $connectionType = null,
        ?string $username = null,
        ?string $password = null,
        ?string $pollingInterval = null,
        ?string $emailAddress = null,
        ?bool $smtpEnabled = null,
        ?string $smtpHost = null,
        ?int $smtpPort = null,
        ?ConnectionType $smtpConnectionType = null,
        ?bool $smtpAuthRequired = null,
        ?string $smtpUsername = null,
        ?string $smtpPassword = null,
        ?bool $useAddressForForwardReply = null,
        ?string $defaultSignature = null,
        ?string $forwardReplySignature = null,
        ?string $fromDisplay = null,
        ?string $replyToAddress = null,
        ?string $replyToDisplay = null,
        ?string $importClass = null,
        ?int $failingSince = null,
        ?string $lastError = null,
        ?string $refreshToken = null,
        ?string $refreshTokenUrl = null,
        array $attributes = []
    ) {
        $this->connectionType = $connectionType;
        $this->smtpConnectionType = $smtpConnectionType;
        if (null !== $id) {
            $this->setId($id);
        }
        if (null !== $name) {
            $this->setName($name);
        }
        if (null !== $folderId) {
            $this->setFolderId($folderId);
        }
        if (null !== $enabled) {
            $this->setEnabled($enabled);
        }
        if (null !== $importOnly) {
            $this->setImportOnly($importOnly);
        }
        if (null !== $host) {
            $this->setHost($host);
        }
        if (null !== $port) {
            $this->setPort($port);
        }
        if (null !== $username) {
            $this->setUsername($username);
        }
        if (null !== $password) {
            $this->setPassword($password);
        }
        if (null !== $pollingInterval) {
            $this->setPollingInterval($pollingInterval);
        }
        if (null !== $emailAddress) {
            $this->setEmailAddress($emailAddress);
        }
        if (null !== $smtpEnabled) {
            $this->setSmtpEnabled($smtpEnabled);
        }
        if (null !== $smtpHost) {
            $this->setSmtpHost($smtpHost);
        }
        if (null !== $smtpPort) {
            $this->setSmtpPort($smtpPort);
        }
        if (null !== $smtpAuthRequired) {
            $this->setSmtpAuthRequired($smtpAuthRequired);
        }
        if (null !== $smtpUsername) {
            $this->setSmtpUsername($smtpUsername);
        }
        if (null !== $smtpPassword) {
            $this->setSmtpPassword($smtpPassword);
        }
        if (null !== $useAddressForForwardReply) {
            $this->setUseAddressForForwardReply($useAddressForForwardReply);
        }
        if (null !== $defaultSignature) {
            $this->setDefaultSignature($defaultSignature);
        }
        if (null !== $forwardReplySignature) {
            $this->setForwardReplySignature($forwardReplySignature);
        }
        if (null !== $fromDisplay) {
            $this->setFromDisplay($fromDisplay);
        }
        if (null !== $replyToAddress) {
            $this->setReplyToAddress($replyToAddress);
        }
        if (null !== $replyToDisplay) {
            $this->setReplyToDisplay($replyToDisplay);
        }
        if (null !== $importClass) {
            $this->setImportClass($importClass);
        }
        if (null !== $failingSince) {
            $this->setFailingSince($failingSince);
        }
        if (null !== $lastError) {
            $this->setLastError($lastError);
        }
        if (null !== $refreshToken) {
            $this->setRefreshToken($refreshToken);
        }
        if (null !== $refreshTokenUrl) {
            $this->setRefreshTokenUrl($refreshTokenUrl);
        }
        if (null !== $attributes) {
            $this->setAttributes($attributes);
        }
    }

    /**
     * Get id
     *
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Set id
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
     * Get name
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set name
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
     * Get folderId
     *
     * @return string
     */
    public function getFolderId(): ?string
    {
        return $this->folderId;
    }

    /**
     * Set folderId
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
     * Get enabled
     *
     * @return bool
     */
    public function isEnabled(): ?bool
    {
        return $this->enabled;
    }

    /**
     * Set enabled
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
     * Get importOnly
     *
     * @return bool
     */
    public function isImportOnly(): ?bool
    {
        return $this->importOnly;
    }

    /**
     * Set importOnly
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
     * Get host
     *
     * @return string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * Set host
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
     * Get port
     *
     * @return int
     */
    public function getPort(): ?int
    {
        return $this->port;
    }

    /**
     * Set port
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
     * Get connectionType
     *
     * @return ConnectionType
     */
    public function getConnectionType(): ?ConnectionType
    {
        return $this->connectionType;
    }

    /**
     * Set connectionType
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
     * Get username
     *
     * @return string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set username
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
     * Get password
     *
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set password
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
     * Get pollingInterval
     *
     * @return string
     */
    public function getPollingInterval(): ?string
    {
        return $this->pollingInterval;
    }

    /**
     * Set pollingInterval
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
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * Set emailAddress
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
     * Get smtpEnabled
     *
     * @return bool
     */
    public function isSmtpEnabled(): ?bool
    {
        return $this->smtpEnabled;
    }

    /**
     * Set smtpEnabled
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
     * Get smtpHost
     *
     * @return string
     */
    public function getSmtpHost(): ?string
    {
        return $this->smtpHost;
    }

    /**
     * Set smtpHost
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
     * Get smtpPort
     *
     * @return int
     */
    public function getSmtpPort(): ?int
    {
        return $this->smtpPort;
    }

    /**
     * Set smtpPort
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
     * Get smtpConnectionType
     *
     * @return ConnectionType
     */
    public function getSmtpConnectionType(): ?ConnectionType
    {
        return $this->smtpConnectionType;
    }

    /**
     * Set smtpConnectionType
     *
     * @param  ConnectionType $smtpConnectionType
     * @return self
     */
    public function setSmtpConnectionType(
        ConnectionType $smtpConnectionType
    ): self {
        $this->smtpConnectionType = $smtpConnectionType;
        return $this;
    }

    /**
     * Get smtpAuthRequired
     *
     * @return bool
     */
    public function isSmtpAuthRequired(): ?bool
    {
        return $this->smtpAuthRequired;
    }

    /**
     * Set smtpAuthRequired
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
     * Get smtpUsername
     *
     * @return string
     */
    public function getSmtpUsername(): ?string
    {
        return $this->smtpUsername;
    }

    /**
     * Set smtpUsername
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
     * Get smtpPassword
     *
     * @return string
     */
    public function getSmtpPassword(): ?string
    {
        return $this->smtpPassword;
    }

    /**
     * Set smtpPassword
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
     * Get useAddressForForwardReply
     *
     * @return bool
     */
    public function isUseAddressForForwardReply(): ?bool
    {
        return $this->useAddressForForwardReply;
    }

    /**
     * Set useAddressForForwardReply
     *
     * @param  bool $useAddressForForwardReply
     * @return self
     */
    public function setUseAddressForForwardReply(
        bool $useAddressForForwardReply
    ): self {
        $this->useAddressForForwardReply = $useAddressForForwardReply;
        return $this;
    }

    /**
     * Get defaultSignature
     *
     * @return string
     */
    public function getDefaultSignature(): ?string
    {
        return $this->defaultSignature;
    }

    /**
     * Set defaultSignature
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
     * Get forwardReplySignature
     *
     * @return string
     */
    public function getForwardReplySignature(): ?string
    {
        return $this->forwardReplySignature;
    }

    /**
     * Set forwardReplySignature
     *
     * @param  string $forwardReplySignature
     * @return self
     */
    public function setForwardReplySignature(
        string $forwardReplySignature
    ): self {
        $this->forwardReplySignature = $forwardReplySignature;
        return $this;
    }

    /**
     * Get fromDisplay
     *
     * @return string
     */
    public function getFromDisplay(): ?string
    {
        return $this->fromDisplay;
    }

    /**
     * Set fromDisplay
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
     * Get replyToAddress
     *
     * @return string
     */
    public function getReplyToAddress(): ?string
    {
        return $this->replyToAddress;
    }

    /**
     * Set replyToAddress
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
     * Get replyToDisplay
     *
     * @return string
     */
    public function getReplyToDisplay(): ?string
    {
        return $this->replyToDisplay;
    }

    /**
     * Set replyToDisplay
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
     * Get importClass
     *
     * @return string
     */
    public function getImportClass(): ?string
    {
        return $this->importClass;
    }

    /**
     * Set importClass
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
     * Get failingSince
     *
     * @return int
     */
    public function getFailingSince(): ?int
    {
        return $this->failingSince;
    }

    /**
     * Set failingSince
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
     * Get lastError
     *
     * @return string
     */
    public function getLastError(): ?string
    {
        return $this->lastError;
    }

    /**
     * Set lastError
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
     * Get attributes
     *
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * Set attributes
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
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * Set refreshToken
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
     * Get refreshTokenUrl
     *
     * @return string
     */
    public function getRefreshTokenUrl(): ?string
    {
        return $this->refreshTokenUrl;
    }

    /**
     * Set refreshTokenUrl
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
