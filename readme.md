```
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
```

- https://getbootstrap.com/docs/5.0/utilities/background/
- https://getbootstrap.com/docs/4.0/components/button-group/
- https://getbootstrap.com/docs/4.0/components/forms/