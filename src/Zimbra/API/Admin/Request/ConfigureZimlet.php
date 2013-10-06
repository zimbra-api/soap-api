<?php
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\API\Admin\Request;

use Zimbra\Soap\Request;
use Zimbra\Soap\Struct\AttachmentIdAttrib as Attachment;

/**
 * ConfigureZimlet class
 * Clear cookie.
 *
 * @package   Zimbra
 * @category  API
 * @author    Nguyen Van Nguyen - nguyennv1981@gmail.com
 * @copyright Copyright © 2013 by Nguyen Van Nguyen.
 */
class ConfigureZimlet extends Request
{
    /**
     * Content
     * @var Attachment
     */
    private $_content;

    /**
     * Constructor method for ConfigureZimlet
     * @param Attachment $content
     * @return self
     */
    public function __construct(Attachment $content)
    {
        parent::__construct();
        $this->_content = $content;
    }

    /**
     * Gets or sets content
     *
     * @param  Attachment $content
     * @return Attachment|self
     */
    public function content(Attachment $content = null)
    {
        if(null === $content)
        {
            return $this->_content;
        }
        $this->_content = $content;
        return $this;
    }

    /**
     * Returns the array representation of this class 
     *
     * @return array
     */
    public function toArray()
    {
        $this->array = $this->_content->toArray('content');
        return parent::toArray();
    }

    /**
     * Method returning the xml representation of this class
     *
     * @return SimpleXML
     */
    public function toXml()
    {
        $this->xml->append($this->_content->toXml('content'));
        return parent::toXml();
    }
}
