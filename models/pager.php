<?php

// Pager is a helper that splits a list of items into navigable pages.

class Pager
{
    public int $total; // total number of items
    public int $page; // current page index, 1-based
    public int $size; // number of items per page
    public int $pages; // number of pages

    public function __construct(int $total, int $page=1, int $size=10) {
        $this->total = $total;
        $this->page = $page;
        $this->size = $size;
        $this->pages = $this->total / $this->size;
        if ($this->total % $this->size > 0) {
            $this->pages += 1;
        }
    }

    // returns the starting index for the current page when applied to the full list
    public function startIndex() {
        return ($this->page - 1) * $this->size;
    }

    // returns the current page of items from the list of all items
    public function slicePage($list) {
        return array_slice($list, $this->startIndex(), $this->size);
    }

    // updates pager state from request parameters
    public function setRequestState() {
        $page = $_REQUEST['page'];
        if (isset($page) and is_numeric($page)) {
            if ($page <= $this->pages and $page > 0) {
                $this->page = $page;
            }
        }
    }
}

