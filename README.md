# baka

# Ivo Pure 104269

---


---
You can also use an additional time stamp to regenerate the session ID periodically to avoid attacks on sessions like session fixation:

if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} else if (time() - $_SESSION['CREATED'] > 1800) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
}
