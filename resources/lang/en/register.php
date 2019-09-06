<?php 

return [
    'api' => [
        'v1' => [
            'error' => [
                'validation' => [
                    'password' => [
                        'regex' => 'Password must have a capital character, a number and a special character and minimum 6 characters',
                    ],
                    'gender' => [
                        'required' => 'Please tell us your gender',
                    ],
                    'username' => [
                        'regex' => 'Username must start with letter, can have 6-32 characters and have lowercase-letters and numbers only'
                    ],
                    'mobile' => [
                        'regex' => 'Please enter 10 digit indian mobile number'
                    ]
                ]
            ],
            'success' => 'User registered Successfully'
        ]
    ]
];

?>