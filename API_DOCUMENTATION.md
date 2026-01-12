# Resume Portfolio API Documentation

## Base URL
```
Production: https://yourdomain.com/api/v1
Development: http://localhost:8000/api/v1
```

## Authentication

All protected endpoints require a Bearer token in the Authorization header:
```
Authorization: Bearer {token}
```

### Register
**POST** `/auth/register`

**Request Body:**
```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "token": "1|xxxxxxxxxxxx",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "profile": {}
    }
  },
  "message": "Registration successful"
}
```

### Login
**POST** `/auth/login`

**Headers (Optional for Mobile):**
- `X-Device-Name`: Device name (e.g., "iPhone 14 Pro")
- `X-Device-ID`: Unique device identifier

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "token": "1|xxxxxxxxxxxx",
    "user": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com"
    }
  },
  "message": "Login successful"
}
```

### Get Current User
**GET** `/auth/me`

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "profile": {},
    "subscription": {
      "plan": {
        "name": "Premium",
        "price": 29.99
      }
    }
  }
}
```

## Resumes

### List Resumes
**GET** `/resumes`

**Query Parameters:**
- `page`: Page number (default: 1)
- `per_page`: Items per page (default: 15)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Software Engineer Resume",
      "completeness": 85,
      "template": {
        "name": "Modern",
        "is_premium": false
      }
    }
  ],
  "pagination": {
    "current_page": 1,
    "last_page": 5,
    "per_page": 15,
    "total": 75
  }
}
```

### Create Resume
**POST** `/resumes`

**Request Body:**
```json
{
  "title": "My Resume",
  "resume_template_id": 1,
  "data": {
    "personal": {
      "name": "John Doe",
      "email": "john@example.com"
    },
    "experience": [],
    "education": [],
    "skills": []
  }
}
```

### Update Resume
**PUT** `/resumes/{id}`

### Delete Resume
**DELETE** `/resumes/{id}`

### Duplicate Resume
**POST** `/resumes/{id}/duplicate`

### Export PDF
**POST** `/resumes/{id}/export`

**Response:**
```json
{
  "success": true,
  "data": {
    "path": "resumes/1-1234567890.pdf",
    "url": "https://yourdomain.com/storage/resumes/1-1234567890.pdf"
  }
}
```

### Get Completeness Score
**GET** `/resumes/{id}/completeness`

**Response:**
```json
{
  "success": true,
  "data": {
    "score": 85
  }
}
```

### Publish Resume (Get Share Link)
**POST** `/resumes/{id}/publish`

**Response:**
```json
{
  "success": true,
  "data": {
    "share_url": "/api/v1/share/resumes/abc-123-def",
    "token": "abc-123-def"
  }
}
```

## Portfolios

### List Portfolios
**GET** `/portfolios`

### Create Portfolio
**POST** `/portfolios`

**Request Body:**
```json
{
  "title": "My Portfolio",
  "slug": "john-doe",
  "bio": "Software engineer...",
  "projects": [
    {
      "title": "Project 1",
      "description": "Description",
      "url": "https://example.com"
    }
  ]
}
```

### Publish Portfolio
**POST** `/portfolios/{id}/publish`

**Response:**
```json
{
  "success": true,
  "data": {
    "public_url": "/api/v1/portfolios/public/john-doe"
  }
}
```

## Templates

### List Templates
**GET** `/templates`

**Query Parameters:**
- `premium`: Filter premium templates (true/false)

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Modern",
      "slug": "modern",
      "is_premium": false,
      "preview_url": "https://..."
    }
  ]
}
```

## Payments

### List Plans
**GET** `/plans`

### Create Checkout
**POST** `/payments/checkout`

**Request Body:**
```json
{
  "plan_id": 1,
  "provider": "stripe" // or "paypal"
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "checkout_url": "https://checkout.stripe.com/...",
    "session_id": "cs_xxxxx"
  }
}
```

### Payment History
**GET** `/payments/history`

### Current Subscription
**GET** `/subscriptions/current`

## AI Features

### Generate Cover Letter
**POST** `/ai/cover-letter`

**Request Body:**
```json
{
  "job_description": "We are looking for...",
  "resume_id": 1
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "cover_letter": "Dear Hiring Manager..."
  }
}
```

## Error Responses

All errors follow this format:

```json
{
  "success": false,
  "message": "Error message",
  "errors": {
    "field": ["Validation error"]
  }
}
```

**Status Codes:**
- `200` - Success
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

## Mobile App Considerations

### Token Management
- Tokens expire after 1 year by default (configurable via `SANCTUM_TOKEN_EXPIRATION`)
- Store tokens securely (Keychain on iOS, Keystore on Android)
- Implement token refresh logic

### Device Headers
Include these headers for better tracking:
- `X-Device-Name`: Device model/name
- `X-Device-ID`: Unique device identifier
- `X-App-Version`: App version number
- `X-Platform`: `ios` or `android`

### File Uploads
- Maximum file size: 10MB (configurable)
- Supported formats: PDF, images
- Use multipart/form-data for file uploads

### Pagination
- Default: 15 items per page
- Maximum: 100 items per page
- Use `page` and `per_page` query parameters

### Rate Limiting
- 60 requests per minute per IP
- 1000 requests per hour per authenticated user

## CORS Configuration

CORS is enabled for all API routes. Configure allowed origins in `.env`:
```
CORS_ALLOWED_ORIGINS=https://yourdomain.com,https://app.yourdomain.com
```

For mobile apps, use `*` or your app's domain.
