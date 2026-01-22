<?php

namespace App\Traits;

trait HasDummyResume
{
    /**
     * Get dummy resume data for template preview
     *
     * @param int $templateId
     * @return object
     */
    protected function getDummyResume($templateId = 1)
    {
        $dummyData = [
            1 => [
                'id' => 1,
                'title' => 'Marketing Manager Resume',
                'data' => [
                    'summary' => 'Dynamic marketing professional with 8+ years of experience in digital marketing, brand management, and strategic planning. Proven track record of driving growth and delivering results.',
                    'references' => [
                        [
                            'id' => 1,
                            'name' => 'Harumi Kobyashi',
                            'title' => 'CEO',
                            'company' => 'Wadiere Inc.',
                            'phone' => '0346875925',
                            'email' => 'harumikoby@email.com',
                        ],
                        [
                            'id' => 2,
                            'name' => 'Jessica Williams',
                            'title' => 'Marketing Director',
                            'company' => 'Digital Solutions Inc.',
                            'phone' => '0346875926',
                            'email' => 'jessica.w@example.com',
                        ],
                    ],
                ],
                'user' => [
                    'name' => 'Gesigan Jeevee',
                    'email' => 'gesigan.jeevee@example.com',
                    'userProfile' => [
                        'phone' => '+1 555-123-4567',
                        'location' => 'New York, NY 10001',
                        'summary' => 'Creative marketing strategist with expertise in digital campaigns and brand development. Passionate about driving business growth through innovative marketing solutions.',
                    ],
                ],
                'experiences' => [
                    [
                        'id' => 1,
                        'title' => 'Marketing Manager',
                        'company' => 'Digital Solutions Inc.',
                        'start_date' => '2020-01-01',
                        'end_date' => null,
                        'is_current' => true,
                        'description' => 'Leading marketing initiatives and managing a team of 5 professionals. Increased brand awareness by 150% through strategic campaigns. Developed and executed comprehensive digital marketing strategies resulting in 40% revenue growth.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Marketing Specialist',
                        'company' => 'Creative Agency',
                        'start_date' => '2017-06-01',
                        'end_date' => '2019-12-31',
                        'is_current' => false,
                        'description' => 'Developed and executed marketing campaigns across multiple channels, resulting in 40% increase in customer engagement. Managed social media presence with 200k+ followers.',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Junior Marketing Associate',
                        'company' => 'Startup Hub',
                        'start_date' => '2015-01-01',
                        'end_date' => '2017-05-31',
                        'is_current' => false,
                        'description' => 'Assisted in campaign development and market research. Contributed to 25% increase in lead generation through email marketing initiatives.',
                    ],
                ],
                'educations' => [
                    [
                        'id' => 1,
                        'degree' => 'Bachelor of Business Administration',
                        'institution' => 'New York University',
                        'start_date' => '2011-09-01',
                        'end_date' => '2015-05-31',
                        'description' => 'Major in Marketing, Minor in Psychology. GPA: 3.8/4.0',
                    ],
                    [
                        'id' => 2,
                        'degree' => 'Digital Marketing Certification',
                        'institution' => 'Google',
                        'start_date' => '2020-01-01',
                        'end_date' => '2020-03-31',
                        'description' => 'Advanced certification in Google Ads and Analytics',
                    ],
                ],
                'skills' => [
                    ['id' => 1, 'name' => 'Digital Marketing', 'level' => 'Expert'],
                    ['id' => 2, 'name' => 'Brand Management', 'level' => 'Expert'],
                    ['id' => 3, 'name' => 'Social Media Marketing', 'level' => 'Advanced'],
                    ['id' => 4, 'name' => 'Content Strategy', 'level' => 'Advanced'],
                    ['id' => 5, 'name' => 'SEO/SEM', 'level' => 'Advanced'],
                    ['id' => 6, 'name' => 'Team Leadership', 'level' => 'Advanced'],
                    ['id' => 7, 'name' => 'Marketing Analytics', 'level' => 'Intermediate'],
                ],
                'projects' => [
                    [
                        'id' => 1,
                        'name' => 'Brand Relaunch Campaign',
                        'description' => 'Led comprehensive brand relaunch that increased market share by 25%',
                        'url' => null,
                        'role' => 'Project Lead',
                    ],
                ],
                'achievements' => [
                    [
                        'id' => 1,
                        'title' => 'Best Marketing Campaign Award',
                        'issuer' => 'Marketing Excellence Awards',
                        'date' => '2023-11-15',
                        'description' => 'Recognized for exceptional campaign creativity and ROI performance in digital marketing category.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Digital Marketing Certification',
                        'issuer' => 'Google Digital Academy',
                        'date' => '2022-06-10',
                        'description' => 'Advanced certification in Google Ads, Analytics, and comprehensive digital strategy.',
                    ],
                ],
                'passions' => [
                    [
                        'id' => 1,
                        'title' => 'Creative Writing',
                        'icon' => 'fa-pen-fancy',
                        'description' => 'Passionate about storytelling and content creation for various platforms.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Photography',
                        'icon' => 'fa-camera',
                        'description' => 'Enjoy capturing moments and visual storytelling through professional photography.',
                    ],
                ],
            ],
            2 => [
                'id' => 2,
                'title' => 'Sales Executive Premium Resume',
                'data' => [
                    'summary' => 'Results-driven sales professional with 9+ years of experience in B2B sales, account management, and business development. Proven track record of exceeding sales targets and building lasting client relationships. Expert in consultative selling and strategic account planning.',
                    'references' => [
                        [
                            'id' => 1,
                            'name' => 'Robert Thompson',
                            'title' => 'Sales Director',
                            'company' => 'BerGenBio Ferrells Ltd',
                            'phone' => '+44 20 7123 4567',
                            'email' => 'robert.thompson@example.com',
                        ],
                        [
                            'id' => 2,
                            'name' => 'Emma Richardson',
                            'title' => 'VP of Sales',
                            'company' => 'Hanover Ltd',
                            'phone' => '+44 20 7123 4568',
                            'email' => 'emma.r@example.com',
                        ],
                    ],
                ],
                'user' => [
                    'name' => 'Gesigan Jeevee May',
                    'email' => 'gesigan.may@example.com',
                    'userProfile' => [
                        'phone' => '+44 20 7946 0958',
                        'location' => 'London, UK',
                        'summary' => 'Dynamic sales executive specializing in B2B solutions with expertise in building strategic partnerships and driving revenue growth.',
                    ],
                ],
                'experiences' => [
                    [
                        'id' => 1,
                        'title' => 'Senior Sales Executive',
                        'company' => 'BerGenBio Ferrells Ltd',
                        'start_date' => '2018-03-01',
                        'end_date' => null,
                        'is_current' => true,
                        'description' => 'Managing key accounts and driving revenue growth of £2M+ annually. Recognized as Top Performer for 3 consecutive years (2021-2023). Developed and maintained relationships with 50+ enterprise clients.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Sales Representative',
                        'company' => 'Hanover Ltd',
                        'start_date' => '2015-06-01',
                        'end_date' => '2018-02-28',
                        'is_current' => false,
                        'description' => 'Successfully launched new product line generating £1M revenue in first quarter. Consistently exceeded quarterly targets by 25%. Built territory from ground up to £3M annual revenue.',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Junior Sales Associate',
                        'company' => 'Tech Solutions Inc',
                        'start_date' => '2014-01-01',
                        'end_date' => '2015-05-31',
                        'is_current' => false,
                        'description' => 'Supported senior sales team in client presentations and proposal development. Contributed to 30% increase in client retention through excellent follow-up.',
                    ],
                ],
                'educations' => [
                    [
                        'id' => 1,
                        'degree' => 'Bachelor of Business Administration (BBA)',
                        'institution' => 'University of London',
                        'start_date' => '2010-09-01',
                        'end_date' => '2014-06-30',
                        'description' => 'Major in Sales and Marketing. First Class Honours.',
                    ],
                    [
                        'id' => 2,
                        'degree' => 'Professional Sales Certification',
                        'institution' => 'Institute of Sales Management',
                        'start_date' => '2019-01-01',
                        'end_date' => '2019-06-30',
                        'description' => 'Advanced certification in consultative selling and account management',
                    ],
                ],
                'skills' => [
                    ['id' => 1, 'name' => 'B2B Sales', 'level' => 'Expert'],
                    ['id' => 2, 'name' => 'Account Management', 'level' => 'Expert'],
                    ['id' => 3, 'name' => 'Business Development', 'level' => 'Advanced'],
                    ['id' => 4, 'name' => 'CRM (Salesforce)', 'level' => 'Advanced'],
                    ['id' => 5, 'name' => 'Negotiation', 'level' => 'Expert'],
                    ['id' => 6, 'name' => 'Client Relations', 'level' => 'Expert'],
                    ['id' => 7, 'name' => 'Strategic Planning', 'level' => 'Advanced'],
                    ['id' => 8, 'name' => 'Team Leadership', 'level' => 'Intermediate'],
                ],
                'projects' => [
                    [
                        'id' => 1,
                        'name' => 'Enterprise Sales Initiative',
                        'description' => 'Led strategic initiative to penetrate enterprise market, resulting in 40% revenue increase',
                        'url' => null,
                        'role' => 'Lead Sales Executive',
                    ],
                ],
                'achievements' => [
                    [
                        'id' => 1,
                        'title' => 'Top Sales Performer 2023',
                        'issuer' => 'BerGenBio Ferrells Ltd',
                        'date' => '2023-12-20',
                        'description' => 'Exceeded annual sales target by 180%, highest in company history.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Sales Excellence Certificate',
                        'issuer' => 'Professional Sales Institute',
                        'date' => '2021-08-15',
                        'description' => 'Completed advanced training in consultative selling and negotiation strategies.',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Q1 Revenue Champion',
                        'issuer' => 'BerGenBio Ferrells Ltd',
                        'date' => '2023-03-31',
                        'description' => 'Generated £1.2M in new business revenue in single quarter.',
                    ],
                ],
                'passions' => [
                    [
                        'id' => 1,
                        'title' => 'Mentoring',
                        'icon' => 'fa-users',
                        'description' => 'Dedicated to coaching junior sales professionals and helping them achieve their goals.',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Business Reading',
                        'icon' => 'fa-book',
                        'description' => 'Avid reader of business strategy and sales psychology literature.',
                    ],
                    [
                        'id' => 3,
                        'title' => 'Golf',
                        'icon' => 'fa-golf-ball',
                        'description' => 'Enjoy networking and building client relationships on the golf course.',
                    ],
                ],
            ],
        ];

        $data = $dummyData[$templateId] ?? $dummyData[1];

        return (object) [
            'id' => $data['id'],
            'title' => $data['title'],
            'data' => $data['data'],
            'user' => (object) array_merge($data['user'], [
                'userProfile' => (object) $data['user']['userProfile'],
            ]),
            'experiences' => collect(array_map(fn($exp) => (object) $exp, $data['experiences'])),
            'educations' => collect(array_map(fn($edu) => (object) $edu, $data['educations'])),
            'skills' => collect(array_map(fn($skill) => (object) $skill, $data['skills'])),
            'projects' => collect(array_map(fn($proj) => (object) $proj, $data['projects'])),
            'achievements' => collect(array_map(fn($ach) => (object) $ach, $data['achievements'] ?? [])),
            'passions' => collect(array_map(fn($pass) => (object) $pass, $data['passions'] ?? [])),
        ];
    }
}
