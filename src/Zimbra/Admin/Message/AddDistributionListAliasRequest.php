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
 * AddDistributionListAliasRequest request class
 * Add an alias for a distribution list
 *
 * @package    Zimbra
 * @subpackage Admin
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013-present by Nguyen Van Nguyen.
 * @AccessType("public_method")
 * @XmlRoot(name="AddDistributionListAliasRequest")
 */
class AddDistributionListAliasRequest extends Request
{
    /**
     * @Accessor(getter="getId", setter="setId")
     * @SerializedName("id")
     * @Type("string")
     * @XmlAttribute
     */
    private $id;

    /**
     * @Accessor(getter="getAlias", setter="setAlias")
     * @SerializedName("alias")
     * @Type("string")
     * @XmlAttribute
     */
    private $alias;

    /**
     * Constructor method for AddDistributionListAliasRequest
     * @param  string $id Zimbra ID
     * @param  string $alias Alias
     * @return self
     */
    public function __construct($id, $alias)
    {
        $this->setId($id)
             ->setAlias($alias);
    }

    /**
     * Gets zimbra id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Sets zimbra id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id): self
    {
        $this->id = trim($id);
        return $this;
    }

    /**
     * Gets alias
     *
     * @return string
     */
    public function getAlias(): string
    {
        return $this->alias;
    }

    /**
     * Sets alias
     *
     * @param  string $alias
     * @return self
     */
    public function setAlias($alias): self
    {
        $this->alias = trim($alias);
        return $this;
    }

    /**
     * Initialize the soap envelope
     *
     * @return void
     */
    protected function envelopeInit(): void
    {
        if (!($this->envelope instanceof AddDistributionListAliasEnvelope)) {
            $this->envelope = new AddDistributionListAliasEnvelope(
                new AddDistributionListAliasBody($this)
            );
        }
    }
}
