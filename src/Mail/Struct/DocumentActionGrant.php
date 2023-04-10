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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\GranteeType;

/**
 * DocumentActionGrant class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2022-present by Nguyen Van Nguyen.
 */
class DocumentActionGrant extends ActionGrantSelector
{
    /**
     * (Optional) Time when this grant expires in milliseconds since the Epoch
     * 
     * @Accessor(getter="getExpiry", setter="setExpiry")
     * @SerializedName("expiry")
     * @Type("int")
     * @XmlAttribute
     * 
     * @var int
     */
    #[Accessor(getter: 'getExpiry', setter: 'setExpiry')]
    #[SerializedName('expiry')]
    #[Type('int')]
    #[XmlAttribute]
    private ?int $expiry;

    /**
     * Constructor
     *
     * @param string $rights
     * @param GranteeType $grantType
     * @param int $expiry
     * @param string $zimbraId
     * @param string $displayName
     * @param string $args
     * @param string $password
     * @param string $accessKey
     * @return self
     */
    public function __construct(
        string $rights = '',
        ?GranteeType $grantType = NULL,
        ?int $expiry = NULL,
        ?string $zimbraId = NULL,
        ?string $displayName = NULL,
        ?string $args = NULL,
        ?string $password = NULL,
        ?string $accessKey = NULL
    )
    {
        parent::__construct(
            $rights,
            $grantType,
            $zimbraId,
            $displayName,
            $args,
            $password,
            $accessKey
        );
        $this->expiry = $expiry;
    }

    /**
     * Get expiry
     *
     * @return int
     */
    public function getExpiry(): ?int
    {
        return $this->expiry;
    }

    /**
     * Set expiry
     *
     * @param  int $expiry
     * @return self
     */
    public function setExpiry(int $expiry): self
    {
        $this->expiry = $expiry;
        return $this;
    }
}
