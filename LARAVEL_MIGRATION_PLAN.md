# LARAVEL MIGRATION PLAN - IndoWater System
## Full Migration dari FastAPI + MongoDB ke Laravel + MySQL

---

## 📋 OVERVIEW

**Project:** IndoWater - Water Monitoring & Management System
**Migration Type:** Complete Backend Rewrite
**Stack:**
- **From:** FastAPI (Python) + MongoDB + React
- **To:** Laravel 11 (PHP) + MySQL + React

---

## 🎯 TECHNOLOGY STACK

### Backend - Laravel 11
- **Framework:** Laravel 11.x (Latest Stable - Released March 2024)
- **Authentication:** Laravel Sanctum (API Token Authentication)
- **Performance:** Laravel Octane (Swoole/RoadRunner)
- **WebSocket:** Laravel Reverb + Laravel Echo
- **Queue Management:** Laravel Horizon
- **Debugging:** Laravel Telescope
- **Monitoring:** Laravel Pulse
- **Code Quality:** Laravel Pint
- **Testing:** Laravel Dusk (Browser), PHPUnit (Unit)
- **Feature Flags:** Laravel Pennant
- **Validation:** Laravel Precognition

### Database - MySQL 8.0
- **Primary DB:** MySQL 8.0+
- **Migration Tool:** Laravel Migrations
- **Seeding:** Laravel Seeders

### Frontend - React (Existing)
- **Framework:** React 18
- **State Management:** Context API
- **HTTP Client:** Axios
- **WebSocket:** Laravel Echo (JavaScript)

---

## 📦 PHASE BREAKDOWN

### **PHASE 1: Laravel Setup & Core Infrastructure** ⏱️ Est: 2-3 hours
**Status:** ✅ **COMPLETED**
**Duration:** 2 hours
**Completed:** 2025-01-20

#### 1.1 Laravel Installation & Configuration
- [x] ✅ Install Laravel 11 via Composer
- [x] ✅ Configure environment (.env)
- [x] ✅ Setup MySQL database connection
- [x] ✅ Install core packages (Sanctum, Octane, Reverb, Telescope, Horizon, Pulse)
- [x] ✅ Configure CORS for React frontend
- [x] ✅ Setup file storage (local/cloud)

#### 1.2 Database Schema Design
Based on MongoDB collections, create MySQL schema:

**Tables Created:** ✅ **ALL 38 TABLES CREATED SUCCESSFULLY**
1. `users` - System users (admin, technician, customer)
2. `customers` - Customer information
3. `properties` - Property management
4. `devices` - IoT device registry
5. `water_usage` - Water consumption data
6. `payments` - Payment transactions
7. `vouchers` - Discount vouchers
8. `voucher_usages` - Voucher usage tracking
9. `support_tickets` - Support ticket system
10. `ticket_messages` - Ticket conversation
11. `ticket_attachments` - File attachments
12. `alerts` - System alerts
13. `alert_preferences` - User alert settings
14. `leak_detection_events` - Leak detection logs
15. `device_tampering_events` - Tampering detection
16. `water_conservation_tips` - Conservation tips
17. `roles` - Role management
18. `permissions` - Permission registry
19. `role_permissions` - Role-permission pivot
20. `user_roles` - User-role assignments
21. `iot_devices` - IoT device communication
22. `iot_readings` - Real-time sensor data
23. `maintenance_schedules` - Maintenance tracking
24. `work_orders` - Technician work orders
25. `activities` - Activity logs

**Deliverables:**
- ✅ Laravel project initialized
- ✅ All migrations created
- ✅ Database schema documented
- ✅ Seeders for demo data

---

### **PHASE 2: Authentication & Authorization System** ⏱️ Est: 3-4 hours
**Status:** 🔄 NOT STARTED

#### 2.1 User Authentication
- [ ] Setup Laravel Sanctum for API token authentication
- [ ] Create User model with roles (admin, technician, customer)
- [ ] Implement login endpoint (POST /api/auth/login)
- [ ] Implement logout endpoint (POST /api/auth/logout)
- [ ] Implement profile endpoint (GET /api/auth/me)
- [ ] Implement password reset flow
- [ ] JWT token generation & validation

#### 2.2 Role & Permission System
- [ ] Create Role model & migration
- [ ] Create Permission model & migration
- [ ] Implement role-based middleware
- [ ] Seed default roles (admin, technician, customer)
- [ ] Seed default permissions (40+ permissions across 14 categories)
- [ ] Role assignment API endpoints
- [ ] Permission checking utilities

**API Endpoints:**
```
POST   /api/auth/login
POST   /api/auth/logout
GET    /api/auth/me
POST   /api/auth/register
POST   /api/auth/password/reset
GET    /api/roles
POST   /api/roles
PUT    /api/roles/{id}
DELETE /api/roles/{id}
POST   /api/roles/assign
GET    /api/permissions
```

**Deliverables:**
- ✅ Authentication system working
- ✅ All 3 demo accounts (admin, technician, customer)
- ✅ Role & permission system functional
- ✅ API tokens working with Sanctum

---

### **PHASE 3: Core Modules - Part 1** ⏱️ Est: 4-5 hours
**Status:** 🔄 NOT STARTED

#### 3.1 Dashboard APIs
- [ ] Dashboard metrics endpoint
- [ ] User-specific statistics
- [ ] Admin system overview
- [ ] Real-time data aggregation

#### 3.2 User Management
- [ ] List users with filters (GET /api/users)
- [ ] Create user (POST /api/users)
- [ ] Update user (PUT /api/users/{id})
- [ ] Delete user (DELETE /api/users/{id})
- [ ] User search & pagination

#### 3.3 Customer Management
- [ ] List customers (GET /api/customers)
- [ ] Create customer (POST /api/customers)
- [ ] Update customer (PUT /api/customers/{id})
- [ ] Delete customer (DELETE /api/customers/{id})
- [ ] Customer devices (GET /api/customers/{id}/devices)
- [ ] Customer usage (GET /api/customers/{id}/usage)
- [ ] Customer payments (GET /api/customers/{id}/payments)
- [ ] Bulk operations

#### 3.4 Property Management
- [ ] List properties (GET /api/properties)
- [ ] Create property (POST /api/properties)
- [ ] Update property (PUT /api/properties/{id})
- [ ] Delete property (DELETE /api/properties/{id})
- [ ] Property devices

**API Endpoints (40+ endpoints)**

**Deliverables:**
- ✅ Dashboard working for all roles
- ✅ User CRUD complete
- ✅ Customer CRUD complete
- ✅ Property CRUD complete

---

### **PHASE 4: Core Modules - Part 2 (Devices & IoT)** ⏱️ Est: 5-6 hours
**Status:** 🔄 NOT STARTED

#### 4.1 Device Management
- [ ] List devices with comprehensive data
- [ ] Create device
- [ ] Update device
- [ ] Delete device
- [ ] Device statistics
- [ ] Device activities
- [ ] Batch operations
- [ ] Health score calculation

#### 4.2 IoT Monitoring & Real-time Data
- [ ] IoT device registration
- [ ] Real-time data ingestion (POST /api/iot/reading)
- [ ] Device status monitoring
- [ ] Historical data retrieval
- [ ] Device commands API
- [ ] WebSocket implementation (Laravel Reverb)
- [ ] Polling fallback option
- [ ] Admin setting for WebSocket/Polling toggle

#### 4.3 Water Usage Tracking
- [ ] Record water usage
- [ ] Usage history
- [ ] Usage analytics
- [ ] Anomaly detection

**API Endpoints (30+ endpoints)**

**Deliverables:**
- ✅ Device CRUD complete
- ✅ IoT real-time monitoring working
- ✅ WebSocket + Polling both functional
- ✅ Admin can toggle between WebSocket/Polling
- ✅ Water usage tracking operational

---

### **PHASE 5: Analytics & Reporting** ⏱️ Est: 4-5 hours
**Status:** 🔄 NOT STARTED

#### 5.1 Analytics APIs
- [ ] Usage analytics (GET /api/analytics/usage)
- [ ] Trends analysis (GET /api/analytics/trends)
- [ ] 7-day predictions (GET /api/analytics/predictions)
- [ ] Period comparison (GET /api/analytics/comparison)
- [ ] Admin overview (GET /api/analytics/admin/overview)

#### 5.2 Report Generation
- [ ] PDF export (Laravel DomPDF / SnappyPDF)
- [ ] Excel export (Laravel Excel / PhpSpreadsheet)
- [ ] Report templates
- [ ] Scheduled reports
- [ ] Email delivery

**API Endpoints:**
```
GET  /api/analytics/usage
GET  /api/analytics/trends
GET  /api/analytics/predictions
GET  /api/analytics/comparison
GET  /api/analytics/admin/overview
POST /api/reports/export-pdf
POST /api/reports/export-excel
```

**Deliverables:**
- ✅ Analytics APIs working
- ✅ PDF generation working
- ✅ Excel generation working
- ✅ All statistical calculations accurate

---

### **PHASE 6: Payment & Voucher System** ⏱️ Est: 4-5 hours
**Status:** 🔄 NOT STARTED

#### 6.1 Payment Integration
- [ ] Midtrans integration (sandbox)
- [ ] Xendit integration (sandbox)
- [ ] Payment history API
- [ ] Transaction status tracking
- [ ] Payment receipt generation

#### 6.2 Voucher System
- [ ] Create voucher
- [ ] Validate voucher
- [ ] Apply voucher
- [ ] Voucher usage tracking
- [ ] Active vouchers list
- [ ] Usage history

**API Endpoints:**
```
GET    /api/payments/history
GET    /api/payments/{id}
POST   /api/payments/initiate
POST   /api/payments/callback
GET    /api/vouchers
POST   /api/vouchers
PUT    /api/vouchers/{id}
DELETE /api/vouchers/{id}
POST   /api/vouchers/validate
POST   /api/vouchers/apply
GET    /api/vouchers/usage-history
```

**Deliverables:**
- ✅ Midtrans sandbox working
- ✅ Xendit sandbox working
- ✅ Payment flow complete
- ✅ Voucher system functional

---

### **PHASE 7: Support & Notification System** ⏱️ Est: 4-5 hours
**Status:** 🔄 NOT STARTED

#### 7.1 Support Tickets
- [ ] Create ticket
- [ ] List tickets with filters
- [ ] Ticket detail
- [ ] Add message to ticket
- [ ] Add attachment (with GPS + timestamp)
- [ ] Assign technician
- [ ] Update status
- [ ] Digital signature
- [ ] Admin statistics

#### 7.2 Alert & Notification System
- [ ] Alert creation
- [ ] Alert preferences
- [ ] Unread count
- [ ] Mark as read
- [ ] Leak detection service
- [ ] Device tampering detection
- [ ] Low balance alerts
- [ ] Email notifications (Laravel Mail)

**API Endpoints (25+ endpoints)**

**Deliverables:**
- ✅ Support ticket system working
- ✅ Alert system operational
- ✅ Email notifications sending
- ✅ Leak detection algorithm working

---

### **PHASE 8: Water Conservation & Admin Features** ⏱️ Est: 3-4 hours
**Status:** 🔄 NOT STARTED

#### 8.1 Water Conservation Tips
- [ ] List tips with filters
- [ ] Create tip (admin)
- [ ] Update tip
- [ ] Delete tip
- [ ] Tip engagement (like, bookmark, implement)
- [ ] Personalized recommendations

#### 8.2 Admin Management
- [ ] System metrics
- [ ] Device monitoring
- [ ] Bulk customer operations
- [ ] Maintenance scheduling
- [ ] Revenue reporting

**API Endpoints:**
```
GET    /api/tips
POST   /api/tips/admin/create
PUT    /api/tips/admin/{id}
DELETE /api/tips/admin/{id}
GET    /api/tips/{id}
POST   /api/tips/{id}/engage
GET    /api/tips/personalized
GET    /api/admin/dashboard/metrics
GET    /api/admin/devices/monitoring
POST   /api/admin/customers/bulk
POST   /api/admin/maintenance
GET    /api/admin/revenue/report
```

**Deliverables:**
- ✅ Conservation tips CRUD working
- ✅ Admin management APIs functional
- ✅ Bulk operations working

---

### **PHASE 9: Testing & Quality Assurance** ⏱️ Est: 3-4 hours
**Status:** 🔄 NOT STARTED

#### 9.1 Backend Testing
- [ ] Unit tests (PHPUnit)
- [ ] Feature tests for all endpoints
- [ ] Database seeding & factories
- [ ] API integration tests

#### 9.2 Performance Optimization
- [ ] Laravel Octane configuration
- [ ] Database query optimization
- [ ] Caching strategy (Redis)
- [ ] Queue configuration (Laravel Horizon)

#### 9.3 Code Quality
- [ ] Laravel Pint (code styling)
- [ ] PHPStan (static analysis)
- [ ] API documentation (OpenAPI/Swagger)

**Deliverables:**
- ✅ All tests passing
- ✅ Performance optimized
- ✅ Code quality verified
- ✅ API documentation complete

---

### **PHASE 10: Frontend Integration** ⏱️ Est: 4-5 hours
**Status:** 🔄 NOT STARTED

#### 10.1 React Frontend Updates
- [ ] Update API base URL to Laravel backend
- [ ] Update authentication flow (Sanctum tokens)
- [ ] Update all API endpoints
- [ ] WebSocket integration (Laravel Echo)
- [ ] Error handling updates
- [ ] Environment configuration

#### 10.2 WebSocket Client Setup
- [ ] Install Laravel Echo & Pusher JS
- [ ] Configure Reverb connection
- [ ] Real-time IoT data streaming
- [ ] Notification real-time updates

**Deliverables:**
- ✅ React frontend connected to Laravel
- ✅ All pages working
- ✅ WebSocket real-time updates functional
- ✅ Authentication flow working

---

### **PHASE 11: Deployment & Documentation** ⏱️ Est: 2-3 hours
**Status:** 🔄 NOT STARTED

#### 11.1 Deployment Configuration
- [ ] Laravel deployment guide
- [ ] MySQL database setup
- [ ] Environment variables documentation
- [ ] Server requirements
- [ ] Queue worker setup
- [ ] WebSocket server (Reverb) setup

#### 11.2 Documentation
- [ ] API documentation (Postman/Swagger)
- [ ] Database schema documentation
- [ ] Deployment guide
- [ ] Developer setup guide
- [ ] Migration guide (MongoDB to MySQL)

**Deliverables:**
- ✅ Deployment ready
- ✅ Complete documentation
- ✅ Migration guide
- ✅ API documentation

---

## 📊 PACKAGE USAGE MATRIX

| Package | Purpose | Phase | Required |
|---------|---------|-------|----------|
| **Laravel Sanctum** | API Token Authentication | Phase 2 | ✅ YES |
| **Laravel Octane** | Performance Boost (Swoole) | Phase 9 | ✅ YES |
| **Laravel Reverb** | WebSocket Server | Phase 4 | ✅ YES |
| **Laravel Echo** | WebSocket Client | Phase 10 | ✅ YES |
| **Laravel Horizon** | Queue Management | Phase 9 | ✅ YES |
| **Laravel Telescope** | Debugging & Monitoring | Phase 9 | ✅ YES |
| **Laravel Pulse** | Performance Monitoring | Phase 9 | ✅ YES |
| **Laravel Pint** | Code Styling | Phase 9 | ✅ YES |
| **Laravel Dusk** | Browser Testing | Phase 9 | ⚠️ OPTIONAL |
| **Laravel Passport** | OAuth2 Server | - | ❌ NO (using Sanctum) |
| **Laravel Fortify** | Auth Scaffolding | - | ❌ NO (custom auth) |
| **Laravel Folio** | Page Routing | - | ❌ NO (API only) |
| **Laravel Sail** | Docker Environment | - | ⚠️ OPTIONAL |
| **Laravel Pennant** | Feature Flags | Phase 4 | ✅ YES (WebSocket toggle) |
| **Laravel Precognition** | Form Validation | Phase 10 | ⚠️ OPTIONAL |

---

## 🎯 SUCCESS CRITERIA

### Backend
- ✅ All 150+ API endpoints working
- ✅ Authentication & authorization functional
- ✅ Real-time WebSocket + Polling working
- ✅ Payment integration (Midtrans + Xendit)
- ✅ Report generation (PDF + Excel)
- ✅ Email notifications working
- ✅ All unit & feature tests passing
- ✅ Performance optimized with Octane
- ✅ Queue system working with Horizon

### Frontend
- ✅ React app connected to Laravel
- ✅ All pages functional
- ✅ Real-time updates working
- ✅ Authentication flow working
- ✅ All features accessible

### Database
- ✅ MySQL schema complete
- ✅ All migrations successful
- ✅ Demo data seeded
- ✅ Relationships properly defined

---

## 📝 NOTES

### Laravel 11 Stability
**Answer:** YES, Laravel 11 is STABLE
- Released: March 12, 2024
- Current Version: 11.x (Actively maintained)
- LTS: No (Laravel 10 is LTS until 2025)
- Recommended: **Use Laravel 11** for newest features

### Authentication: Sanctum vs JWT
**Recommendation:** **Laravel Sanctum**
- ✅ Built-in, officially supported
- ✅ Simpler setup than JWT
- ✅ Perfect for SPA + API
- ✅ Token management built-in
- ✅ Better integration with Laravel ecosystem

### WebSocket: Reverb vs Pusher
**Recommendation:** **Laravel Reverb** (with Polling fallback)
- ✅ Free & open-source
- ✅ Built by Laravel team
- ✅ Easy deployment
- ✅ Admin can toggle WebSocket/Polling via feature flag

---

## 📦 ESTIMATED TIMELINE

| Phase | Duration | Dependencies |
|-------|----------|--------------|
| Phase 1 | 2-3 hours | None |
| Phase 2 | 3-4 hours | Phase 1 |
| Phase 3 | 4-5 hours | Phase 2 |
| Phase 4 | 5-6 hours | Phase 3 |
| Phase 5 | 4-5 hours | Phase 4 |
| Phase 6 | 4-5 hours | Phase 2 |
| Phase 7 | 4-5 hours | Phase 2 |
| Phase 8 | 3-4 hours | Phase 2 |
| Phase 9 | 3-4 hours | All previous |
| Phase 10 | 4-5 hours | All backend |
| Phase 11 | 2-3 hours | All phases |
| **TOTAL** | **38-51 hours** | - |

---

## 🚀 NEXT STEPS

1. **Review & Approve** this migration plan
2. **Start Phase 1** - Laravel setup & database schema
3. **Progressive Implementation** - Complete each phase systematically
4. **Testing** - Test after each phase completion
5. **Documentation** - Document as we build
6. **Frontend Integration** - Connect React after backend complete
7. **Final Testing** - End-to-end testing
8. **Deployment** - Production deployment guide

---

**Status:** 📋 PLAN CREATED - AWAITING APPROVAL
**Created:** 2025-01-20
**Version:** 1.0
