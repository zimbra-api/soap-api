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
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName(name: 'id')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $id;

    /**
     * Name for data source
     * 
     * @var string
     */
    #[Accessor(getter: 'getName', setter: 'setName')]
    #[SerializedName(name: 'name')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $name;

    /**
     * Folder ID for data source
     * 
     * @var string
     */
    #[Accessor(getter: 'getFolderId', setter: 'setFolderId')]
    #[SerializedName(name: 'l')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $folderId;

    /**
     * Flag whether or not the data source is enabled
     * 
     * @var bool
     */
    #[Accessor(getter: 'isEnabled', setter: 'setEnabled')]
    #[SerializedName(name: 'isEnabled')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $enabled;

    /**
     * indicates that this datasource is used for one way (incoming) import versus two-way sync
     * 
     * @var bool
     */
    #[Accessor(getter: 'isImportOnly', setter: 'setImportOnly')]
    #[SerializedName(name: 'importOnly')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $importOnly;

    /**
     * Name of server
     * e.g. "imap.myisp.com"
     * 
     * @var string
     */
    #[Accessor(getter: 'getHost', setter: 'setHost')]
    #[SerializedName(name: 'host')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $host;

    /**
     * Port number of server
     * e.g. "143"
     * 
     * @var int
     */
    #[Accessor(getter: 'getPort', setter: 'setPort')]
    #[SerializedName(name: 'port')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $port;

    /**
     * Which security layer to use for connection (cleartext, ssl, tls, or tls if available).
     * If not set on data source, fallback to the id on global config.
     * 
     * @var ConnectionType
     */
    #[Accessor(getter: 'getConnectionType', setter: 'setConnectionType')]
    #[SerializedName(name: 'connectionType')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ConnectionType>')]
    #[XmlAttribute]
    private $connectionType;

    /**
     * Login string on data-source-server, for example a user name
     * 
     * @var string
     */
    #[Accessor(getter: 'getUsername', setter: 'setUsername')]
    #[SerializedName(name: 'username')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $username;

    /**
     * Login password for data source
     * 
     * @var string
     */
    #[Accessor(getter: 'getPassword', setter: 'setPassword')]
    #[SerializedName(name: 'password')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $password;

    /**
     * Polling interval.  For instance "10m"
     * 
     * @var string
     */
    #[Accessor(getter: 'getPollingInterval', setter: 'setPollingInterval')]
    #[SerializedName(name: 'pollingInterval')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $pollingInterval;

    /**
     * Email address for the data-source
     * 
     * @var string
     */
    #[Accessor(getter: 'getEmailAddress', setter: 'setEmailAddress')]
    #[SerializedName(name: 'emailAddress')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $emailAddress;

    /**
     * Whether sending outbound mail using external SMTP server is enabled in this data source.
     * 
     * @var bool
     */
    #[Accessor(getter: 'isSmtpEnabled', setter: 'setSmtpEnabled')]
    #[SerializedName(name: 'smtpEnabled')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $smtpEnabled;

    /**
     * Name of SMTP server. e.g. "smtp.myisp.com"
     * 
     * @var string
     */
    #[Accessor(getter: 'getSmtpHost', setter: 'setSmtpHost')]
    #[SerializedName(name: 'smtpHost')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $smtpHost;

    /**
     * Port number of SMTP server. e.g. "465"
     * 
     * @var int
     */
    #[Accessor(getter: 'getSmtpPort', setter: 'setSmtpPort')]
    #[SerializedName(name: 'smtpPort')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $smtpPort;

    /**
     * Which security layer to use for connecting to SMTP host associated with this data source.
     * 
     * @var ConnectionType
     */
    #[Accessor(getter: 'getSmtpConnectionType', setter: 'setSmtpConnectionType')]
    #[SerializedName(name: 'smtpConnectionType')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\ConnectionType>')]
    #[XmlAttribute]
    private $smtpConnectionType;

    /**
     * Whether SMTP server associated with this data source requires authentication.
     * 
     * @var bool
     */
    #[Accessor(getter: 'isSmtpAuthRequired', setter: 'setSmtpAuthRequired')]
    #[SerializedName(name: 'smtpAuthRequired')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $smtpAuthRequired;

    /**
     * Login username for SMTP server
     * 
     * @var string
     */
    #[Accessor(getter: 'getSmtpUsername', setter: 'setSmtpUsername')]
    #[SerializedName(name: 'smtpUsername')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $smtpUsername;

    /**
     * Login password for SMTP server
     * 
     * @var string
     */
    #[Accessor(getter: 'getSmtpPassword', setter: 'setSmtpPassword')]
    #[SerializedName(name: 'smtpPassword')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $smtpPassword;

    /**
     * When forwarding or replying to messages sent to this data source, this flags whether
     * or not to use the email address of the data source for the from address and the designated signature/replyTo
     * of the data source for the outgoing message.
     * 
     * @var bool
     */
    #[Accessor(getter: 'isUseAddressForForwardReply', setter: 'setUseAddressForForwardReply')]
    #[SerializedName(name: 'useAddressForForwardReply')]
    #[Type(name: 'bool')]
    #[XmlAttribute]
    private $useAddressForForwardReply;

    /**
     * ID for default signature
     * 
     * @var string
     */
    #[Accessor(getter: 'getDefaultSignature', setter: 'setDefaultSignature')]
    #[SerializedName(name: 'defaultSignature')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $defaultSignature;

    /**
     * Forward / Reply Signature ID for data source
     * 
     * @var string
     */
    #[Accessor(getter: 'getForwardReplySignature', setter: 'setForwardReplySignature')]
    #[SerializedName(name: 'forwardReplySignature')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $forwardReplySignature;

    /**
     * Personal part of email address to put in the from header
     * 
     * @var string
     */
    #[Accessor(getter: 'getFromDisplay', setter: 'setFromDisplay')]
    #[SerializedName(name: 'fromDisplay')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $fromDisplay;

    /**
     * Email address to put in the reply-to header
     * 
     * @var string
     */
    #[Accessor(getter: 'getReplyToAddress', setter: 'setReplyToAddress')]
    #[SerializedName(name: 'replyToAddress')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $replyToAddress;

    /**
     * Personal part of Email address to put in the reply-to header
     * 
     * @var string
     */
    #[Accessor(getter: 'getReplyToDisplay', setter: 'setReplyToDisplay')]
    #[SerializedName(name: 'replyToDisplay')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $replyToDisplay;

    /**
     * Data import class used bt this data source
     * 
     * @var string
     */
    #[Accessor(getter: 'getImportClass', setter: 'setImportClass')]
    #[SerializedName(name: 'importClass')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $importClass;

    /**
     * Failing Since
     * 
     * @var int
     */
    #[Accessor(getter: 'getFailingSince', setter: 'setFailingSince')]
    #[SerializedName(name: 'failingSince')]
    #[Type(name: 'int')]
    #[XmlAttribute]
    private $failingSince;

    /**
     * Last Error
     * 
     * @var string
     */
    #[Accessor(getter: "getLastError", setter: "setLastError")]
    #[SerializedName(name: 'lastError')]
    #[Type(name: 'string')]
    #[XmlElement(cdata: false, namespace: 'urn:zimbraMail')]
    private $lastError;

    /**
     * refresh token for refreshing data source oauth token
     * 
     * @var string
     */
    #[Accessor(getter: 'getRefreshToken', setter: 'setRefreshToken')]
    #[SerializedName(name: 'refreshToken')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $refreshToken;

    /**
     * refreshTokenUrl for refreshing data source oauth token
     * 
     * @var string
     */
    #[Accessor(getter: 'getRefreshTokenUrl', setter: 'setRefreshTokenUrl')]
    #[SerializedName(name: 'refreshTokenUrl')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $refreshTokenUrl;

    /**
     * Properties for the data source
     * 
     * @var array
     */
    #[Accessor(getter: 'getAttributes', setter: 'setAttributes')]
    #[Type(name: 'array<string>')]
    #[XmlList(inline: true, entry: 'a', namespace: 'urn:zimbraMail')]
    private $attributes = [];

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
    public function setSmtpConnectionType(ConnectionType $smtpConnectionType): self
    {
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
    public function setUseAddressForForwardReply(bool $useAddressForForwardReply): self
    {
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
    public function setForwardReplySignature(string $forwardReplySignature): self
    {
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
