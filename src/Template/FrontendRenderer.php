<?php declare(strict_types = 1);

namespace Example\Template;
/**
 * used for rendering the public website pages
 * we can use this anywhere that we would use a Renderer
 * 
 * Initially we've created this to pass the menu to more than one page (controller)
 * 
 * Instead of copying and pasting the menu code or adding a global variable, 
 * the interface let's us specify what should be rendered.
 * 
 * Now we can use another renderer for something like an admin section
 */
interface FrontendRenderer extends Renderer {}
