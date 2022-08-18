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

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute, XmlElement};
use Zimbra\Common\Struct\SoapRequest;

/**
 * CalItemRequestBase class
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Struct
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
abstract class CalItemRequestBase extends SoapRequest
{
    /**
     * If specified, the created appointment is echoed back in the response as if a
     * GetMsgRequest was made
     * 
     * @var bool
     */
    #[Accessor(getter: 'getEcho', setter: 'setEcho')]
    #[SerializedName('echo')]
    #[Type('bool')]
    #[XmlAttribute]
    private $echo;

    /**
     * Maximum inlined length
     * 
     * @var int
     */
    #[Accessor(getter: 'getMaxSize', setter: 'setMaxSize')]
    #[SerializedName('max')]
    #[Type('int')]
    #[XmlAttribute]
    private $maxSize;

    /**
     * Set if want HTML included in echoing
     * 
     * @var bool
     */
    #[Accessor(getter: 'getWantHtml', setter: 'setWantHtml')]
    #[SerializedName('want')]
    #[Type('bool')]
    #[XmlAttribute]
    private $wantHtml;

    /**
     * Set if want "neuter" set for echoed response
     * 
     * @var bool
     */
    #[Accessor(getter: 'getNeuter', setter: 'setNeuter')]
    #[SerializedName('neuter')]
    #[Type('bool')]
    #[XmlAttribute]
    private $neuter;

    /**
     * If set, ignore smtp 550 errors when sending the notification to attendees.
     * If unset, throw the soapfaultexception with invalid addresses so that client can give the forcesend option to
     * the end user.
     * The default is 1.
     * 
     * @var bool
     */
    #[Accessor(getter: 'getForceSend', setter: 'setForceSend')]
    #[SerializedName('forcesend')]
    #[Type('bool')]
    #[XmlAttribute]
    private $forceSend;

    /**
     * Message information
     * 
     * @var Msg
     */
    #[Accessor(getter: "getMsg", setter: "setMsg")]
    #[SerializedName('m')]
    #[Type(Msg::class)]
    #[XmlElement(namespace: 'urn:zimbraMail')]
    private $msg;

    /**
     * Constructor
     *
     * @param  Msg $msg
     * @param  bool $echo
     * @param  int $maxSize
     * @param  bool $wantHtml
     * @param  bool $neuter
     * @param  bool $forceSend
     * @return self
     */
    public function __construct(
        ?Msg $msg = NULL,
        ?bool $echo = NULL,
        ?int $maxSize = NULL,
        ?bool $wantHtml = NULL,
        ?bool $neuter = NULL,
        ?bool $forceSend = NULL
    )
    {
        if ($msg instanceof Msg) {
            $this->setMsg($msg);
        }
        if (NULL !== $echo) {
            $this->setEcho($echo);
        }
        if (NULL !== $maxSize) {
            $this->setMaxSize($maxSize);
        }
        if (NULL !== $wantHtml) {
            $this->setWantHtml($wantHtml);
        }
        if (NULL !== $neuter) {
            $this->setNeuter($neuter);
        }
        if (NULL !== $forceSend) {
            $this->setForceSend($forceSend);
        }
    }

    /**
     * Get echo
     *
     * @return bool
     */
    public function getEcho(): ?bool
    {
        return $this->echo;
    }

    /**
     * Set echo
     *
     * @param  bool $echo
     * @return self
     */
    public function setEcho(bool $echo): self
    {
        $this->echo = $echo;
        return $this;
    }

    /**
     * Get maxSize
     *
     * @return int
     */
    public function getMaxSize(): ?int
    {
        return $this->maxSize;
    }

    /**
     * Set maxSize
     *
     * @param  int $maxSize
     * @return self
     */
    public function setMaxSize(int $maxSize): self
    {
        $this->maxSize = $maxSize;
        return $this;
    }

    /**
     * Get wantHtml
     *
     * @return bool
     */
    public function getWantHtml(): ?bool
    {
        return $this->wantHtml;
    }

    /**
     * Set wantHtml
     *
     * @param  bool $wantHtml
     * @return self
     */
    public function setWantHtml(bool $wantHtml): self
    {
        $this->wantHtml = $wantHtml;
        return $this;
    }

    /**
     * Get neuter
     *
     * @return bool
     */
    public function getNeuter(): ?bool
    {
        return $this->neuter;
    }

    /**
     * Set neuter
     *
     * @param  bool $neuter
     * @return self
     */
    public function setNeuter(bool $neuter): self
    {
        $this->neuter = $neuter;
        return $this;
    }

    /**
     * Get forceSend
     *
     * @return bool
     */
    public function getForceSend(): ?bool
    {
        return $this->forceSend;
    }

    /**
     * Set forceSend
     *
     * @param  bool $forceSend
     * @return self
     */
    public function setForceSend(bool $forceSend): self
    {
        $this->forceSend = $forceSend;
        return $this;
    }

    /**
     * Get msg
     *
     * @return Msg
     */
    public function getMsg(): ?Msg
    {
        return $this->msg;
    }

    /**
     * Set msg
     *
     * @param  Msg $msg
     * @return self
     */
    public function setMsg(Msg $msg): self
    {
        $this->msg = $msg;
        return $this;
    }
}
