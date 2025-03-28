<?php
session_start();
//var_dump($data);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Penelitian</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?= CSS; ?>/main/hasil-penelitian.css">
</head>

<body class="bg-white">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <?php include_once '../app/views/assets/components/navbar.php'; ?>
    <?php else: ?>
        <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
    <?php endif; ?>
    <section class="min-h-screen py-20 relative overflow-hidden">
        <div class="container mx-auto px-6 max-w-7xl">
            <!-- Header -->
            <div class="mb-20">
                <span class="inline-block px-4 py-2 bg-red-50 text-red-600 rounded-full text-sm font-medium mb-4">
                    Hasil Penelitian
                </span>
                <h2 class="text-5xl font-bold mb-6 text-red-900">
                    Hasil Penelitian
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full"></div>
            </div>

            <!-- Topics Navigation -->
            <div class="flex gap-8 mb-16 overflow-x-auto pb-4 -mx-6 px-6">
                <?php
                $topics = ['Semua', 'DIPA SWADANA', 'DIPA PNBP', 'Tesis Magister'];
                foreach ($topics as $index => $topic): ?>
                    <button class="topic-button px-4 py-2 text-gray-600 hover:text-red-600 font-medium transition-all whitespace-nowrap <?php echo $index === 0 ? 'active' : ''; ?>"
                        onclick="filter(<?php echo $index; ?>)">
                        <?php echo $topic; ?>
                    </button>
                <?php endforeach; ?>
            </div>

            <!-- Files Grid -->
            <div class="files-container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if (isset($data['researchOutputs']) && !empty($data['researchOutputs'])): ?>
                    <?php foreach ($data['researchOutputs'] as $item): ?>
                        <div class="file-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300">
                            <!-- Category Badge -->
                            <div class="px-6 py-4 border-b border-gray-100">
                                <span class="inline-block px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-full">
                                    <?php echo htmlspecialchars($item['category'] ?? 'research'); ?>
                                </span>
                            </div>

                            <!-- File Info -->
                            <div class="p-6">
                                <div class="flex items-start gap-4">
                                    <!-- File Icon -->
                                    <div class="text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                    </div>

                                    <!-- Title and Description -->
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 mb-1">
                                            <?php echo htmlspecialchars($item['title']); ?>
                                        </h3>
                                        <p class="text-sm text-gray-500 mb-2">
                                            <?php echo htmlspecialchars($item['description']); ?>
                                        </p>
                                        <span class="text-xs text-gray-400">
                                            Uploaded on <?php echo date('d M Y', strtotime($item['uploaded_at'])); ?>
                                        </span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                                    <!-- Preview Button -->
                                    <button onclick="previewFile('<?php echo htmlspecialchars($item['file_url']); ?>')"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Preview">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>

                                    <!-- Download Button -->
                                    <a href="<?= FILES . '/' . $item['file_url']; ?>"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        download>
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>

                                    <!-- Delete Button (Admin Only) -->
                                    <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                                        <button onclick="deleteFile(<?= $item['research_output_id']; ?>)"
                                            class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Delete">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10">
                        <p class="text-gray-500 text-lg">
                            Belum ada hasil penelitian saat ini.
                        </p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <nav aria-label="Page navigation example" id="pagination">
                    <ul class="flex items-center -space-x-px h-8 text-sm">
                        <?php
                        // Fungsi untuk membuat rentang halaman dengan ellipsis
                        function getPaginationRange($totalPages, $currentPage, $delta = 2)
                        {
                            $range = [];
                            $left = $currentPage - $delta;
                            $right = $currentPage + $delta;
                            for ($i = 1; $i <= $totalPages; $i++) {
                                if ($i == 1 || $i == $totalPages || ($i >= $left && $i <= $right)) {
                                    $range[] = $i;
                                } elseif (end($range) !== '...') {
                                    $range[] = '...';
                                }
                            }
                            return $range;
                        }

                        // Tampilkan pagination hanya jika total halaman lebih dari 1
                        if ($data['totalPages'] > 1) {
                            $currentPage = $data['currentPage'];
                            $totalPages = $data['totalPages'];
                            $pageRange = getPaginationRange($totalPages, $currentPage);

                            // Tombol Previous
                            if ($currentPage > 1) {
                                echo '<li>
                        <a href="?page=' . ($currentPage - 1) . '" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    </li>';
                            }

                            // Tombol halaman
                            foreach ($pageRange as $page) {
                                if ($page === '...') {
                                    echo '<li>
                            <span class="flex items-center justify-center px-3 h-8 text-gray-500">...</span>
                        </li>';
                                } elseif ($page == $currentPage) {
                                    echo '<li>
                            <a href="?page=' . $page . '" aria-current="page" class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700">
                                ' . $page . '
                            </a>
                        </li>';
                                } else {
                                    echo '<li>
                            <a href="?page=' . $page . '" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                ' . $page . '
                            </a>
                        </li>';
                                }
                            }

                            // Tombol Next
                            if ($currentPage < $totalPages) {
                                echo '<li>
                        <a href="?page=' . ($currentPage + 1) . '" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Next</span>
                            <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    </li>';
                            }
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <!-- Preview Modal -->
    <div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl max-w-4xl w-full mx-4 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">File Preview</h3>
                <button onclick="closePreview()" class="text-gray-500 hover:text-red-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div id="previewContent" class="w-full h-[600px]">
                <!-- Preview content will be loaded here -->
            </div>
        </div>
    </div>

    <script>
        function filter(status, page = 1) {
            $.ajax({
                url: '<?= BASEURL ?>/home/filterHasilPenelitian',
                method: 'POST',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    status: status,
                    page: page
                }),
                success: function(response) {
                    if (!response || !response.data) {
                        console.error('Invalid response format');
                        return;
                    }

                    const fileContainer = $('.files-container');
                    const navElement = document.getElementById('pagination');

                    // Bersihkan kontainer file dan navigasi
                    fileContainer.empty();
                    navElement.innerHTML = '';

                    // Jika tidak ada data file
                    if (response.data.length === 0) {
                        fileContainer.html(`
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-10">
                        <p class="text-gray-500 text-lg">
                            Belum ada hasil penelitian saat ini.
                        </p>
                    </div>
                `);
                        return;
                    }

                    // Tampilkan file-file dalam kontainer
                    response.data.forEach(file => {
                        const fileHTML = `
                    <div class="file-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 visible" data-file-id="${file.research_output_id}">
                        <!-- Category Badge -->
                        <div class="px-6 py-4 border-b border-gray-100">
                            <span class="inline-block px-3 py-1 text-xs font-medium text-red-600 bg-red-50 rounded-full">
                                ${file.category}
                            </span>
                        </div>
                        <!-- File Info -->
                        <div class="p-6">
                            <div class="flex items-start gap-4">
                                <!-- File Icon -->
                                <div class="text-gray-400">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <!-- Title and Description -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-1">${file.title}</h3>
                                    <p class="text-sm text-gray-500 mb-2">${file.description}</p>
                                    <span class="text-xs text-gray-400">
                                        Uploaded on ${new Date(file.uploaded_at).toLocaleDateString('id-ID', {
                                            day: '2-digit', month: 'short', year: 'numeric'
                                        })}
                                    </span>
                                </div>
                            </div>
                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-gray-100">
                                <!-- Preview Button -->
                                <button onclick="previewFile('${file.file_url}')"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                        title="Preview">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <!-- Download Button -->
                                <a href="${file.file_url}" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" download>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                </a>
                                <!-- Delete Button (Admin Only) -->
                                <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1): ?>
                                    <button onclick="deleteFile(<?= $item['research_output_id']; ?>)"
                                            class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                            title="Delete">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                `;
                        fileContainer.append(fileHTML);
                    });

                    // Pagination: tampilkan jika total halaman lebih dari 1
                    if (response.totalPages > 1) {
                        const totalPages = response.totalPages;
                        const currentPage = response.page;

                        // Fungsi helper untuk mendapatkan rentang halaman dengan ellipsis
                        function getPaginationRange(totalPages, currentPage, delta = 2) {
                            const range = [];
                            let left = currentPage - delta;
                            let right = currentPage + delta;
                            for (let i = 1; i <= totalPages; i++) {
                                if (i === 1 || i === totalPages || (i >= left && i <= right)) {
                                    range.push(i);
                                } else if (range[range.length - 1] !== '...') {
                                    range.push('...');
                                }
                            }
                            return range;
                        }

                        const pageRange = getPaginationRange(totalPages, currentPage);
                        const ul = document.createElement('ul');
                        ul.className = 'flex items-center -space-x-px h-8 text-sm';

                        // Tombol "Previous"
                        if (currentPage > 1) {
                            ul.innerHTML += `
                        <li>
                            <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage - 1})"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                                </svg>
                            </a>
                        </li>
                    `;
                        }

                        // Tombol halaman berdasarkan pageRange
                        pageRange.forEach(item => {
                            if (item === '...') {
                                ul.innerHTML += `
                            <li>
                                <span class="flex items-center justify-center px-3 h-8 text-gray-500">...</span>
                            </li>
                        `;
                            } else if (item === currentPage) {
                                ul.innerHTML += `
                            <li>
                                <a href="javascript:void(0)" aria-current="page"
                                   class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50">
                                    ${item}
                                </a>
                            </li>
                        `;
                            } else {
                                ul.innerHTML += `
                            <li>
                                <a href="javascript:void(0)" onclick="filter(${status}, ${item})"
                                   class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                    ${item}
                                </a>
                            </li>
                        `;
                            }
                        });

                        // Tombol "Next"
                        if (currentPage < totalPages) {
                            ul.innerHTML += `
                        <li>
                            <a href="javascript:void(0)" onclick="filter(${status}, ${currentPage + 1})"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-2.5 h-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg>
                            </a>
                        </li>
                    `;
                        }

                        navElement.appendChild(ul);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error Status:', status);
                    console.error('Error Details:', error);
                    console.error('Response Text:', xhr.responseText);
                }
            });
        }


        function deleteFile(fileId) {
            if (confirm('Are you sure you want to delete this file?')) {
                $.ajax({
                    url: '<?= BASEURL ?>/researchoutput/delete',
                    type: 'POST',
                    data: {
                        id: fileId
                    },
                    success: function(response) {
                        alert('File deleted successfully!');
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            }
        }

        function previewFile(fileUrl) {
            const modal = $('#previewModal');
            const previewContent = $('#previewContent');
            const fileExtension = fileUrl.split('.').pop().toLowerCase();

            if (fileExtension === 'pdf') {
                window.open('<?= FILES; ?>/' + fileUrl, '_blank');
            } else {
                previewContent.html(`
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">Preview not available for this file type</p>
                </div>`);
            }

            modal.removeClass('hidden').addClass('flex');
        }

        function closePreview() {
            const modal = $('#previewModal');
            modal.addClass('hidden').removeClass('flex');
        }

        $(document).ready(function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            $(entry.target).addClass('visible');
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            const topicButtons = $('.topic-button');
            topicButtons.on('click', function() {
                topicButtons.removeClass('active');
                $(this).addClass('active');
            });

            const fileCards = $('.file-card');
            fileCards.each(function() {
                observer.observe(this);

                $(this).on('click', function() {
                    $(this).toggleClass('zoomed');
                });
            });
        });
    </script>
</body>

</html>