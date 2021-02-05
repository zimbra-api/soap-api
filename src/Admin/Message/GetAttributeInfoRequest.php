<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Admin\Message;

use JMS\Serializer\Annotation\{Accessor, AccessType, SerializedName, Type, XmlAttribute, XmlRoot};
use Zimbra\Soap\Request;

/**
 * GetAttributeInfoRequest class
 * Get attribute information 
 * Only one of attrs or entryTypes can be specified.
 * If both are specified, INVALID_REQUEST will be thrown.
 * If neither is specified, all attributes will be returned.
 * 
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="GetAttributeInfoRequest")
 */
class GetAttributeInfoRequest extends Request
{
    /**
     * Comma separated list of attributes to return
     * @Accessor(getter="getAttrs", setter="setAttrs")
     * @SerializedName("attrs")
     * @Type("string")
     * @XmlAttribute
     */
    private $attrs;

    /**
     * Comma separated list of entry types. Attributes on the specified entry types will be returned.
     * Valid entry types:
     *    account,alias,distributionList,cos,globalConfig,domain,server,mimeEntry,zimletEntry,
     *    calendarResource,identity,dataSource,pop3DataSource,imapDataSource,rssDataSource,
     *    liveDataSource,galDataSource,signature,xmppComponent,aclTarget,oauth2DataSource
     * @Accessor(getter="getEntryTypes", setter="setEntryTypes")
     * @SerializedName("entryTypes")
     * @Type("string")
     * @XmlAttribute
     */
    private $entryTypes;

    /**
     * Constructor method for GetAttributeInfoRequest
     * 
     * @param  string $attrs
     * @param  string $entryTypes
     * @return self
     */
    public function __construct(?string $attrs = NULL, ?string $entryTypes = NULL)
    {
        if (NULL !== $attrs) {
            $this->setAttrs($attrs);
        }
        if (NULL !== $entryTypes) {
            $this->setEntryTypes($entryTypes);
        }
    }

    /**
     * Gets attrs
     *
     * @return string
     */
    public function getAttrs(): string
    {
        return $this->attrs;
    }

    /**
     * Sets attrs
     *
     * @param  int $attrs
     * @return self
     */
    public function setAttrs(string $attrs): self
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * Gets entryTypes
     *
     * @return string
     */
    public function getEntryTypes(): string
    {
        return $this->entryTypes;
    }

    /**
     * Sets entryTypes
     *
     * @param  string $entryTypes
     * @return self
     */
    public function setEntryTypes(string $entryTypes): self
    {
        $this->entryTypes = $entryTypes;
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof GetAttributeInfoEnvelope)) {
            $this->envelope = new GetAttributeInfoEnvelope(
                new GetAttributeInfoBody($this)
            );
        }
    }
}