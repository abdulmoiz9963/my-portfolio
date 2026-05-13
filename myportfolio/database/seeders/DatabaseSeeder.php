<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        \App\Models\User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name'     => 'Abdul Moiz Ashraf',
                'password' => Hash::make('Admin@1234'),
            ]
        );

        // Profile
        Profile::firstOrCreate(['email' => 'moiz9963@gmail.com'], [
            'name'     => 'Abdul Moiz Ashraf',
            'phone'    => '03111458114',
            'location' => 'Lahore, Pakistan',
            'tagline'  => 'Aspiring DevOps Engineer',
            'linkedin' => 'https://www.linkedin.com/in/abdul-moiz-ashraf-b2997a206',
            'about'    => 'Aspiring DevOps Engineer with hands-on experience in cloud infrastructure, CI/CD pipeline automation, and container orchestration on AWS. Passionate about building scalable, reliable, and secure systems. Currently pursuing Bachelor\'s in Computer Science at University of South Asia with a 3.75 CGPA.',
        ]);

        // Skills
        $skills = [
            ['name' => 'EC2',          'category' => 'Cloud & AWS',           'sort_order' => 1],
            ['name' => 'IAM',          'category' => 'Cloud & AWS',           'sort_order' => 2],
            ['name' => 'VPC',          'category' => 'Cloud & AWS',           'sort_order' => 3],
            ['name' => 'ECR',          'category' => 'Cloud & AWS',           'sort_order' => 4],
            ['name' => 'ALB',          'category' => 'Cloud & AWS',           'sort_order' => 5],
            ['name' => 'Lambda',       'category' => 'Cloud & AWS',           'sort_order' => 6],
            ['name' => 'API Gateway',  'category' => 'Cloud & AWS',           'sort_order' => 7],
            ['name' => 'DynamoDB',     'category' => 'Cloud & AWS',           'sort_order' => 8],
            ['name' => 'S3',           'category' => 'Cloud & AWS',           'sort_order' => 9],
            ['name' => 'Route 53',     'category' => 'Cloud & AWS',           'sort_order' => 10],
            ['name' => 'CloudWatch',   'category' => 'Cloud & AWS',           'sort_order' => 11],
            ['name' => 'Auto Scaling', 'category' => 'Cloud & AWS',           'sort_order' => 12],
            ['name' => 'Jenkins',      'category' => 'CI/CD',                 'sort_order' => 1],
            ['name' => 'GitHub Actions','category'=> 'CI/CD',                 'sort_order' => 2],
            ['name' => 'SonarQube',    'category' => 'CI/CD',                 'sort_order' => 3],
            ['name' => 'Docker',       'category' => 'Containerization',      'sort_order' => 1],
            ['name' => 'Amazon ECS',   'category' => 'Containerization',      'sort_order' => 2],
            ['name' => 'NGINX',        'category' => 'Containerization',      'sort_order' => 3],
            ['name' => 'Terraform',    'category' => 'Infrastructure as Code','sort_order' => 1],
            ['name' => 'CloudFormation','category' => 'Infrastructure as Code','sort_order'=> 2],
            ['name' => 'Prometheus',   'category' => 'Monitoring & Logging',  'sort_order' => 1],
            ['name' => 'Grafana',      'category' => 'Monitoring & Logging',  'sort_order' => 2],
            ['name' => 'Git',          'category' => 'Version Control',       'sort_order' => 1],
            ['name' => 'GitHub',       'category' => 'Version Control',       'sort_order' => 2],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill['name'], 'category' => $skill['category']], $skill);
        }

        // Experience
        Experience::firstOrCreate(['company' => 'Hybytes', 'role' => 'DevOps Engineer'], [
            'start_date'  => 'June 2025',
            'end_date'    => null,
            'type'        => 'Full Time',
            'sort_order'  => 1,
            'tech_stack'  => 'AWS,Terraform,CloudFormation,GitHub Actions,ECS,Lambda,DynamoDB,CloudWatch,IAM,S3',
            'description' => 'Provisioning and automating cloud infrastructure on AWS using Terraform and CloudFormation. Building and maintaining CI/CD pipelines with GitHub Actions for smooth deployments. Deploying containerized applications using ECS and serverless apps using AWS Lambda integrated with API Gateway and DynamoDB. Working with Amazon S3 for static content hosting and monitoring infrastructure performance using AWS CloudWatch. Following best practices in infrastructure security including IAM roles, secrets management, and network access control.',
        ]);

        Experience::firstOrCreate(['company' => 'University of South Asia', 'role' => 'Bachelor in Computer Science'], [
            'start_date'  => '2021',
            'end_date'    => '2025',
            'type'        => 'Education',
            'sort_order'  => 2,
            'description' => 'Graduated with a 3.75 CGPA. Focused on cloud computing, software engineering, DevOps practices, and full-stack development. Final year project: End-to-End Automation Platform with DevOps and CI/CD Integration.',
        ]);

        // Projects
        Project::firstOrCreate(['title' => 'Travel Budgetor — End-to-End DevOps Platform'], [
            'description'  => 'A full-stack travel planning web application with complete CI/CD pipeline. Users input their budget and receive tailored travel plan recommendations. Built with React.js frontend, Node.js backend API, and MySQL database. Containerized with Docker and deployed on AWS EC2 with NGINX reverse proxy and HTTPS via Let\'s Encrypt SSL. Configured Route 53 domain, implemented Jenkins CI/CD pipeline, integrated SonarQube for code quality, managed Docker images through Amazon ECR, enabled Auto Scaling, and used CloudWatch for monitoring and alerts.',
            'tech_stack'   => 'React.js,Node.js,MySQL,Docker,Jenkins,NGINX,AWS EC2,ECR,Route 53,Auto Scaling,CloudWatch,SonarQube,Slack',
            'is_featured'  => true,
            'category'     => 'DevOps / Full Stack',
            'sort_order'   => 1,
        ]);
    }
}
