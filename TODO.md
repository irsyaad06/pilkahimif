# TODO: Implement Google OAuth Login for Filament v4

## Steps to Complete

1. **Install Laravel Socialite**  
   - Run `composer require laravel/socialite` to enable Google OAuth.

2. **Update User Model**  
   - Add `is_admin` to `$fillable` in `app/Models/User.php`.  
   - Ensure no password-related fields or methods.

3. **Create Custom Filament Login Page**  
   - Create `app/Filament/Pages/Auth/Login.php` class.  
   - Create `resources/views/filament/auth/login.blade.php` view with "Login with Google" button.

4. **Add Google Auth Routes**  
   - Update `routes/web.php` to include `/auth/google/redirect` and `/auth/google/callback`.

5. **Create GoogleAuthController**  
   - Create `app/Http/Controllers/GoogleAuthController.php` with `redirect` and `callback` methods.  
   - Handle user creation/update, set `is_admin` based on admin emails, login with 'web' guard, redirect accordingly.

6. **Create AdminOnly Middleware**  
   - Create `app/Http/Middleware/AdminOnly.php` to block non-admins from Filament.

7. **Update AdminPanelProvider**  
   - In `app/Providers/Filament/AdminPanelProvider.php`, set custom login page, add AdminOnly middleware.

8. **Configure Environment**  
   - Add `GOOGLE_CLIENT_ID`, `GOOGLE_CLIENT_SECRET`, `GOOGLE_REDIRECT` to `.env`.  
   - Add `ADMIN_EMAILS` to `.env` (comma-separated list of admin emails).

9. **Test the System**  
   - Run migrations if needed.  
   - Test admin login redirects to /admin.  
   - Test student login redirects to /voting.  
   - Ensure no password fields or auth.

## Notes
- Admin emails should be set in `.env` as `ADMIN_EMAILS=admin1@example.com,admin2@example.com`.  
- Use guard 'web' for authentication.  
- No password fields in User model or auth.
