<?php

// customize the config by your app configuration
return [
    // name of the users table (the 'users' table is required and the package will not work without a users table)
    'users_table_name' => 'users',
    // users model path
    'users_model_path' => 'App\\Models\\User',
    // if false, the comments must be approved by admin
    'comment_approval' => true,
    // add the names of tables you want to have actions for at the end of this line below (if not already exists)
    'morphs' => 'forums,articles,products,blogs,news',
    // the normal way of retrieving data from polymorphic tables like getting comments of a product is to query the table and say give me comments where the
    // commentable_type is 'App\Models\Product' but with the array below you can set simply 'products' as 'App\Models\Product'
    'morphs_array' => [
        //'forums' => Forum::class,
        //'products' => Product::class,
    ],
    // each comment must contain at least :n characters
    'min_comment_length' => 5,
    // each comment can contain at last :n characters
    'max_comment_length' => 3000,
];
