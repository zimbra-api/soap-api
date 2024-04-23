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

use JMS\Serializer\Annotation\{Accessor, Exclude, SerializedName, Type, XmlAttribute, XmlValue};

/**
 * MiniCalError struct class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class MiniCalError
{
    /**
     * ID for calendar folder that couldn't be accessed
     * 
     * @var string
     */
    #[Accessor(getter: 'getId', setter: 'setId')]
    #[SerializedName('id')]
    #[Type('string')]
    #[XmlAttribute]
    private $id;

    /**
     * ServiceException error code - service.PERM_DENIED, mail.NO_SUCH_FOLDER, account.NO_SUCH_ACCOUNT, etc.
     * 
     * @var string
     */
    #[Accessor(getter: 'getCode', setter: 'setCode')]
    #[SerializedName('code')]
    #[Type('string')]
    #[XmlAttribute]
    private $code;

    /**
     * Error message from the exception (but no stack trace)
     * 
     * @var string
     */
    #[Accessor(getter: 'getErrorMessage', setter: 'setErrorMessage')]
    #[Type('string')]
    #[XmlValue(cdata: false)]
    private $errorMessage;

    /**
     * Constructor
     * 
     * @param string $id
     * @param string $code
     * @param string $errorMessage
     * @return self
     */
    public function __construct(
        string $id = '',
        string $code = '',
        ?string $errorMessage = null
    )
    {
        $this->setId($id)
             ->setCode($code);
        if (null !== $errorMessage) {
            $this->setErrorMessage($errorMessage);
        }
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param  string $code
     * @return self
     */
    public function setCode(string $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Get ID
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Set ID
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
     * Get the errorMessage
     *
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Set the errorMessage
     *
     * @param  string $errorMessage
     * @return self
     */
    public function setErrorMessage(string $errorMessage): self
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}
