# Email Campaign Package
## Quick Start Guide
### Prerequisites
- Laravel 12
- PHP 8.3
- MySQL

### Installation
#### 1. clone the project and add package to your Laravel project(right now package is accessed using local symlink):
        composer require tehseen/email-campaign
#### 2. Publish assets:
        php artisan vendor:publish --provider="Tehseen\EmailCampaign\Providers\EmailCampaignServiceProvider"
        php artisan vendor:publish --tag=email-campaign-config
        php artisan vendor:publish --tag=email-campaign-views

#### 3. Set up environment:
        SENDGRID_API_KEY=
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.sendgrid.net
        MAIL_PORT=587
        MAIL_USERNAME=apikey
        MAIL_PASSWORD=${SENDGRID_API_KEY}
        MAIL_ENCRYPTION=tls
#### 4.Start queue worker:
        php artisan queue:work --queue=emails

### Implementation Notes
Due to time constraints, the current implementation focuses on core functionality with these trade-offs:

#### Validation:

Currently handled in controllers

Should be moved to Form Request classes (Http/Requests/)

#### Architecture:

Business logic is in controllers/jobs

#### Should be refactored to:

Service layer for business logic

Repository pattern for data access

DTOs for request/response handling

#### Error Handling:
Basic exception handling implemented

Could be enhanced with custom exceptions

## Link for code using best practices
        https://github.com/tehseenahmed1995/feedback-backend/tree/master