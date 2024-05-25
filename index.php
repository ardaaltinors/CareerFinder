<?php include 'templates/header.php'; ?>

<!-- Showcase -->
<section class="showcase relative bg-cover bg-center bg-no-repeat h-72 flex items-center">
    <div class="overlay"></div>
    <div class="container mx-auto text-center z-10">
        <h2 class="text-4xl text-white font-bold mb-4">Find Your Dream Job</h2>
        <form class="mb-4 block mx-5 md:mx-auto">
            <input type="text" name="keywords" placeholder="Keywords" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
            <input type="text" name="location" placeholder="Location" class="w-full md:w-auto mb-2 px-4 py-2 focus:outline-none" />
            <button class="w-full md:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 focus:outline-none">
                <i class="fa fa-search"></i> Search
            </button>
        </form>
    </div>
</section>

<!-- Top Banner -->
<section class="bg-blue-900 text-white py-6 text-center">
    <div class="container mx-auto">
        <h2 class="text-3xl font-semibold">Unlock Your Career Potential</h2>
        <p class="text-lg mt-2">Discover the perfect job opportunity for you.</p>
    </div>
</section>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <?php
            include 'data/jobs.php';

            foreach ($jobs as $jobId => $job) {
                echo '<div class="rounded-lg shadow-md bg-white">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold">' . $job["title"] . '</h2>
                            <p class="text-gray-700 text-lg mt-2">
                                ' . $job["description"] . '
                            </p>
                            <ul class="my-4 bg-gray-100 p-4 rounded">
                                <li class="mb-2"><strong>Salary:</strong> ' . $job["salary"] . '</li>
                                <li class="mb-2"><strong>Location:</strong> ' . $job["location"] . '
                                    <span class="text-xs bg-blue-500 text-white rounded-full px-2 py-1 ml-2">' . $job["type"] . '</span>
                                </li>
                                <li class="mb-2"><strong>Tags:</strong> ';
                foreach ($job["tags"] as $tag) {
                    echo '<span>' . $tag . '</span>, ';
                }
                echo '</li>
                            </ul>
                            <a href="details.php?id=' . $jobId . '" class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200">Details</a>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <a href="listings.php" class="block text-xl text-center">
            <i class="fa fa-arrow-alt-circle-right"></i> Show All Jobs
        </a>
    </div>
</section>

<?php include 'templates/footer.php'; ?>