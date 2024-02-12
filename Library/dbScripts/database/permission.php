<?php
$file = 'error.log';

// Set read-only permissions
if (chmod($file, 0444)) {
    echo 'File is now read-only. Deletion is blocked.';
} else {
    echo 'Failed to set permissions. Check file path and permissions.';
}
?>
