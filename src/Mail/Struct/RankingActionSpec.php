<?php declare(strict_types=1);
/**
 * This file is version of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Struct;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Enum\RankingActionOp;

/**
 * RankingActionSpec struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class RankingActionSpec
{
    /**
     * Action to perform - reset|delete.
     * reset: resets the contact ranking table for the account
     * delete: delete the ranking information for the email address
     * 
     * @var RankingActionOp
     */
    #[Accessor(getter: 'getOperation', setter: 'setOperation')]
    #[SerializedName(name: 'op')]
    #[Type(name: 'Enum<Zimbra\Common\Enum\RankingActionOp>')]
    #[XmlAttribute]
    private $operation;

    /**
     * Email
     * 
     * @var string
     */
    #[Accessor(getter: 'getEmail', setter: 'setEmail')]
    #[SerializedName(name: 'email')]
    #[Type(name: 'string')]
    #[XmlAttribute]
    private $email;

    /**
     * Constructor
     * 
     * @param RankingActionOp $operation
     * @param string $email
     * @return self
     */
    public function __construct(
        ?RankingActionOp $operation = NULL,
        ?string $email = NULL
    )
    {
        $this->setOperation($operation ?? new RankingActionOp('reset'));
        if (NULL !== $email) {
            $this->setEmail($email);
        }
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param  string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get operation
     *
     * @return RankingActionOp
     */
    public function getOperation(): RankingActionOp
    {
        return $this->operation;
    }

    /**
     * Set operation
     *
     * @param  RankingActionOp $operation
     * @return self
     */
    public function setOperation(RankingActionOp $operation): self
    {
        $this->operation = $operation;
        return $this;
    }
}
