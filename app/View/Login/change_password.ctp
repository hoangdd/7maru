<div class="col-md-4 users form">
    <form id="changePassword" type="form" method="post">
        <h1>Change Password</h1>

        <div class="form-group">
            <label for="currentPassword">Current Password</label>
            <input type="password" name='current-pw' class="form-control">
            <?php if (!empty($error["current"])) { ?>
                <span class="text-danger "><?php echo $error["current"]; ?></span>
            <?php } else echo '</br>'; ?>

        </div>
        <span><?php echo $this->Session->read("password"); ?></span>
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" name='new-pw' class="form-control">
            <?php if (!empty($error["new"])) { ?>
                <span class="text-danger "><?php echo $error["new"]; ?></span>
            <?php } else echo '</br>'; ?>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name='confirm-pw' class="form-control">
            <?php if (!empty($error["confirm"])) { ?>
                <span class="text-danger "><?php echo $error["confirm"]; ?></span>
            <?php } else echo '</br>'; ?>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</div>