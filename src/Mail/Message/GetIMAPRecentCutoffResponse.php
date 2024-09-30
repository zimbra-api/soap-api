<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Message;

use JMS\Serializer\Annotation\{Accessor, SerializedName, Type, XmlAttribute};
use Zimbra\Common\Struct\SoapResponse;

/**
 * GetIMAPRecentCutoffResponse class
 * Return the count of recent items in the folder
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class GetIMAPRecentCutoffResponse extends SoapResponse
{
    /**
     * The last recorded assigned item ID in the enclosing
     * Mailbox the last time the folder was accessed via a read/write IMAP session.
     * Note that this value is only updated on session closes
     *
     * @Accessor(getter="getCutoff", setter="setCutoff")
     * @SerializedName("cutoff")
     * @Type("int")
     * @XmlAttribute
     *
     * @var int
     */
    #[Accessor(getter: "getCutoff", setter: "setCutoff")]
    #[SerializedName("cutoff")]
    #[Type("int")]
    #[XmlAttribute]
    private $cutoff;

    /**
     * Constructor
     *
     * @param  int $cutoff
     * @return self
     */
    public function __construct(int $cutoff = 0)
    {
        $this->setCutoff($cutoff);
    }

    /**
     * Get cutoff
     *
     * @return int
     */
    public function getCutoff(): int
    {
        return $this->cutoff;
    }

    /**
     * Set cutoff
     *
     * @param  int $cutoff
     * @return self
     */
    public function setCutoff(int $cutoff): self
    {
        $this->cutoff = $cutoff;
        return $this;
    }
}
