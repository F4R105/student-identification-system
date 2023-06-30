<div id="addGuardFormOverlay">
    <form action="../../process/add_guard.php" method="POST" enctype="multipart/form-data">
        <h1>Add Guard</h1>
        <div id="profile_image">
            <span>DP</span>
            <img alt="guard profile picture" />
        </div>
        <div>
            <label for="name">Name *</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label for="guard_id">Guard ID *</label>
            <input type="text" name="guard_id" required>
        </div>
        <div>
            <label for="phone">Phone number *</label>
            <input type="text" name="phone" placeholder="+255000000000" required>
        </div>
        <div>
            <label for="password">Temporary password *</label>
            <p class="info">Expires within 30 minutes</p>
            <div class="psd_gen">
                <input type="text" name="password" readonly placeholder="####">
                <button>Generate</button>
            </div>
        </div>
        <div>
            <label for="profile_picture">Profile picture *</label>
            <p class="info">JPG, JPEG, PNG, 10mb maximum file size</p>
            <input type="file" name="profile_picture">
        </div>
        <div>
            <button type="submit">Add guard</button>
        </div>
    </form>
</div>