<?php

// customize the config by your app configuration
return [
    // name of the users table (the 'users' table is required and the package will not work without a users table)
    'users_table_name' => 'users',
    // users model path
    'users_model_path' => 'App\\Models\\User',
    // if false, the comments must be approved by admin
    'comment_approval' => true
];
