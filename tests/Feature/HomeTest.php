<?php

use function Pest\Laravel\get;

test('hompage can be loaded', function (){
   get('/')->assertSuccessful();
});
