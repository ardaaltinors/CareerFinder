<?php include 'templates/header.php'; ?>
<?php
include 'config.php';

$jobId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$jobId) {
    echo "<p>Invalid job ID!</p>";
    include 'templates/footer.php';
    exit;
}

// Fetch job details
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = :id");
$stmt->execute(['id' => $jobId]);
$job = $stmt->fetch();

// Check if the logged-in user is the creator of the job
if ($job['creator_email'] !== $_SESSION['user']) {
    echo "<p>You do not have permission to edit this job listing!</p>";
    include 'templates/footer.php';
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $pdo->prepare("UPDATE jobs SET title = :title, description = :description, salary = :salary, location = :location, tags = :tags, requirements = :requirements, benefits = :benefits, company = :company, address = :address, city = :city, state = :state, phone = :phone, email = :email WHERE id = :id");
        $stmt->execute([
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'salary' => $_POST['salary'],
            'location' => $_POST['city'] . ', ' . $_POST['state'],
            'tags' => $_POST['tags'],
            'requirements' => $_POST['requirements'],
            'benefits' => $_POST['benefits'],
            'company' => $_POST['company'],
            'address' => $_POST['address'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'id' => $jobId
        ]);
        echo '<div class="bg-green-100 p-3 my-3">Job listing updated successfully.</div>';
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!-- Edit Job Form Box -->
<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
        <form method="POST" action="edit.php?id=<?php echo $jobId; ?>">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Job Info</h2>
            <div class="mb-4">
                <input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" placeholder="Job Title" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <textarea name="description" placeholder="Job Description" class="w-full px-4 py-2 border rounded focus:outline-none" required><?php echo htmlspecialchars($job['description']); ?></textarea>
            </div>
            <div class="mb-4">
                <input type="text" name="salary" value="<?php echo htmlspecialchars($job['salary']); ?>" placeholder="Annual Salary" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="requirements" value="<?php echo htmlspecialchars($job['requirements']); ?>" placeholder="Requirements" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="benefits" value="<?php echo htmlspecialchars($job['benefits']); ?>" placeholder="Benefits" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="tags" value="<?php echo htmlspecialchars($job['tags']); ?>" placeholder="Tags (comma separated)" class="w-full px-4 py-2 border rounded focus:outline-none" />
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">Company Info & Location</h2>
            <div class="mb-4">
                <input type="text" name="company" value="<?php echo htmlspecialchars($job['company']); ?>" placeholder="Company Name" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="address" value="<?php echo htmlspecialchars($job['address']); ?>" placeholder="Address" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="city" value="<?php echo htmlspecialchars($job['city']); ?>" placeholder="City" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="state" value="<?php echo htmlspecialchars($job['state']); ?>" placeholder="State" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="text" name="phone" value="<?php echo htmlspecialchars($job['phone']); ?>" placeholder="Phone" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <div class="mb-4">
                <input type="email" name="email" value="<?php echo htmlspecialchars($job['email']); ?>" placeholder="Email Address For Applications" class="w-full px-4 py-2 border rounded focus:outline-none" required />
            </div>
            <button class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">Save</button>
            <a href="listings.php" class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none">Cancel</a>
        </form>
    </div>
</section>

<!-- Bottom Banner -->
<section class="container mx-auto my-6">
    <div class="bg-blue-800 text-white rounded p-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Looking to hire?</h2>
            <p class="text-gray-200 text-lg mt-2">Post your job listing now and find the perfect candidate.</p>
        </div>
        <a href="post-job.php" class="bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded hover:shadow-md transition duration-300">
            <i class="fa fa-edit"></i> Post a Job
        </a>
    </div>
</section>

<?php include 'templates/footer.php'; ?>