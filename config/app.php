<?php

return [
  'debug' => getenv('FS2_DEBUG') ?: false,
  'env' => getenv('FS2_ENV') ?: 'development',
  'is_satellite' => getenv('FS2_ENV') ?: 'development',

];
