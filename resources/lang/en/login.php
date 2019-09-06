<?php 

return [
    'api' => [
        'v1' => [
            'error' => [
                'validation' => [
                    'username' => [
                        'username_not_exists' => 'No such account exists. Signup and Try again.',
                        'wrong_password' => 'You entered a wrong password.'
                    ],
                ]
            ],
            'success' => 'You are logged in successfully.'
        ]
    ]
];

?>