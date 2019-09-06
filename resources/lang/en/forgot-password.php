<?php 

return [
    'api' => [
        'v1' => [
            'error' => [
                'validation' => [
                    'email' => [
                        'required' => 'Please tell us your email address.',
                        'exists' => 'The email which you provided, does not exists in our users.',
                        'email' => 'Please provide a proper email address.'
                    ]
                ],
                'not_saved' => "Password Reset token not generated, try again.",
                'expired' => "Token Expired.",
                'not_reseted' => 'Password could not reseted, please try again.'
            ],
            'success' => [
                'mail_sent' => 'An Email sent to you with a password reset link.',
                'password_resetted' => 'Password reseted successfully, thanks for being with us.'
            ]
        ]
    ]
];

?>