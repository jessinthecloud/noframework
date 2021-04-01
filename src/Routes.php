<?php
declare(strict_types = 1);

// call your new class method instead of the closure
return [
    // Instead of just a callable you are now passing an array. 
    // The first value is the fully namespaced classname, the second one the method name that you want to call.
    ['GET', '/', ['Example\Controllers\Homepage', 'show']],
];
