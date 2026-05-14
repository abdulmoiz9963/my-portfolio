@extends('layouts.app')

@section('content')

<!-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ -->
<section class="hero" id="home">
    <div class="hero-bg">
        <div class="grid-lines"></div>
        <div class="glow-orb glow-1"></div>
        <div class="glow-orb glow-2"></div>
    </div>
    <div class="hero-container">
        <div class="hero-text">
            <!-- <p class="hero-greeting">Hello, World! 👋</p> -->
            <h1 class="hero-name">
                I'm <span class="name-highlight">{{ $profile->name ?? 'Abdul Moiz Ashraf' }}</span>
            </h1>
            <div class="hero-role">
                <span class="role-prefix">$ </span>
                <span class="typed-text" id="typedText"></span>
                <span class="cursor-blink">|</span>
            </div>
            <p class="hero-bio">{{ $profile->tagline ?? 'Aspiring DevOps Engineer passionate about cloud infrastructure, CI/CD automation & container orchestration.' }}</p>
            <div class="hero-cta">
                <a href="#projects" class="btn-primary">
                    <i class="fas fa-rocket"></i> View My Work
                </a>
                <a href="#contact" class="btn-secondary">
                    <i class="fas fa-paper-plane"></i> Get In Touch
                </a>
            </div>
            <div class="hero-socials">
                <a href="https://www.linkedin.com/in/abdulmoiz-ashraf-b2997a206" target="_blank" class="social-link" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="https://github.com/abdulmoiz9963" target="_blank" class="social-link" aria-label="GitHub">
                    <i class="fab fa-github"></i>
                </a>
                <a href="mailto:{{ $profile->email ?? 'moiz9963@gmail.com' }}" class="social-link" aria-label="Email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>

        <div class="hero-image">
            <div class="image-frame">
                @if($profile && $profile->profile_image)
                    <img src="{{ $profile->profile_image }}">
                @else
                    <div class="profile-placeholder">
                        <i class="fas fa-user-astronaut"></i>
                    </div>
                @endif
                <div class="image-ring"></div>
                <div class="image-dot dot-1"></div>
                <div class="image-dot dot-2"></div>
            </div>
            <div class="stats-card card-1">
                <span class="stat-num">1+</span>
                <span class="stat-label">Year Exp</span>
            </div>
            <div class="stats-card card-2">
                <span class="stat-num">3+</span>
                <span class="stat-label">Projects</span>
            </div>
        </div>
    </div>
    <div class="scroll-hint">
        <span>Scroll Down</span>
        <div class="scroll-arrow"></div>
    </div>
</section>

<!-- ══════════════════════════════════════════════
     ABOUT
══════════════════════════════════════════════ -->
<section class="section about-section" id="about">
    <div class="container">
        <div class="section-header">
            <p class="section-tag">who am I</p>
            <h2 class="section-title">About <span class="accent">Me</span></h2>
        </div>
        <div class="about-grid">
            <div class="about-image-col">
                <div class="about-img-wrap">
                    @if($profile && $profile->profile_image)
                        <img src="{{ $profile->profile_image }}">
                    @else
                        <div class="about-placeholder"><i class="fas fa-user-astronaut"></i></div>
                    @endif
                    <div class="about-img-border"></div>
                    <div class="exp-badge">
                        <span class="badge-num">3.75</span>
                        <span class="badge-text">CGPA</span>
                    </div>
                </div>
            </div>
            <div class="about-content-col">
                <h3 class="about-heading">DevOps Engineer &amp; Cloud Enthusiast</h3>
                <p class="about-text">{{ $profile->about ?? 'Aspiring DevOps Engineer with hands-on experience in cloud infrastructure, CI/CD pipeline automation, and container orchestration. Currently pursuing Bachelor\'s in Computer Science at University of South Asia with a 3.75 CGPA.' }}</p>
                <div class="about-details">
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Location</span>
                        <span class="detail-value">{{ $profile->location ?? 'Lahore, Pakistan' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-envelope"></i> Email</span>
                        <span class="detail-value">{{ $profile->email ?? 'moiz9963@gmail.com' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-phone"></i> Phone</span>
                        <span class="detail-value">{{ $profile->phone ?? '03111458114' }}</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-graduation-cap"></i> Education</span>
                        <span class="detail-value">BSc Computer Science, 2021–25</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label"><i class="fas fa-language"></i> Languages</span>
                        <span class="detail-value">English, Urdu</span>
                    </div>
                </div>
                <a href="{{ route('cv.download') }}" class="btn-primary cv-btn">
                    <i class="fas fa-download"></i> Download CV
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════
     SKILLS
══════════════════════════════════════════════ -->
<section class="section skills-section" id="skills">
    <div class="container">
        <div class="section-header">
            <p class="section-tag">what I know</p>
            <h2 class="section-title">My <span class="accent">Skills</span></h2>
        </div>
        <div class="skills-grid">
            @forelse($skills as $category => $categorySkills)
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon">
                        @if($category == 'Cloud & AWS')
                            <i class="fab fa-aws"></i>
                        @elseif($category == 'CI/CD')
                            <i class="fas fa-infinity"></i>
                        @elseif($category == 'Containerization')
                            <i class="fab fa-docker"></i>
                        @elseif($category == 'IaC')
                            <i class="fas fa-layer-group"></i>
                        @elseif($category == 'Monitoring')
                            <i class="fas fa-chart-line"></i>
                        @else
                            <i class="fas fa-code"></i>
                        @endif
                    </div>
                    <h3 class="skill-category">{{ $category }}</h3>
                </div>
                <div class="skill-tags">
                    @foreach($categorySkills as $skill)
                    <span class="skill-tag">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon"><i class="fab fa-aws"></i></div>
                    <h3 class="skill-category">Cloud &amp; AWS</h3>
                </div>
                <div class="skill-tags">
                    <span class="skill-tag">EC2</span>
                    <span class="skill-tag">IAM</span>
                    <span class="skill-tag">VPC</span>
                    <span class="skill-tag">ECR</span>
                    <span class="skill-tag">Lambda</span>
                    <span class="skill-tag">API Gateway</span>
                    <span class="skill-tag">DynamoDB</span>
                    <span class="skill-tag">CloudWatch</span>
                    <span class="skill-tag">S3</span>
                    <span class="skill-tag">Route 53</span>
                    <span class="skill-tag">Auto Scaling</span>
                    <span class="skill-tag">ALB</span>
                </div>
            </div>
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon"><i class="fas fa-infinity"></i></div>
                    <h3 class="skill-category">CI/CD</h3>
                </div>
                <div class="skill-tags">
                    <span class="skill-tag">Jenkins</span>
                    <span class="skill-tag">GitHub Actions</span>
                    <span class="skill-tag">SonarQube</span>
                    <span class="skill-tag">Slack Notifications</span>
                </div>
            </div>
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon"><i class="fab fa-docker"></i></div>
                    <h3 class="skill-category">Containerization</h3>
                </div>
                <div class="skill-tags">
                    <span class="skill-tag">Docker</span>
                    <span class="skill-tag">Amazon ECS</span>
                    <span class="skill-tag">Amazon ECR</span>
                    <span class="skill-tag">NGINX</span>
                </div>
            </div>
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon"><i class="fas fa-layer-group"></i></div>
                    <h3 class="skill-category">Infrastructure as Code</h3>
                </div>
                <div class="skill-tags">
                    <span class="skill-tag">Terraform</span>
                    <span class="skill-tag">CloudFormation</span>
                </div>
            </div>
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon"><i class="fas fa-chart-line"></i></div>
                    <h3 class="skill-category">Monitoring &amp; Logging</h3>
                </div>
                <div class="skill-tags">
                    <span class="skill-tag">Prometheus</span>
                    <span class="skill-tag">Grafana</span>
                    <span class="skill-tag">AWS CloudWatch</span>
                </div>
            </div>
            <div class="skill-card reveal">
                <div class="skill-card-header">
                    <div class="skill-icon"><i class="fas fa-code-branch"></i></div>
                    <h3 class="skill-category">Version Control</h3>
                </div>
                <div class="skill-tags">
                    <span class="skill-tag">Git</span>
                    <span class="skill-tag">GitHub</span>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════
     EXPERIENCE
══════════════════════════════════════════════ -->
<section class="section experience-section" id="experience">
    <div class="container">
        <div class="section-header">
            <p class="section-tag">where I've worked</p>
            <h2 class="section-title">Work <span class="accent">Experience</span></h2>
        </div>
        <div class="timeline">
            @forelse($experiences as $exp)
            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-meta">
                        <span class="timeline-date">
                            <i class="fas fa-calendar-alt"></i>
                            {{ $exp->start_date }} — {{ $exp->end_date ?? 'Present' }}
                        </span>
                        <span class="timeline-type">{{ $exp->type ?? 'Full Time' }}</span>
                    </div>
                    <h3 class="timeline-role">{{ $exp->role }}</h3>
                    <p class="timeline-company"><i class="fas fa-building"></i> {{ $exp->company }}</p>
                    <p class="timeline-desc">{{ $exp->description }}</p>
                    @if($exp->tech_stack)
                    <div class="timeline-tags">
                        @foreach(explode(',', $exp->tech_stack) as $tech)
                        <span class="tech-tag">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-card">
                    <div class="timeline-meta">
                        <span class="timeline-date">
                            <i class="fas fa-calendar-alt"></i> June 2025 — Present
                        </span>
                        <span class="timeline-type">Full Time</span>
                    </div>
                    <h3 class="timeline-role">DevOps Engineer</h3>
                    <p class="timeline-company"><i class="fas fa-building"></i> Hybytes</p>
                    <p class="timeline-desc">Provisioning and automating cloud infrastructure on AWS using Terraform and CloudFormation. Building and maintaining CI/CD pipelines with GitHub Actions. Deploying containerized applications using ECS, and serverless apps using AWS Lambda integrated with API Gateway and DynamoDB. Monitoring infrastructure with AWS CloudWatch and following best practices in infrastructure security including IAM roles, secrets management, and network access control.</p>
                    <div class="timeline-tags">
                        <span class="tech-tag">AWS</span>
                        <span class="tech-tag">Terraform</span>
                        <span class="tech-tag">GitHub Actions</span>
                        <span class="tech-tag">ECS</span>
                        <span class="tech-tag">Lambda</span>
                        <span class="tech-tag">DynamoDB</span>
                        <span class="tech-tag">CloudWatch</span>
                        <span class="tech-tag">IAM</span>
                    </div>
                </div>
            </div>
            <div class="timeline-item reveal">
                <div class="timeline-dot"></div>
                <div class="timeline-card edu-card">
                    <div class="timeline-meta">
                        <span class="timeline-date">
                            <i class="fas fa-calendar-alt"></i> 2021 — 2025
                        </span>
                        <span class="timeline-type">Education</span>
                    </div>
                    <h3 class="timeline-role">Bachelor in Computer Science</h3>
                    <p class="timeline-company"><i class="fas fa-university"></i> University of South Asia</p>
                    <p class="timeline-desc">Graduated with a 3.75 CGPA. Focused on cloud computing, software engineering, and DevOps practices. Final year project: End-to-End Automation Platform with DevOps and CI/CD Integration.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════
     PROJECTS
══════════════════════════════════════════════ -->
<section class="section projects-section" id="projects">
    <div class="container">
        <div class="section-header">
            <p class="section-tag">what I've built</p>
            <h2 class="section-title">Featured <span class="accent">Projects</span></h2>
        </div>
        <div class="projects-grid">
            @forelse($projects as $project)
            <div class="project-card reveal">
                @if($project->image)
                <div class="project-img-wrap">
                    <img src="{{ $project->image }}">
                    <div class="project-overlay">
                        <div class="project-links">
                            @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" class="proj-link" title="Live Demo">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="proj-link" title="Source Code">
                                <i class="fab fa-github"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <div class="project-body">
                    <div class="project-header">
                        <span class="project-number">0{{ $loop->iteration }}</span>
                        <h3 class="project-title">{{ $project->title }}</h3>
                    </div>
                    <p class="project-desc">{{ $project->description }}</p>
                    @if($project->tech_stack)
                    <div class="project-stack">
                        @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="stack-tag">{{ trim($tech) }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="project-footer">
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" class="btn-proj">
                            Live Demo <i class="fas fa-arrow-right"></i>
                        </a>
                        @endif
                        @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn-proj-ghost">
                            <i class="fab fa-github"></i> Code
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="project-card featured reveal">
                <div class="project-body">
                    <div class="project-header">
                        <span class="project-number">01</span>
                        <h3 class="project-title">Travel Budgetor — End-to-End DevOps Platform</h3>
                    </div>
                    <span class="featured-badge">⭐ Final Year Project</span>
                    <p class="project-desc">A full-stack travel planning web application with a complete CI/CD pipeline. Built with React.js frontend, Node.js API, and MySQL database. Containerized with Docker and deployed on AWS EC2 with NGINX reverse proxy, HTTPS via Let's Encrypt SSL, and Route 53 domain configuration. Integrated Jenkins for CI/CD, SonarQube for code quality, and CloudWatch for monitoring.</p>
                    <div class="project-stack">
                        <span class="stack-tag">React.js</span>
                        <span class="stack-tag">Node.js</span>
                        <span class="stack-tag">MySQL</span>
                        <span class="stack-tag">Docker</span>
                        <span class="stack-tag">Jenkins</span>
                        <span class="stack-tag">NGINX</span>
                        <span class="stack-tag">AWS EC2</span>
                        <span class="stack-tag">ECR</span>
                        <span class="stack-tag">Route 53</span>
                        <span class="stack-tag">Auto Scaling</span>
                        <span class="stack-tag">CloudWatch</span>
                        <span class="stack-tag">SonarQube</span>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- ══════════════════════════════════════════════
     CONTACT
══════════════════════════════════════════════ -->
<section class="section contact-section" id="contact">
    <div class="container">
        <div class="section-header">
            <p class="section-tag">let's connect</p>
            <h2 class="section-title">Get In <span class="accent">Touch</span></h2>
        </div>
        <div class="contact-grid">
            <div class="contact-info">
                <p class="contact-intro">I'm currently open to new opportunities. Whether you have a question, project idea, or just want to say hi — my inbox is always open!</p>
                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                        <div>
                            <p class="contact-label">Email</p>
                            <a href="mailto:{{ $profile->email ?? 'moiz9963@gmail.com' }}" class="contact-value">
                                {{ $profile->email ?? 'moiz9963@gmail.com' }}
                            </a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-phone"></i></div>
                        <div>
                            <p class="contact-label">Phone</p>
                            <a href="tel:{{ $profile->phone ?? '03111458114' }}" class="contact-value">
                                {{ $profile->phone ?? '03111458114' }}
                            </a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fab fa-linkedin"></i></div>
                        <div>
                            <p class="contact-label">LinkedIn</p>
                            <a href="https://www.linkedin.com/in/abdulmoiz-ashraf-b2997a206" target="_blank" class="contact-value">
                                abdulmoiz-ashraf
                            </a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <p class="contact-label">Location</p>
                            <p class="contact-value">{{ $profile->location ?? 'Lahore, Pakistan' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <form class="contact-form" action="{{ route('contact.send') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="someone@example.com" required>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Project Inquiry" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Tell me about your project..." required></textarea>
                </div>
                <button type="submit" class="btn-primary btn-full">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
