<?php

$template = '<head><title>{blog_title}</title></head>';
$data     = ['blog_title' => 'My ramblings'];

echo $parser->setData($data)->renderString($template);
// Result: <head><title>My ramblings</title></head>
