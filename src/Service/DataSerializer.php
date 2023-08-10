<?php
namespace Logy\Bundle\MicrosoftBundle\Service;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpKernel\KernelInterface;

class DataSerializer implements DataSerializerInterface
{
    const FORMAT = "json";
    protected Serializer $serializer;

    public function __construct(KernelInterface $kernel) {
        $this->serializer = SerializerBuilder::create()
                            ->addDefaultHandlers()
                            ->addDefaultListeners()
                            ->setCacheDir($kernel->getCacheDir())
                            ->build();
    }
    /**
     * {@inheritdoc}
     */
    public function serialize($data, ?SerializationContext $context = null, ?string $type = null): string
    {
        return $this->serializer->serialize($data, self::FORMAT, $context, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize(string $data, string $type, ?DeserializationContext $context = null){
        return $this->serializer->deserialize($data, $type, self::FORMAT, $context);
    }
}