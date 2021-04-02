<?php declare(strict_types = 1);

namespace Example\Menu;
/**
 * the way menu is defined might change in the future; could be defined by array 
 * or from the database, or dynamically based on what pages are available
 * so we want to be flexible in being able to read it
 */
interface MenuReader
{
    public function readMenu() : array;
}
