<?php
$active_tab = 'careers';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM careers WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/careers.php?deleted=1");
    exit;
}

// Add Job
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        die("Security error.");
    }
    $title = trim($_POST['title'] ?? '');
    $department = trim($_POST['department'] ?? 'Legal & IPR');
    $job_type = trim($_POST['job_type'] ?? 'Full Time');
    $experience = trim($_POST['experience'] ?? '2-5 Years');
    $location = trim($_POST['location'] ?? 'Patna Office');
    $description = trim($_POST['description'] ?? '');
    $requirements = trim($_POST['requirements'] ?? '');

    if (!empty($title)) {
        $stmt = $pdo->prepare("INSERT INTO careers (title, department, job_type, experience, location, description, requirements, posted_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), 'published')");
        $stmt->execute([$title, $department, $job_type, $experience, $location, $description, $requirements]);
        header("Location: " . BASE_URL . "/admin/careers.php?saved=1");
        exit;
    }
}

$careers = $pdo->query("SELECT * FROM careers ORDER BY id DESC")->fetchAll();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Careers &amp; Job Openings Manager</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Post new legal vacancies and manage active job listings.</p>
        </div>
        <a href="<?= BASE_URL ?>/career.php" target="_blank" class="btn btn-navy btn-sm">
            <i class="fa fa-eye"></i> View Live Careers Page
        </a>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Job posting added successfully!</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Job posting removed.</div>
    <?php endif; ?>

    <!-- Add Job Opening Card -->
    <div class="admin-card" style="border-left: 4px solid var(--accent);">
        <h2>Post New Legal Vacancy</h2>
        <form action="<?= BASE_URL ?>/admin/careers.php" method="POST">
            <?= csrf_field() ?>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Job Title *</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Trademark Prosecution Associate" required>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Department</label>
                    <input type="text" name="department" class="form-control" value="Intellectual Property Rights">
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Job Type</label>
                    <input type="text" name="job_type" class="form-control" value="Full Time">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Required Experience</label>
                    <input type="text" name="experience" class="form-control" placeholder="e.g. 2-4 Years">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Office Location</label>
                    <input type="text" name="location" class="form-control" value="Patna Head Office / Hybrid">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700;">Role Responsibilities / Description *</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Key responsibilities and day-to-day legal tasks..." required></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size:0.84rem; font-weight:700;">Qualifications &amp; Education Requirements</label>
                <textarea name="requirements" class="form-control" rows="2" placeholder="e.g. LL.B. with Registered Trademark / Patent Agent qualification."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-briefcase"></i> Publish Vacancy
            </button>
        </form>
    </div>

    <!-- Active Jobs Table -->
    <div class="admin-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Title &amp; Department</th>
                    <th>Type &amp; Experience</th>
                    <th>Location</th>
                    <th>Description</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($careers as $c): ?>
                    <tr>
                        <td>
                            <strong><?= e($c['title']) ?></strong><br>
                            <span style="font-size:0.82rem; color:var(--text-muted);"><?= e($c['department']) ?></span>
                        </td>
                        <td>
                            <?= e($c['job_type']) ?><br>
                            <span style="font-size:0.82rem; color:var(--text-muted);"><?= e($c['experience']) ?></span>
                        </td>
                        <td><?= e($c['location']) ?></td>
                        <td style="font-size:0.86rem; color:var(--text-muted); max-width:320px;">
                            <?= e(mb_strimwidth($c['description'], 0, 120, '...')) ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/careers.php?delete=<?= $c['id'] ?>" onclick="return confirm('Delete this job opening?')" style="color:#ef4444;">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
