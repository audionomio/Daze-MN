# Daze MN — Changelog

Modernized fork of the [Daze WordPress Theme](http://daze.nordwoodthemes.com/) v4.1 by NordWood Themes.

---

## Why this fork exists

The Daze theme has not been maintained for several years. While still visually beautiful, it had:

- **Deprecated PHP patterns** (`extract()`, `wp_get_recent_posts()`) that will break on future PHP versions
- **A broken Instagram integration** — the old approach scraped `window._sharedData` from Instagram profile pages, which Instagram disabled around 2020
- **Hundreds of lines of demo code** hardcoded for categories that don't exist on a real site, adding unnecessary overhead to every page load
- **Unconditional script loading** (jQuery UI Draggable, Facebook SDK, gallery scripts on every page)
- **A Customizer bug** that prevented disabling the site frame border

---

## New files

### `inc/class-daze-instagram-api.php`

New helper class for the Instagram Graph API. Replaces the old scraping method with a proper authenticated API integration.

- Fetches media via `graph.instagram.com/me/media` with transient caching (2 hours)
- Filters out Reels/Videos — only images and carousel albums are returned
- Automatic token refresh via WP cron every 50 days (tokens last 60 days)
- Methods: `get_media()`, `get_username()`, `refresh_token()`, `test_connection()`, `clear_cache()`, `get_image_url()`

### `admin/instagram-settings.php`

New admin page at **Settings > Instagram** for managing the Instagram API connection.

- Access token input with save/test/clear-cache buttons
- Token expiry display with days remaining (red warning when < 7 days)
- Step-by-step instructions for obtaining a Meta Graph API token
- AJAX-powered test and cache-clear actions with nonce verification

---

## Modified files

### `style.css`

Theme header updated:

| Field | Original | Fork |
|-------|----------|------|
| Theme Name | Daze | Daze MN |
| Version | 4.1 | 5.0 |
| Author | NordWood Themes | NordWood Themes (forked by MN) |
| Description | Blog theme in Masonry style. | Modernized fork of Daze. Blog theme in Masonry style. |

### `functions.php`

- **WordPress version requirement** raised from `4.5-alpha` to `6.0`
- **Instagram API files** loaded via two new `require_once` calls
- **Cron schedule** registered for automatic Instagram token refresh (`daze_50_days` interval)

### `header.php`

- **Removed** the empty `<div id="fb-root"></div>` (Facebook SDK placeholder) — the SDK is now loaded conditionally via `scripts-register.php`
- **Removed** demo slider code that conditionally rendered post sliders for non-existent demo categories

### `category.php`

Massive cleanup (~200 lines removed). Seven demo code blocks deleted that:

- Overrode layout type, width, and sidebar settings based on hardcoded demo category slugs
- Injected special widgets (image box, social box, top posts) into the masonry loop at calculated positions
- Conditionally hid the archive header for demo categories
- Conditionally skipped the excerpt template part for a specific demo category

All layout settings now come purely from the WordPress Customizer.

### `inc/template-tags.php`

The largest set of changes (~300 lines of demo code removed across 7 locations):

- **Demo overrides removed** from body class, masonry class, slider class, post categories, and slider functions — all layout/width/column/pagination settings now use only Customizer values
- **`extract()` replaced** in the gallery shortcode with explicit `$atts` variable assignment
- **`wp_get_recent_posts()` replaced** with `get_posts()` and array-style access (`$post['ID']`) changed to object access (`$post->ID`)
- **Hardcoded Facebook App ID removed** — replaced with `get_theme_mod('daze_fb_app_id', '')`, only output when configured
- **Demo category exclusion removed** from the category listing function

### `inc/filters-and-hooks.php`

- **Two demo code blocks removed** that overrode layout type and width for demo categories
- **`daze_filter_categories_widget()` fixed** — the function called `get_category_by_slug('daze-demo-...')->term_id` for five non-existent categories, causing PHP fatal errors. Replaced with a simple pass-through that returns `$cat_args` unchanged
- **`extract()` replaced** in the gallery shortcode with explicit variable assignment

### `inc/scripts-register.php`

Performance improvements:

- **`jquery-ui-draggable` removed** — was loaded unconditionally on every page with no visible use
- **`display=swap` added** to the Google Fonts URL — prevents invisible text while fonts load (FOIT)
- **Facebook SDK loading made conditional** — only loads when the Facebook Badge widget is active (`is_active_widget()` check)
- **Gallery slider scripts scoped** to `is_singular()` — prevents loading on archive/index pages
- **Demo category script overrides removed**

### `admin/customizer/dynamic-styles.php`

- **Site frame Customizer bug fixed** — the original code `if ( ( 5 !== $v = get_theme_mod(...) ) && $v )` prevented setting the frame width to `0` because `0` is falsy in PHP. Split into `$v = intval(get_theme_mod(...))` followed by `if ( 5 !== $v )`, so `0` is now a valid value

### `css/dynamic-styles.css`

- **Default site frame border disabled** — border-width changed from `5px`/`7px` to `0` for both mobile and desktop. Can be re-enabled via Appearance > Customize > Color Scheme

### Widget files — `extract()` removal

Seven widget files received the same PHP modernization. The pattern:

```php
extract($args);
```

was replaced with explicit variable assignment in each:

```php
$before_widget = $args['before_widget'];
$after_widget  = $args['after_widget'];
$before_title  = $args['before_title'];
$after_title   = $args['after_title'];
```

**Files:** `admin/widgets/author.php`, `admin/widgets/image-widget.php`, `admin/widgets/latest-comments.php`, `admin/widgets/popout.php`, `admin/widgets/social.php`, `admin/widgets/tagcloud.php`, `admin/widgets/top-posts.php`

**Why:** `extract()` is considered a security risk and was deprecated in most coding standards. It creates variables from array keys in the current scope, making code harder to read and audit. WordPress itself [discourages its use](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/#dont-extract).

### `admin/widgets/top-posts.php`

In addition to `extract()` removal:

- `wp_get_recent_posts()` replaced with `get_posts()`
- Array-style access (`$latest["ID"]`, `$latest["post_title"]`) changed to object property access (`$latest->ID`, `$latest->post_title`)

### `admin/widgets/instagram-carousel.php`

Fully rewritten to use the Instagram Graph API:

- Calls `Daze_Instagram_API::get_media()` instead of scraping `instagram.com/<username>`
- Username field removed from widget settings (now centralized in Settings > Instagram)
- Likes/comments overlay removed (not available via Graph API for personal accounts)
- Admin-only diagnostic messages when API returns errors
- Cache cleared on widget settings save
- Kept identical HTML structure and CSS classes for Slick slider compatibility

### `admin/widgets/instagram-grid.php`

Same rewrite as the carousel — migrated from scraping to Graph API with identical structural changes.

---

## Child theme: `daze-mn-child`

A minimal child theme for site-specific customizations.

| File | Purpose |
|------|---------|
| `style.css` | Theme header (`Template: daze-mn`) + CRP plugin styling (thumbnail size, overlay, heading) |
| `functions.php` | Enqueues parent + child stylesheets with unique handle names |
| `screenshot.png` | Theme preview image |

---

## Summary

| Category | Files | Lines removed | Lines added |
|----------|-------|---------------|-------------|
| Demo code removal | 6 | ~600 | 0 |
| Instagram Graph API | 4 new/rewritten + functions.php | ~250 | ~600 |
| `extract()` removal | 9 widgets | 9 | 36 |
| Deprecated function updates | 2 | ~15 | ~15 |
| Performance (scripts) | 1 | ~10 | ~15 |
| Bug fixes (Customizer, categories widget) | 2 | ~5 | ~10 |
| Theme metadata | 2 | 4 | 4 |
| Child theme | 3 new | 0 | ~75 |
