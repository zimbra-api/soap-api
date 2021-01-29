<?php declare(strict_types=1);
/**
 * This file is part of the Zimbra API in PHP library.
 *
 * © Nguyen Van Nguyen <nguyennv1981@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zimbra\Common\Serializer;

use JMS\Serializer\AbstractVisitor;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\Metadata\{ClassMetadata, PropertyMetadata};
use JMS\Serializer\Visitor\SerializationVisitorInterface;
use MyCLabs\Enum\Enum;

/**
 * JsonSerializationVisitor class.
 * 
 * @package   Zimbra
 * @category  Common
 * @author    Johannes M. Schmitt <schmittjoh@gmail.com>
 * @copyright Copyright © 2020 by Nguyen Van Nguyen.
 */
final class JsonSerializationVisitor extends AbstractVisitor implements SerializationVisitorInterface
{
    /**
     * @var int
     */
    private $options;

    /**
     * @var array
     */
    private $dataStack;

    /**
     * @var \ArrayObject
     */
    private $data;

    public function __construct(
        int $options = JSON_PRESERVE_ZERO_FRACTION
    ) {
        $this->dataStack = [];
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function visitNull($data, array $type)
    {
        return NULL;
    }

    /**
     * {@inheritdoc}
     */
    public function visitString(string $data, array $type)
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function visitBoolean(bool $data, array $type)
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function visitInteger(int $data, array $type)
    {
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function visitDouble(float $data, array $type)
    {
        return $data;
    }

    /**
     * @param array $data
     * @param array $type
     *
     * @return array|\ArrayObject
     */
    public function visitArray(array $data, array $type)
    {
        \array_push($this->dataStack, $data);

        $rs = isset($type['params'][1]) ? new \ArrayObject() : [];

        $isList = isset($type['params'][0]) && !isset($type['params'][1]);

        $elType = $this->getElementType($type);
        foreach ($data as $k => $v) {
            try {
                $v = $this->navigator->accept($v, $elType);
            } catch (NotAcceptableException $e) {
                continue;
            }

            if ($isList) {
                $rs[] = $v;
            } else {
                $rs[$k] = $v;
            }
        }

        \array_pop($this->dataStack);
        return $rs;
    }

    public function startVisitingObject(ClassMetadata $metadata, object $data, array $type): void
    {
        \array_push($this->dataStack, $this->data);
        $this->data = TRUE === $metadata->isMap ? new \ArrayObject() : [];
    }

    /**
     * @return array|\ArrayObject
     */
    public function endVisitingObject(ClassMetadata $metadata, object $data, array $type)
    {
        $rs = $this->data;
        $this->data = \array_pop($this->dataStack);

        if (TRUE !== $metadata->isList && empty($rs)) {
            return new \ArrayObject();
        }

        return $rs;
    }

    /**
     * {@inheritdoc}
     */
    public function visitProperty(PropertyMetadata $metadata, $v): void
    {
        try {
            if (!$v instanceof Enum) {
                $v = $this->navigator->accept($v, $metadata->type);
            }
        }
        catch (NotAcceptableException $e) {
            return;
        }

        if (TRUE === $metadata->skipWhenEmpty && ($v instanceof \ArrayObject || \is_array($v)) && 0 === count($v)) {
            return;
        }
        if ($metadata->xmlCollection && $metadata->xmlCollectionSkipWhenEmpty && empty($v)) {
            return;
        }

        if ($metadata->inline) {
            if (\is_array($v) || ($v instanceof \ArrayObject)) {
                // concatenate the two array-like structures
                // is there anything faster?
                foreach ($v as $key => $value) {
                    $this->data[$key] = $value;
                }
            }
        }
        elseif ($metadata->xmlAttributeMap) {
            foreach ($v as $key => $value) {
                $this->data[$key] = $value;
            }
        }
        else {
            if ($this->_isXmlElement($metadata) && \is_scalar($v)) {
                $this->data[$metadata->serializedName] = ['_content' => $v];
            }
            elseif ($this->_isStringArrayType($metadata) && \is_array($v)) {
                $data = [];
                foreach ($v as $value) {
                    $data[] = ['_content' => $value];
                }
                if ($metadata->xmlCollectionInline) {
                    $this->data[$metadata->serializedName] = $data;
                }
                else {
                    $this->data[$metadata->serializedName][$metadata->xmlEntryName] = $data;
                }
            }
            elseif ($metadata->xmlCollection && !$metadata->xmlCollectionInline) {
                $this->data[$metadata->serializedName][$metadata->xmlEntryName] = $v;
            }
            else {
                $this->data[$metadata->serializedName] = $v;
            }
        }

        if ($metadata->xmlNamespace && $metadata->xmlNamespace != 'http://www.w3.org/2003/05/soap-envelope') {
            $this->data[$metadata->serializedName]['_jsns'] = $metadata->xmlNamespace;
        }
    }

    /**
     * @deprecated Will be removed in 3.0
     *
     * Checks if some data key exists.
     */
    public function hasData(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @deprecated Use `::visitProperty(new StaticPropertyMetadata('', 'name', 'value'), 'value')` instead
     *
     * Allows you to replace existing data on the current object element.
     *
     * @param mixed $value This value must either be a regular scalar, or an array.
     *                                                       It must not contain any objects anymore.
     */
    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getResult($data)
    {
        $result = @json_encode($data, $this->options);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                return $result;

            case JSON_ERROR_UTF8:
                throw new RuntimeException('Your data could not be encoded because it contains invalid UTF8 characters.');

            default:
                throw new RuntimeException(sprintf('An error occurred while encoding your data (error code %d).', json_last_error()));
        }
    }

    private function _isStringArrayType(PropertyMetadata $metadata)
    {
        $type = $metadata->type;
        return $type['name'] === 'array' && $type['params'][0]['name'] === 'string';
    }

    private function _isXmlElement(PropertyMetadata $metadata)
    {
        return !$metadata->xmlAttribute && !$metadata->xmlValue && !$metadata->xmlCollection;
    }

    private function _isScalaType(PropertyMetadata $metadata)
    {
        $type = $metadata->type['name'];
        return $type === 'string' || $type === 'integer' || $type === 'bool' || $type === 'float';
    }
}
