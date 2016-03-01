<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Mail\Request;

use Zimbra\Mail\Struct\SectionAttr;

/**
 * GetCustomMetadata request class
 * Get Custom metadata
 *
 * @package    Zimbra
 * @subpackage Mail
 * @category   Request
 * @author     Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright  Copyright © 2013 by Nguyen Van Nguyen.
 */
class GetCustomMetadata extends Base
{
    /**
     * Constructor method for GetCustomMetadata
     * @param  string $id
     * @param  SectionAttr $metadata
     * @return self
     */
    public function __construct($id, SectionAttr $metadata = null)
    {
        parent::__construct();
        $this->setProperty('id', trim($id));
        if($metadata instanceof SectionAttr)
        {
            $this->setChild('meta', $metadata);
        }
    }

    /**
     * Gets id
     *
     * @return string
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Sets id
     *
     * @param  string $id
     * @return self
     */
    public function setId($id)
    {
        return $this->setProperty('id', trim($id));
    }

    /**
     * Gets metadata section selector
     *
     * @return SectionAttr
     */
    public function getMetadata()
    {
        return $this->getChild('meta');
    }

    /**
     * Sets metadata section selector
     *
     * @param  SectionAttr $metadata
     * @return self
     */
    public function setMetadata(SectionAttr $metadata)
    {
        return $this->setChild('meta', $metadata);
    }
}
