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
     * @param  SectionAttr $meta
     * @return self
     */
    public function __construct($id, SectionAttr $meta = null)
    {
        parent::__construct();
        $this->property('id', trim($id));
        if($meta instanceof SectionAttr)
        {
            $this->child('meta', $meta);
        }
    }

    /**
     * Get or set id
     *
     * @param  string $id
     * @return string|self
     */
    public function id($id = null)
    {
        if(null === $id)
        {
            return $this->property('id');
        }
        return $this->property('id', trim($id));
    }

    /**
     * Get or set meta
     *
     * @param  SectionAttr $meta
     * @return SectionAttr|self
     */
    public function meta(SectionAttr $meta = null)
    {
        if(null === $meta)
        {
            return $this->child('meta');
        }
        return $this->child('meta', $meta);
    }
}
