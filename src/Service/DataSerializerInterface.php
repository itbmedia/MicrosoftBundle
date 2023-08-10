<?php
namespace Logy\Bundle\MicrosoftBundle\Service;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;

interface DataSerializerInterface
{
    /**
     * Serializes the given data to the specified output format.
     *
     * @param mixed $data
     *
     * @throws RuntimeException
     */
    public function serialize($data, ?SerializationContext $context = null, ?string $type = null): string;

    /**
     * Deserializes the given data to the specified type.
     *
     * @return mixed
     *
     * @throws RuntimeException
     */
    public function deserialize(string $data, string $type, ?DeserializationContext $context = null);
}