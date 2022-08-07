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

use JMS\Serializer\Annotation\{Accessor, Type, XmlList};
use Zimbra\Mail\Struct\DispositionAndText;
use Zimbra\Common\Struct\SoapResponse;

/**
 * DiffDocumentResponse class
 * 
 * @package    Zimbra
 * @subpackage Mail
 * @category   Message
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2020-present by Nguyen Van Nguyen.
 */
class DiffDocumentResponse extends SoapResponse
{
    /**
     * Difference information in chunks
     * 
     * @Accessor(getter="getChunks", setter="setChunks")
     * @Type("array<Zimbra\Mail\Struct\DispositionAndText>")
     * @XmlList(inline=true, entry="chunk", namespace="urn:zimbraMail")
     */
    private $chunks = [];

    /**
     * Constructor
     *
     * @param  array $chunks
     * @return self
     */
    public function __construct(array $chunks = [])
    {
        $this->setChunks($chunks);
    }

    /**
     * Add chunk
     *
     * @param  DispositionAndText $chunk
     * @return self
     */
    public function addChunk(DispositionAndText $chunk): self
    {
        $this->chunks[] = $chunk;
        return $this;
    }

    /**
     * Set chunks
     *
     * @param  array $chunks
     * @return self
     */
    public function setChunks(array $chunks): self
    {
        $this->chunks = array_filter($chunks, static fn ($chunk) => $chunk instanceof DispositionAndText);
        return $this;
    }

    /**
     * Get chunks
     *
     * @return array
     */
    public function getChunks(): array
    {
        return $this->chunks;
    }
}
