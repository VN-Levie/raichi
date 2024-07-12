<?php
class LoopIterator implements Iterator
{
    private $items;
    private $index = 0;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function current(): mixed
    {
        return $this->items[$this->index];
    }

    public function key() : mixed
    {
        return $this->index;
    }

    public function next(): void
    {
        $this->index++;
    }

    public function rewind() : void
    {
        $this->index = 0;
    }

    public function valid() : bool
    {
        return isset($this->items[$this->index]);
    }

    public function getLoop()
    {
        return (object)[
            'index' => $this->index,
            'iteration' => $this->index + 1,
            'remaining' => count($this->items) - ($this->index + 1),
            'count' => count($this->items),
            'first' => $this->index === 0,
            'last' => $this->index === count($this->items) - 1,
            'even' => $this->index % 2 === 0,
            'odd' => $this->index % 2 !== 0,
        ];
    }
}
