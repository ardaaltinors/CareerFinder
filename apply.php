<?php include 'templates/header.php'; ?>
<?php include 'config.php'; ?>

<?php
$jobId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($jobId) {
    $stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = :id");
    $stmt->execute(['id' => $jobId]);
    $job = $stmt->fetch();

    if (!$job) {
        echo "<p>Job not found!</p>";
        include 'templates/footer.php';
        exit;
    }
} else {
    echo "<p>Invalid job ID!</p>";
    include 'templates/footer.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("INSERT INTO applications (job_id, applicant_name, email, phone, cover_letter) VALUES (:job_id, :applicant_name, :email, :phone, :cover_letter)");
        $stmt->execute([
            'job_id' => $jobId,
            'applicant_name' => $_POST['applicant_name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'cover_letter' => $_POST['cover_letter']
        ]);
        echo '<div class="bg-green-100 p-3 my-3">Application submitted successfully.</div>';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!-- Apply for Job Form Box -->
<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Apply for <?php echo htmlspecialchars($job['title']); ?></h2>
        <form method="POST" action="apply.php?id=<?php echo $jobId; ?>">
            <div class="mb-4">
                <input type="text" name="applicant_name" placeholder="Your Name" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="email" name="email" placeholder="Your Email" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="phone" placeholder="Your Phone" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <textarea name="cover_letter" placeholder="Cover Letter" class="w-full px-4 py-2 border rounded focus:outline-none" required></textarea>
            </div>
            <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">Submit Application</button>
            <a href="details.php?id=<?php echo $jobId; ?>" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">Cancel</a>
        </form>
    </div>
</section>

<?php include 'templates/footer.php'; ?>