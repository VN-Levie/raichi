<?php

namespace System\Eloquent;

use System\Database;
use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use LoopIterator;
use stdClass;
use Traversable;

class Collection implements ArrayAccess, Countable, IteratorAggregate
{

    /**
     * The items contained in the collection.
     *
     * @var [key => value]
     */
    private $items = [];


    public function count(): int
    {
        return count($this->items);
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public static function range($from, $to)
    {
        return new static(range($from, $to));
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function getIterator(): Traversable
    {
        return new LoopIterator($this->items);
    }

    

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function all()
    {
        return $this->items;
    }

    public function first()
    {
        return $this->items[0];
    }

    public function last()
    {
        return end($this->items);
    }



    public function get($key)
    {
        return $this->items[$key];
    }

    public function pluck($value, $key = null)
    {
        $result = [];
        foreach ($this->items as $item) {
            if ($key) {
                $result[$item[$key]] = $item[$value];
            } else {
                $result[] = $item[$value];
            }
        }
        return new Collection($result);
    }

    public function where($key, $value)
    {
        $result = [];
        foreach ($this->items as $item) {
            if ($item[$key] == $value) {
                $result[] = $item;
            }
        }
        return new Collection($result);
    }

    public function whereIn($key, $values)
    {
        $result = [];
        foreach ($this->items as $item) {
            if (in_array($item[$key], $values)) {
                $result[] = $item;
            }
        }
        return new Collection($result);
    }

    public function whereNotIn($key, $values)
    {
        $result = [];
        foreach ($this->items as $item) {
            if (!in_array($item[$key], $values)) {
                $result[] = $item;
            }
        }
        return new Collection($result);
    }

    public function take($limit)
    {
        return new Collection(array_slice($this->items, 0, $limit));
    }

    public function skip($offset)
    {
        return new Collection(array_slice($this->items, $offset));
    }

    public function sortBy($key)
    {
        $items = $this->items;
        usort($items, function ($a, $b) use ($key) {
            return $a[$key] <=> $b[$key];
        });
        return new Collection($items);
    }

    public function sortByDesc($key)
    {
        $items = $this->items;
        usort($items, function ($a, $b) use ($key) {
            return $b[$key] <=> $a[$key];
        });
        return new Collection($items);
    }
}
