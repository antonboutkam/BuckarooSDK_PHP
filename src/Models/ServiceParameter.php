<?php

namespace Buckaroo\Models;

class ServiceParameter extends Model
{
    protected array $groupData = [];

    public function setProperties(?array $data)
    {
        foreach($data ?? array() as $property => $value)
        {
            if(method_exists($this, $property))
            {
                $this->$property($value);

                continue;
            }

            $this->$property = $value;
        }

        return $this;
    }

    public function getGroupType(string $key): ?string
    {
        return $this->groupData[$key]['groupType'] ?? null;
    }

    public function getGroupKey(string $key, ?int $keyCount = 0): ?int
    {
        return $this->groupData[$key]['groupKey'] ?? null;
    }
}