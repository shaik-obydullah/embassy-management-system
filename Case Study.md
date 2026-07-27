# Case Study: Embassy Management System

## Modernizing Consular Services — From Legacy CodeIgniter to Laravel 13

---

## Executive Summary

The **Embassy Management System** is a complete rebuild of the Bangladesh Embassy in Lisbon's operational platform, originally developed in 2020 using CodeIgniter. The modernization project migrated the entire system to **Laravel 13** with a fully containerized **Docker** infrastructure, delivering a modern, maintainable, and scalable web application for managing consular services, citizen records, passport applications, and appointment scheduling.

The rebuilt system serves three user roles — **Super Admin**, **Admin**, and **Client** — across a comprehensive feature set spanning 38 Blade views, 19 Eloquent models, 15 controllers, and 28 database tables.

---

## Background & Problem Statement

### The Legacy System

The original Embassy Management System was built in 2020 using **CodeIgniter** (PHP framework) and was actively used in production at the Bangladeshi Embassy in Lisbon, Portugal. The system handled:

- Citizen registration and record management
- Passport application processing
- Consular service requests
- Appointment scheduling

**Repository:** [github.com/skarnov/bangladesh-embassy-in-portugal](https://github.com/skarnov/bangladesh-embassy-in-portugal)

### Challenges with the Legacy System

| Challenge | Impact |
|-----------|--------|
| **Outdated Framework** | CodeIgniter's declining community support and ecosystem |
| **No Containerization** | Difficult deployment, inconsistent environments |
| **Limited RBAC** | Basic role handling without granular permissions |
| **No Audit Trail** | No tracking of changes or user activities |
| **Monolithic Structure** | Tightly coupled code difficult to extend |
| **No Modern Frontend** | Server-rendered pages without interactive UI components |

### Project Objectives

1. **Complete rewrite** in a modern Laravel framework
2. **Docker-based infrastructure** for consistent development and deployment
3. **Role-Based Access Control** with granular permissions
4. **Activity logging** and audit trail capabilities
5. **Interactive client portal** for self-service appointment booking
6. **Comprehensive admin panel** for embassy staff operations
7. **CMS capabilities** for managing public content

---

## Technical Architecture

### Technology Stack

| Layer | Technology | Version |
|-------|-----------|---------|
| Backend | Laravel | 13.x |
| PHP Runtime | PHP | 8.4 (FPM) |
| Frontend Templates | Blade + Alpine.js | 3.15 |
| CSS Framework | Tailwind CSS | 4.0 |
| Build Tool | Vite | 8.0 |
| Database | MySQL | 8.0 |
| Cache / Sessions | Redis | Alpine |
| Web Server | Nginx | Alpine |
| RBAC | Spatie Permission | 8.3 |
| PDF Generation | DomPDF | 3.1 |

### Docker Infrastructure

The application runs on a 4-container Docker architecture:

```
┌─────────────────────────────────────────────┐
│                embassy_network               │
│                  (bridge)                    │
│                                             │
│  ┌──────────────┐    ┌──────────────────┐   │
│  │ embassy_nginx │───▶│ embassy_container │   │
│  │   (port 8080) │    │   (PHP 8.4-FPM)  │   │
│  └──────────────┘    └────────┬─────────┘   │
│                               │              │
│                    ┌──────────┼──────────┐   │
│                    │          │          │   │
│               ┌────▼───┐  ┌──▼────────┐ │   │
│               │ MySQL  │  │   Redis    │ │   │
│               │ (3306) │  │  (6379)   │ │   │
│               └────────┘  └───────────┘ │   │
│                                          │   │
└──────────────────────────────────────────┘
```

### Database Design

**28 tables** organized into three categories:

#### Core Domain Tables (18)

| Table | Purpose | Key Features |
|-------|---------|--------------|
| `embassy_citizens` | Citizen profiles | 20+ fields, polymorphic relations |
| `embassy_services` | Service catalog | Categories, fees, document requirements |
| `embassy_appointments` | Appointment bookings | Slot-based scheduling, reference numbers |
| `embassy_appointment_slots` | Time slots | Date/time, capacity management |
| `embassy_passports` | Passport applications | Status workflow (5 stages) |
| `embassy_consulars` | Consular requests | Service-linked, status tracking |
| `embassy_contents` | CMS pages | Publish workflow, author tracking |
| `embassy_activities` | Audit log | Polymorphic, before/after values |
| `embassy_areas` | Geographic data | 21 Portuguese districts |
| `embassy_occupations` | Reference data | 15 occupation categories |
| `embassy_cart` | Shopping cart | Fee collection workflow |
| `embassy_social` | Social welfare | Service type tracking |
| `embassy_comments` | Comments | Polymorphic, status moderation |
| `embassy_covid19` | Health tracking | Vaccination & test records |
| `embassy_reissue` | Reissue requests | Linked to passport records |

#### RBAC Tables (5)

Managed by Spatie Permission: `roles`, `permissions`, `model_has_roles`, `model_has_permissions`, `role_has_permissions`

#### Framework Tables (5)

Standard Laravel: `users`, `sessions`, `cache`, `jobs`, `failed_jobs`

---

## Features & Implementation

### 1. Multi-Role Authentication System

**Three distinct user roles** with different access levels:

| Role | Access Level | Key Capabilities |
|------|-------------|------------------|
| **Super Admin** | Full system access | User management, reports, all CRUD operations |
| **Admin** | Operational access | Citizen management, services, appointments |
| **Client** | Self-service portal | Profile management, appointment booking, services |

**Implementation:**
- Custom `RoleMiddleware` using Spatie's `hasAnyRole()` method
- Session-based authentication with Redis-backed sessions
- Automatic role assignment during registration (new users → `client`)
- 11 granular permissions across three role levels

### 2. Admin Dashboard

A comprehensive command center providing:

- **Real-time Statistics:** Total citizens, active services, today's appointments, pending passports
- **Quick Actions Grid:** One-click access to common operations
- **Activity Feed:** Recent system activities with timestamps
- **Visual Reports:** Bar charts for appointments by status, passport processing, monthly trends

### 3. Citizen Management

Full CRUD with advanced features:

- **Multi-column Search:** Search across name, passport number, phone, email simultaneously
- **Auto Account Creation:** Creating a citizen automatically generates a user account with `client` role
- **Profile Viewing:** Complete citizen profile with related appointments, passports, and consular records
- **Accessors:** Computed `full_name` and `area_of_residence` fields for consistent display

### 4. Service Management

Embassy services with rich metadata:

- **5 Categories:** Passport, Consular, Visa, Legal, Other
- **Fee Management:** Decimal-precision fee tracking
- **Document Requirements:** JSON-based document lists (one per line input)
- **Estimated Processing Days:** SLA tracking per service
- **Active/Inactive Toggle:** Soft service management

### 5. Appointment Booking System

A 3-step wizard for clients:

```
Step 1: Select Service  →  Step 2: Select Time Slot  →  Step 3: Confirm & Submit
```

**Technical Implementation:**
- Alpine.js wizard pattern (`x-data="{ step: 1 }"`, `x-show="step === N"`)
- Slot-based scheduling with capacity management
- Auto-generated reference numbers: `EMB-{YYYYMMDD}-{XXXX}`
- Status workflow: `pending → confirmed → completed/cancelled`

### 6. Passport Application Tracking

5-stage processing workflow:

```
pending → processing → ready → delivered
                    ↘ rejected
```

- Application types: New, Renewal, Replacement
- Reference number tracking
- Delivery date management

### 7. Content Management System

Full CMS for embassy pages:

- Create, edit, delete content pages
- Publish/unpublish workflow
- Author tracking with user relationships
- Slug-based URL generation

### 8. Reporting & Analytics

Visual reporting dashboard:

- **Appointments by Status:** Distribution analysis
- **Passports by Status:** Processing pipeline visibility
- **Monthly Appointments:** 12-month trend analysis
- **Citizens by Area:** Geographic distribution

---

## Design Patterns & Best Practices

### Architectural Patterns

| Pattern | Application |
|---------|------------|
| **MVC** | Controllers organized by domain (Admin/, Client/, Auth/) |
| **Repository-like Models** | 19 Eloquent models with relationship definitions |
| **Middleware Pipeline** | Auth + Role checking via middleware stack |
| **Service Containers** | Docker containerization of all services |
| **Template Inheritance** | 4 distinct Blade layouts |
| **Polymorphic Relations** | Activity logging, comments, status tracking |

### Code Conventions

- **Table Prefix:** `embassy_` for all domain tables (inherited from legacy)
- **Model Naming:** `Embassy` prefix for all domain models
- **Route Naming:** Dot notation (`admin.citizens.index`)
- **View Organization:** Mirrors controller namespace structure
- **PHP 8 Attributes:** Used for `$fillable`, `$hidden` configuration
- **Modern Casts:** `casts()` method returning arrays (not `$casts` property)

### Security Measures

- **CSRF Protection:** Laravel's built-in token verification on all forms
- **Role-Based Authorization:** Middleware prevents unauthorized access
- **Password Hashing:** Automatic via Laravel's `'hashed'` cast
- **Input Validation:** Comprehensive validation rules on all form submissions
- **SQL Injection Prevention:** Eloquent ORM parameterized queries throughout
- **XSS Prevention:** Blade's automatic HTML escaping (`{{ }}`)

---

## Project Metrics

| Metric | Value |
|--------|-------|
| **Total PHP Files** | 50+ (controllers, models, middleware, seeders) |
| **Blade Templates** | 38 views across 4 layouts |
| **Database Tables** | 28 (18 domain + 5 RBAC + 5 framework) |
| **Database Columns** | 230+ across all tables |
| **Routes** | 39+ (public + admin + client) |
| **Controllers** | 15 (8 admin + 4 client + 2 auth + 1 public) |
| **Eloquent Models** | 19 |
| **Roles** | 3 (superadmin, admin, client) |
| **Permissions** | 11 granular permissions |
| **Seeded Users** | 4 test accounts |
| **Seeded Services** | 10 embassy services |
| **Seeded Areas** | 21 Portuguese districts |
| **Seeded Occupations** | 15 categories |

---

## Deployment & Operations

### Quick Start

```bash
# Clone and start
docker-compose up -d

# Install dependencies
docker exec embassy_container composer install
docker exec embassy_container npm install && npm run build

# Seed database
docker exec embassy_container php artisan migrate:fresh --seed

# Access application
# http://localhost:8080
```

### Environment Configuration

- `.env.docker` — Docker-specific environment variables
- Redis for sessions, cache, and queue
- MySQL 8.0 with `utf8mb4` character set
- Nginx reverse proxy with FastCGI to PHP-FPM

---

## Lessons Learned

### 1. Containerization First
Building with Docker from day one eliminated "works on my machine" issues and provided consistent environments for development and testing.

### 2. Polymorphic Relationships Pay Off
Using Laravel's polymorphic relationships for activities, comments, and status tracking created a flexible system that can easily accommodate new entity types.

### 3. Alpine.js for Lightweight Interactivity
Choosing Alpine.js over heavier SPA frameworks kept the frontend simple while providing excellent UX for forms and interactive components.

### 4. Role-Based Architecture Matters
Implementing granular RBAC early (with Spatie Permission) ensured security was built into the foundation rather than bolted on later.

### 5. Comprehensive Seeding Accelerates Development
Rich seed data (21 areas, 15 occupations, 10 services, 4 users) made testing and development significantly faster.

---

## Future Enhancements

| Priority | Enhancement | Description |
|----------|------------|-------------|
| High | PDF Export | DomPDF integration for appointment receipts and reports |
| High | Email Notifications | Automated appointment confirmations and status updates |
| Medium | API Layer | RESTful API for mobile app integration |
| Medium | Multi-Language | Portuguese/English/Bengali language support |
| Medium | Payment Integration | Online fee collection for services |
| Low | Mobile App | React Native companion application |
| Low | Analytics Dashboard | Advanced reporting with date range filters |

---

## Conclusion

The Embassy Management System rebuild demonstrates how legacy government systems can be modernized using contemporary web technologies while maintaining operational continuity. The Laravel 13 + Docker stack provides a robust, maintainable, and scalable platform that serves the needs of embassy staff and Bangladeshi citizens in Portugal.

The project showcases the power of **AI-assisted development** — the entire system was designed, built, tested, and debugged through collaborative work between a human developer and AI agents, achieving in days what traditionally takes weeks of development.

---

**Repository:** [github.com/shaik-obydullah/embassy-management-system](https://github.com/shaik-obydullah/embassy-management-system)  
**Live Demo:** [obydullah.com/projects/embassy-management-system](https://obydullah.com/projects/embassy-management-system)  
**Technology:** Laravel 13 • PHP 8.4 • Docker • MySQL 8.0 • Redis • Alpine.js • Tailwind CSS 4  
**Author:** Shaik Obydullah  
**Year:** 2026  
**License:** MIT
