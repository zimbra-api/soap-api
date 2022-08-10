<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Account\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement, XmlList};
use Zimbra\Account\Struct\{
    AccountDataSources,
    AccountZimletInfo,
    Attr,
    ChildAccount,
    Cos,
    DiscoverRightsInfo,
    Identity,
    Pref,
    Prop,
    Signature
};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetInfoResponse class
 *
 * @package    Zimbra
 * @subpackage Account
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetInfoResponse extends SoapResponse
{
    /**
     * The size limit for attachments - Use "-1" to mean unlimited
     * 
     * @Accessor(getter="getAttachmentSizeLimit", setter="setAttachmentSizeLimit")
     * @SerializedName("attSizeLimit")
     * @Type("int")
     * @XmlAttribute
     */
    private $attachmentSizeLimit;

    /**
     * The size limit for documents
     * 
     * @Accessor(getter="getDocumentSizeLimit", setter="setDocumentSizeLimit")
     * @SerializedName("docSizeLimit")
     * @Type("int")
     * @XmlAttribute
     */
    private $documentSizeLimit;

    /**
     * Server version: <major>[.<minor>[.<maintenance>]][build] <release> <date>[<type>]
     * 
     * @Accessor(getter="getVersion", setter="setVersion")
     * @SerializedName("version")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $version;

    /**
     * Account ID
     * 
     * @Accessor(getter="getAccountId", setter="setAccountId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $accountId;

    /**
     * Profile image ID
     * 
     * @Accessor(getter="getProfileImageId", setter="setProfileImageId")
     * @SerializedName("profileImageId")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $profileImageId;

    /**
     * Email address (user@domain)
     * 
     * @Accessor(getter="getAccountName", setter="setAccountName")
     * @SerializedName("name")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $accountName;

    /**
     * Crumb
     * 
     * @Accessor(getter="getCrumb", setter="setCrumb")
     * @SerializedName("crumb")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $crumb;

    /**
     * Number of milliseconds until auth token expires
     * 
     * @Accessor(getter="getLifetime", setter="setLifetime")
     * @SerializedName("lifetime")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $lifetime;

    /**
     * 1 (true) if the auth token is a delegated auth token issued to an admin account
     * 
     * @Accessor(getter="getAdminDelegated", setter="setAdminDelegated")
     * @SerializedName("adminDelegated")
     * @Type("bool")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $adminDelegated;

    /**
     * Base REST URL for the requested account
     * 
     * @Accessor(getter="getRestUrl", setter="setRestUrl")
     * @SerializedName("rest")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $restUrl;

    /**
     * Mailbox quota used in bytes.
     * 
     * Returned only if the command successfully executes on the target user's home mail server
     * @Accessor(getter="getQuotaUsed", setter="setQuotaUsed")
     * @SerializedName("used")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $quotaUsed;

    /**
     * Time (in millis) of last write op from this session, or from *any* SOAP session if we don't have one
     * Returned only if the command successfully executes on the target user's home mail server
     * 
     * @Accessor(getter="getPreviousSessionTime", setter="setPreviousSessionTime")
     * @SerializedName("prevSession")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $previousSessionTime;

    /**
     * Time (in millis) of last write op from any SOAP session before this session was initiated,
     * or same as {previous-SOAP-session-time} if we don't have one.
     * Returned only if the command successfully executes on the target user's home mail server
     * 
     * @Accessor(getter="getLastWriteAccessTime", setter="setLastWriteAccessTime")
     * @SerializedName("accessed")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $lastWriteAccessTime;

    /**
     * Number of messages received since the previous soap session, or since the last SOAP write op if we don't have a session.
     * Returned only if the command successfully executes on the target user's home mail server
     * 
     * @Accessor(getter="getRecentMessageCount", setter="setRecentMessageCount")
     * @SerializedName("recent")
     * @Type("int")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $recentMessageCount;

    /**
     * Class of service
     * 
     * @Accessor(getter="getCos", setter="setCos")
     * @SerializedName("cos")
     * @Type("Zimbra\Account\Struct\Cos")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @var Cos
     */
    private $cos;

    /**
     * User-settable preferences
     * 
     * @Accessor(getter="getPrefs", setter="setPrefs")
     * @SerializedName("prefs")
     * @Type("array<Zimbra\Account\Struct\Pref>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="pref", namespace="urn:zimbraAccount")
     */
    private $prefs = [];

    /**
     * Account attributes that aren't user-settable, but the front-end needs.
     * Only attributes listed in zimbraAccountClientAttrs will be returned.
     * 
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("array<Zimbra\Account\Struct\Attr>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="attr", namespace="urn:zimbraAccount")
     */
    private $attrs = [];

    /**
     * Zimlets
     * 
     * @Accessor(getter="getZimlets", setter="setZimlets")
     * @SerializedName("zimlets")
     * @Type("array<Zimbra\Account\Struct\AccountZimletInfo>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="zimlet", namespace="urn:zimbraAccount")
     */
    private $zimlets = [];

    /**
     * Properties
     * 
     * @Accessor(getter="getProps", setter="setProps")
     * @SerializedName("props")
     * @Type("array<Zimbra\Account\Struct\Prop>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="prop", namespace="urn:zimbraAccount")
     */
    private $props = [];

    /**
     * Identities
     * 
     * @Accessor(getter="getIdentities", setter="setIdentities")
     * @SerializedName("identities")
     * @Type("array<Zimbra\Account\Struct\Identity>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="identity", namespace="urn:zimbraAccount")
     */
    private $identities = [];

    /**
     * Signatures
     * 
     * @Accessor(getter="getSignatures", setter="setSignatures")
     * @SerializedName("signatures")
     * @Type("array<Zimbra\Account\Struct\Signature>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="signature", namespace="urn:zimbraAccount")
     */
    private $signatures = [];

    /**
     * Data sources
     * 
     * @Accessor(getter="getAccountDataSources", setter="setAccountDataSources")
     * @SerializedName("dataSources")
     * @Type("Zimbra\Account\Struct\AccountDataSources")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @var AccountDataSources
     */
    private $dataSources;

    /**
     * Child accounts
     * 
     * @Accessor(getter="getChildAccounts", setter="setChildAccounts")
     * @SerializedName("childAccounts")
     * @Type("array<Zimbra\Account\Struct\ChildAccount>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="childAccount", namespace="urn:zimbraAccount")
     */
    private $childAccounts = [];

    /**
     * Discovered Rights - same as for DiscoverRightsResponse
     * 
     * @Accessor(getter="getDiscoveredRights", setter="setDiscoveredRights")
     * @SerializedName("rights")
     * @Type("array<Zimbra\Account\Struct\DiscoverRightsInfo>")
     * @XmlElement(namespace="urn:zimbraAccount")
     * @XmlList(inline=false, entry="targets", namespace="urn:zimbraAccount")
     */
    private $discoveredRights = [];

    /**
     * URL to talk to for soap service for this account.
     * 
     * @Accessor(getter="getSoapURL", setter="setSoapURL")
     * @SerializedName("soapURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $soapURL;

    /**
     * Base public URL for the requested account
     * 
     * @Accessor(getter="getPublicURL", setter="setPublicURL")
     * @SerializedName("publicURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $publicURL;

    /**
     * URL to talk to in order to change a password.
     * Not returned if not configured via domain attribute zimbraChangePasswordURL
     * 
     * @Accessor(getter="getChangePasswordURL", setter="setChangePasswordURL")
     * @SerializedName("changePasswordURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $changePasswordURL;

    /**
     * base URL for accessing the admin console
     * 
     * @Accessor(getter="getAdminURL", setter="setAdminURL")
     * @SerializedName("adminURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $adminURL;

    /**
     * Proxy URL for accessing XMPP over BOSH.
     * Should be returned only when zimbraFeatureChatEnabled is set to TRUE for Account/COS
     * 
     * @Accessor(getter="getBoshURL", setter="setBoshURL")
     * @SerializedName("boshURL")
     * @Type("string")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $boshURL;

    /**
     * Boolean value denoting if this account has logged in over IMAP.
     * 
     * @Accessor(getter="getIsTrackingIMAP", setter="setIsTrackingIMAP")
     * @SerializedName("isTrackingIMAP")
     * @Type("bool")
     * @XmlElement(cdata=false, namespace="urn:zimbraAccount")
     */
    private $isTrackingIMAP;

    /**
     * Constructor
     *
     * @param int $attachmentSizeLimit
     * @param int $documentSizeLimit
     * @param string $version
     * @param string $accountId
     * @param int $profileImageId
     * @param string $accountName
     * @param string $crumb
     * @param int $lifetime
     * @param bool $adminDelegated
     * @param string $restUrl
     * @param int $quotaUsed
     * @param int $previousSessionTime
     * @param int $lastWriteAccessTime
     * @param int $recentMessageCount
     * @param Cos $cos
     * @param array $prefs
     * @param array $attrs
     * @param array $zimlets
     * @param array $props
     * @param array $identities
     * @param array $signatures
     * @param array $dataSources
     * @param array $childAccounts
     * @param array $discoveredRights
     * @param string $soapURL
     * @param string $publicURL
     * @param string $changePasswordURL
     * @param string $adminURL
     * @param string $boshURL
     * @param bool $isTrackingIMAP
     * @return self
     */
    public function __construct(
        ?int $attachmentSizeLimit = NULL,
        ?int $documentSizeLimit = NULL,
        ?string $version = NULL,
        ?string $accountId = NULL,
        ?int $profileImageId = NULL,
        ?string $accountName = NULL,
        ?string $crumb = NULL,
        ?int $lifetime = NULL,
        ?bool $adminDelegated = NULL,
        ?string $restUrl = NULL,
        ?int $quotaUsed = NULL,
        ?int $previousSessionTime = NULL,
        ?int $lastWriteAccessTime = NULL,
        ?int $recentMessageCount = NULL,
        ?Cos $cos = NULL,
        array $prefs = [],
        array $attrs = [],
        array $zimlets = [],
        array $props = [],
        array $identities = [],
        array $signatures = [],
        array $dataSources = [],
        array $childAccounts = [],
        array $discoveredRights = [],
        ?string $soapURL = NULL,
        ?string $publicURL = NULL,
        ?string $changePasswordURL = NULL,
        ?string $adminURL = NULL,
        ?string $boshURL = NULL,
        ?bool $isTrackingIMAP = NULL
    )
    {
        if (NULL !== $attachmentSizeLimit) {
            $this->setAttachmentSizeLimit($attachmentSizeLimit);
        }
        if (NULL !== $documentSizeLimit) {
            $this->setDocumentSizeLimit($documentSizeLimit);
        }
        if (NULL !== $version) {
            $this->setVersion($version);
        }
        if (NULL !== $accountId) {
            $this->setAccountId($accountId);
        }
        if (NULL !== $profileImageId) {
            $this->setProfileImageId($profileImageId);
        }
        if (NULL !== $accountName) {
            $this->setAccountName($accountName);
        }
        if (NULL !== $crumb) {
            $this->setCrumb($crumb);
        }
        if (NULL !== $lifetime) {
            $this->setLifetime($lifetime);
        }
        if (NULL !== $adminDelegated) {
            $this->setAdminDelegated($adminDelegated);
        }
        if (NULL !== $restUrl) {
            $this->setRestUrl($restUrl);
        }
        if (NULL !== $quotaUsed) {
            $this->setQuotaUsed($quotaUsed);
        }
        if (NULL !== $previousSessionTime) {
            $this->setPreviousSessionTime($previousSessionTime);
        }
        if (NULL !== $lastWriteAccessTime) {
            $this->setLastWriteAccessTime($lastWriteAccessTime);
        }
        if (NULL !== $recentMessageCount) {
            $this->setRecentMessageCount($recentMessageCount);
        }
        if ($cos instanceof Cos) {
            $this->setCos($cos);
        }
        $this->setPrefs($prefs)
             ->setAttrs($attrs)
             ->setZimlets($zimlets)
             ->setProps($props)
             ->setIdentities($identities)
             ->setSignatures($signatures)
             ->setDataSources($dataSources)
             ->setChildAccounts($childAccounts)
             ->setDiscoveredRights($discoveredRights);
        if (NULL !== $soapURL) {
            $this->setSoapURL($soapURL);
        }
        if (NULL !== $publicURL) {
            $this->setPublicURL($publicURL);
        }
        if (NULL !== $changePasswordURL) {
            $this->setChangePasswordURL($changePasswordURL);
        }
        if (NULL !== $adminURL) {
            $this->setAdminURL($adminURL);
        }
        if (NULL !== $boshURL) {
            $this->setBoshURL($boshURL);
        }
        if (NULL !== $isTrackingIMAP) {
            $this->setIsTrackingIMAP($isTrackingIMAP);
        }
    }

    /**
     * Get the attachmentSizeLimit.
     *
     * @return int
     */
    public function getAttachmentSizeLimit(): ?int
    {
        return $this->attachmentSizeLimit;
    }

    /**
     * Set the attachmentSizeLimit.
     *
     * @param  int $attachmentSizeLimit
     * @return self
     */
    public function setAttachmentSizeLimit(int $attachmentSizeLimit): self
    {
        $this->attachmentSizeLimit = $attachmentSizeLimit;
        return $this;
    }

    /**
     * Get the documentSizeLimit.
     *
     * @return int
     */
    public function getDocumentSizeLimit(): ?int
    {
        return $this->documentSizeLimit;
    }

    /**
     * Set the documentSizeLimit.
     *
     * @param  int $documentSizeLimit
     * @return self
     */
    public function setDocumentSizeLimit(int $documentSizeLimit): self
    {
        $this->documentSizeLimit = $documentSizeLimit;
        return $this;
    }

    /**
     * Get the version.
     *
     * @return string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * Set the version.
     *
     * @param  string $version
     * @return self
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Get the accountId.
     *
     * @return string
     */
    public function getAccountId(): ?string
    {
        return $this->accountId;
    }

    /**
     * Set the accountId.
     *
     * @param  string $accountId
     * @return self
     */
    public function setAccountId(string $accountId): self
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Get the profileImageId.
     *
     * @return int
     */
    public function getProfileImageId(): ?int
    {
        return $this->profileImageId;
    }

    /**
     * Set the profileImageId.
     *
     * @param  int $profileImageId
     * @return self
     */
    public function setProfileImageId(int $profileImageId): self
    {
        $this->profileImageId = $profileImageId;
        return $this;
    }

    /**
     * Get the accountName.
     *
     * @return string
     */
    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    /**
     * Set the accountName.
     *
     * @param  string $accountName
     * @return self
     */
    public function setAccountName(string $accountName): self
    {
        $this->accountName = $accountName;
        return $this;
    }

    /**
     * Get the crumb.
     *
     * @return string
     */
    public function getCrumb(): ?string
    {
        return $this->crumb;
    }

    /**
     * Set the crumb.
     *
     * @param  string $crumb
     * @return self
     */
    public function setCrumb(string $crumb): self
    {
        $this->crumb = $crumb;
        return $this;
    }

    /**
     * Get the lifetime.
     *
     * @return int
     */
    public function getLifetime(): ?int
    {
        return $this->lifetime;
    }

    /**
     * Set the lifetime.
     *
     * @param  int $lifetime
     * @return self
     */
    public function setLifetime(int $lifetime): self
    {
        $this->lifetime = $lifetime;
        return $this;
    }

    /**
     * Get the adminDelegated.
     *
     * @return bool
     */
    public function getAdminDelegated(): ?bool
    {
        return $this->adminDelegated;
    }

    /**
     * Set the adminDelegated.
     *
     * @param  bool $adminDelegated
     * @return self
     */
    public function setAdminDelegated(bool $adminDelegated): self
    {
        $this->adminDelegated = $adminDelegated;
        return $this;
    }

    /**
     * Get the restUrl.
     *
     * @return string
     */
    public function getRestUrl(): ?string
    {
        return $this->restUrl;
    }

    /**
     * Set the restUrl.
     *
     * @param  string $restUrl
     * @return self
     */
    public function setRestUrl(string $restUrl): self
    {
        $this->restUrl = $restUrl;
        return $this;
    }

    /**
     * Get the quotaUsed.
     *
     * @return int
     */
    public function getQuotaUsed(): ?int
    {
        return $this->quotaUsed;
    }

    /**
     * Set the quotaUsed.
     *
     * @param  int $quotaUsed
     * @return self
     */
    public function setQuotaUsed(int $quotaUsed): self
    {
        $this->quotaUsed = $quotaUsed;
        return $this;
    }

    /**
     * Get the previousSessionTime.
     *
     * @return int
     */
    public function getPreviousSessionTime(): ?int
    {
        return $this->previousSessionTime;
    }

    /**
     * Set the previousSessionTime.
     *
     * @param  int $previousSessionTime
     * @return self
     */
    public function setPreviousSessionTime(int $previousSessionTime): self
    {
        $this->previousSessionTime = $previousSessionTime;
        return $this;
    }

    /**
     * Get the lastWriteAccessTime.
     *
     * @return int
     */
    public function getLastWriteAccessTime(): ?int
    {
        return $this->lastWriteAccessTime;
    }

    /**
     * Set the lastWriteAccessTime.
     *
     * @param  int $lastWriteAccessTime
     * @return self
     */
    public function setLastWriteAccessTime(int $lastWriteAccessTime): self
    {
        $this->lastWriteAccessTime = $lastWriteAccessTime;
        return $this;
    }

    /**
     * Get the recentMessageCount.
     *
     * @return int
     */
    public function getRecentMessageCount(): ?int
    {
        return $this->recentMessageCount;
    }

    /**
     * Set the recentMessageCount.
     *
     * @param  int $recentMessageCount
     * @return self
     */
    public function setRecentMessageCount(int $recentMessageCount): self
    {
        $this->recentMessageCount = $recentMessageCount;
        return $this;
    }

    /**
     * Get the cos.
     *
     * @return Cos
     */
    public function getCos(): ?Cos
    {
        return $this->cos;
    }

    /**
     * Set the cos.
     *
     * @param  Cos $cos
     * @return self
     */
    public function setCos(Cos $cos): self
    {
        $this->cos = $cos;
        return $this;
    }

    /**
     * Set prefs
     *
     * @param  array $prefs
     * @return self
     */
    public function setPrefs(array $prefs): self
    {
        $this->prefs = array_filter($prefs, static fn ($pref) => $pref instanceof Pref);
        return $this;
    }

    /**
     * Get prefs
     *
     * @return array
     */
    public function getPrefs(): array
    {
        return $this->prefs;
    }

    /**
     * Set attrs
     *
     * @param  array $attrs
     * @return self
     */
    public function setAttrs(array $attrs): self
    {
        $this->attrs = array_filter($attrs, static fn ($attr) => $attr instanceof Attr);
        return $this;
    }

    /**
     * Get attrs
     *
     * @return array
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }

    /**
     * Set zimlets
     *
     * @param  array $zimlets
     * @return self
     */
    public function setZimlets(array $zimlets): self
    {
        $this->zimlets = array_filter($zimlets, static fn ($zimlet) => $zimlet instanceof AccountZimletInfo);
        return $this;
    }

    /**
     * Get zimlets
     *
     * @return array
     */
    public function getZimlets(): array
    {
        return $this->zimlets;
    }

    /**
     * Set props
     *
     * @param  array $props
     * @return self
     */
    public function setProps(array $props): self
    {
        $this->props = array_filter($props, static fn ($prop) => $prop instanceof Prop);
        return $this;
    }

    /**
     * Get props
     *
     * @return array
     */
    public function getProps(): array
    {
        return $this->props;
    }

    /**
     * Set identities
     *
     * @param  array $identities
     * @return self
     */
    public function setIdentities(array $identities): self
    {
        $this->identities = array_filter($identities, static fn ($identity) => $identity instanceof Identity);
        return $this;
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities(): array
    {
        return $this->identities;
    }

    /**
     * Set signatures
     *
     * @param  array $signatures
     * @return self
     */
    public function setSignatures(array $signatures): self
    {
        $this->signatures = array_filter($signatures, static fn ($signature) => $signature instanceof Signature);
        return $this;
    }

    /**
     * Get signatures
     *
     * @return array
     */
    public function getSignatures(): array
    {
        return $this->signatures;
    }

    /**
     * Get the account data sources.
     *
     * @return AccountDataSources
     */
    public function getAccountDataSources(): ?AccountDataSources
    {
        return $this->dataSources;
    }

    /**
     * Set the account data sources.
     *
     * @param  AccountDataSources $dataSources
     * @return self
     */
    public function setAccountDataSources(AccountDataSources $dataSources): self
    {
        $this->dataSources = $dataSources;
        return $this;
    }

    /**
     * Get the data sources.
     *
     * @return array
     */
    public function getDataSources(): array
    {
        return $this->dataSources->getDataSources();
    }

    /**
     * Set the data sources.
     *
     * @param  array $dataSources
     * @return self
     */
    public function setDataSources(array $dataSources): self
    {
        $this->dataSources = new AccountDataSources($dataSources);
        return $this;
    }

    /**
     * Set childAccounts
     *
     * @param  array $accounts
     * @return self
     */
    public function setChildAccounts(array $accounts): self
    {
        $this->childAccounts = array_filter($accounts, static fn ($account) => $account instanceof ChildAccount);
        return $this;
    }

    /**
     * Get childAccounts
     *
     * @return array
     */
    public function getChildAccounts(): array
    {
        return $this->childAccounts;
    }

    /**
     * Set discoveredRights
     *
     * @param  array $rights
     * @return self
     */
    public function setDiscoveredRights(array $rights): self
    {
        $this->discoveredRights = array_filter($rights, static fn ($right) => $right instanceof DiscoverRightsInfo);
        return $this;
    }

    /**
     * Get discoveredRights
     *
     * @return array
     */
    public function getDiscoveredRights(): array
    {
        return $this->discoveredRights;
    }

    /**
     * Get the soapURL.
     *
     * @return string
     */
    public function getSoapURL(): ?string
    {
        return $this->soapURL;
    }

    /**
     * Set the soapURL.
     *
     * @param  string $soapURL
     * @return self
     */
    public function setSoapURL(string $soapURL): self
    {
        $this->soapURL = $soapURL;
        return $this;
    }

    /**
     * Get the publicURL.
     *
     * @return string
     */
    public function getPublicURL(): ?string
    {
        return $this->publicURL;
    }

    /**
     * Set the publicURL.
     *
     * @param  string $publicURL
     * @return self
     */
    public function setPublicURL(string $publicURL): self
    {
        $this->publicURL = $publicURL;
        return $this;
    }

    /**
     * Get the changePasswordURL.
     *
     * @return string
     */
    public function getChangePasswordURL(): ?string
    {
        return $this->changePasswordURL;
    }

    /**
     * Set the changePasswordURL.
     *
     * @param  string $changePasswordURL
     * @return self
     */
    public function setChangePasswordURL(string $changePasswordURL): self
    {
        $this->changePasswordURL = $changePasswordURL;
        return $this;
    }

    /**
     * Get the adminURL.
     *
     * @return string
     */
    public function getAdminURL(): ?string
    {
        return $this->adminURL;
    }

    /**
     * Set the adminURL.
     *
     * @param  string $adminURL
     * @return self
     */
    public function setAdminURL(string $adminURL): self
    {
        $this->adminURL = $adminURL;
        return $this;
    }

    /**
     * Get the boshURL.
     *
     * @return string
     */
    public function getBoshURL(): ?string
    {
        return $this->boshURL;
    }

    /**
     * Set the boshURL.
     *
     * @param  string $boshURL
     * @return self
     */
    public function setBoshURL(string $boshURL): self
    {
        $this->boshURL = $boshURL;
        return $this;
    }

    /**
     * Get the isTrackingIMAP.
     *
     * @return bool
     */
    public function getIsTrackingIMAP(): ?bool
    {
        return $this->isTrackingIMAP;
    }

    /**
     * Set the isTrackingIMAP.
     *
     * @param  bool $isTrackingIMAP
     * @return self
     */
    public function setIsTrackingIMAP(bool $isTrackingIMAP): self
    {
        $this->isTrackingIMAP = $isTrackingIMAP;
        return $this;
    }
}
