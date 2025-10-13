<?php

namespace Cervon\Tms\Dto;

use Cervon\Tms\Dto\References\UserReference;

class Upload
{
    public function __construct(
        public string $_id,
        public ?UserReference $user,
        public string $collection,
        public string $document_id,
        public string $filename,
        public string $type,
        public string $created_date,
        public ?string $url,
    ) {
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            _id: $data['_id'],
            user: isset($data['user']) ? UserReference::fromResponse($data['user']) : null,
            collection: $data['collection'],
            document_id: $data['document_id'],
            filename: $data['filename'],
            type: $data['type'],
            created_date: $data['created_date'],
            url: $data['url'] ?? null,
        );
    }

    public static function collect(array $items): array
    {
        return array_map(fn (array $item) => self::fromResponse($item), $items);
    }
}
