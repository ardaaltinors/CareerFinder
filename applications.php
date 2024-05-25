<?php include 'templates/header.php'; ?>
<?php
include 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$creator_email = $_SESSION['user'];

$stmt = $pdo->prepare("SELECT * FROM jobs WHERE creator_email = :creator_email");
$stmt->execute(['creator_email' => $creator_email]);
$jobs = $stmt->fetchAll();

$applications = [];
foreach ($jobs as $job) {
    $stmt = $pdo->prepare("SELECT * FROM applications WHERE job_id = :job_id");
    $stmt->execute(['job_id' => $job['id']]);
    $applications[$job['id']] = $stmt->fetchAll();
}
?>

<section class="container mx-auto p-4 mt-4">
    <div class="rounded-lg shadow-md bg-white p-3">
        <h2 class="text-3xl font-bold mb-4">Job Applications</h2>
        <?php foreach ($jobs as $job) : ?>
            <div class="mb-6">
                <h3 class="text-xl font-semibold"><?php echo htmlspecialchars($job['title']); ?></h3>
                <?php if (!empty($applications[$job['id']])) : ?>
                    <ul class="list-disc pl-5">
                        <?php foreach ($applications[$job['id']] as $application) : ?>
                            <li class="mb-4">
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($application['applicant_name']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($application['email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($application['phone']); ?></p>
                                <p><strong>Cover Letter:</strong> <?php echo nl2br(htmlspecialchars($application['cover_letter'])); ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>No applications for this job yet.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'templates/footer.php'; ?>