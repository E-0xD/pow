<?php

return [
    'register' => [
        'payload' => [
            'greeting' => 'Welcome to POW',
            'introLines' => [
                'We’re excited to have you here! You’ve just taken the first step toward owning your digital proof of work, a place to showcase your skills, projects, and experience with confidence.',
                'With POW, you can easily build and share a portfolio that tells your professional story, all in one simple link.',
                'Our goal is to help you stand out and open new doors of opportunity. If you have ideas or features you’d love to see, we’d love to hear from you anytime.',
                'Here’s to building something meaningful; and to landing that next big, life-changing opportunity.'
            ],

            'actionText' => 'Go to Dashboard',
            'actionUrl'  => route('user.dashboard'),
            'outroLines' => ['If you need help, reply to this email.'],
        ],
        'subject' => 'Your Work, Your Badge. let’s make it count.'
    ],

    'login' => [
        'payload' => [
            'greeting' => 'Welcome back',
            'introLines' => [
                'We noticed a new login to your account on ' . now()->format('Y-m-d H:i:s') . ' UTC ',
                'It’s great to see you again. keep growing your digital proof of work and showcasing what you do best.',
                'If this wasn’t you, please visit your account settings right away to secure your profile.'
            ],
            'actionText' => 'Go to Dashboard',
            'actionUrl'  => route('user.dashboard'),
            'outroLines' => ['If you need help, reply to this email.'],
        ],
        'subject' => 'Login Attempt',

    ]
];
