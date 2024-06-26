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
?>

<section class="container mx-auto p-4 mt-4">
    <div class="rounded-lg shadow-md bg-white p-3">
        <div class="flex justify-between items-center">
            <a class="block p-4 text-blue-700" href="listings.php">
                <i class="fa fa-arrow-alt-circle-left"></i>
                Back To Listings
            </a>
            <div class="flex space-x-4 ml-4">
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] === $job['creator_email']) : ?>
                    <a href="edit.php?id=<?php echo $jobId; ?>" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded">Edit</a>
                    <!-- Delete Form -->
                    <form method="POST" action="delete.php">
                        <input type="hidden" name="id" value="<?php echo $jobId; ?>">
                        <button type="submit" class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded">Delete</button>
                    </form>
                    <!-- End Delete Form -->
                <?php endif; ?>
            </div>
        </div>
        <div class="p-4">
            <h2 class="text-xl font-semibold"><?php echo htmlspecialchars($job['title']); ?></h2>
            <p class="text-gray-700 text-lg mt-2"><?php echo htmlspecialchars($job['description']); ?></p>
            <ul class="my-4 bg-gray-100 p-4">
                <li class="mb-2"><strong>Salary:</strong> <?php echo htmlspecialchars($job['salary']); ?></li>
                <li class="mb-2">
                    <strong>Location:</strong> <?php echo htmlspecialchars($job['location']); ?>
                    <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2"><?php echo htmlspecialchars($job['type']); ?></span>
                </li>
                <li class="mb-2"><strong>Tags:</strong> <?php echo htmlspecialchars($job['tags']); ?></li>
            </ul>
        </div>
    </div>
</section>

<section class="container mx-auto p-4">
    <h2 class="text-xl font-semibold mb-4">Job Details</h2>
    <div class="rounded-lg shadow-md bg-white p-4">
        <h3 class="text-lg font-semibold mb-2 text-blue-500">Job Requirements</h3>
        <p><?php echo htmlspecialchars($job['requirements']); ?></p>
        <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">Benefits</h3>
        <p><?php echo htmlspecialchars($job['benefits']); ?></p>
    </div>
    <a href="apply.php?id=<?php echo $jobId; ?>" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium cursor-pointer text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
        Apply Now
    </a>
</section>

<?php include 'templates/footer.php'; ?>