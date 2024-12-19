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
    <style>
        .file-card {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .file-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .file-icon {
            width: 64px;
            height: 64px;
            transition: all 0.3s ease;
        }

        .action-button {
            transform: translateY(10px);
            opacity: 0;
            transition: all 0.2s ease;
        }

        .file-card:hover .action-button {
            transform: translateY(0);
            opacity: 1;
        }

        .topic-button {
            position: relative;
            transition: all 0.3s ease;
        }

        .topic-button::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 2px;
            background: #eb2563;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .topic-button:hover::after,
        .topic-button.active::after {
            width: 100%;
        }

        .topic-button.active {
            color: #eb2563;
        }
    </style>
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
                                              d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
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
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>

                                <!-- Download Button -->
                                <a href="<?= FILES . '/' . $item['file_url']; ?>"
                                   class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                   download>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
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
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="flex items-center -space-x-px h-8 text-sm">
                <li>
                    <?php if ($data['currentPage'] > 1) : ?>
                        <a href="?halaman=<?= $data['currentPage'] - 1 ?>"
                           class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </li>
                <?php for ($i = 1; $i <= $data['totalPages']; $i++) : ?>
                    <?php if ($i == $data['currentPage']) : ?>
                        <li>
                            <a href="?page=<?= $i; ?>" aria-current="page"
                               class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-red-600 border border-red-300 bg-red-50 hover:bg-red-100 hover:text-red-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white"><?= $i; ?></a>
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="?page=<?= $i; ?>"
                               class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"><?= $i; ?></a>
                        </li>
                    <?php endif; ?>
                <?php endfor; ?>
                <li>
                    <?php if ($data['currentPage'] < $data['totalPages']) : ?>
                        <a href="?page=<?= $data['currentPage'] + 1 ?>"
                           class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </div>
</section>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-4xl w-full mx-4 p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold">File Preview</h3>
            <button onclick="closePreview()" class="text-gray-500 hover:text-red-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div id="previewContent" class="w-full h-[600px]">
            <!-- Preview content will be loaded here -->
        </div>
    </div>
</div>

<script>

    function previewFile(fileUrl) {
        const modal = $('#previewModal');
        const previewContent = $('#previewContent');
        const fileExtension = fileUrl.split('.').pop().toLowerCase();

        if (fileExtension === 'pdf') {
            window.open('<?=FILES;?>/' + fileUrl, '_blank');
        } else {
            previewContent.html(`
                <div class="flex items-center justify-center h-full">
                    <p class="text-gray-500">Preview not available for this file type</p>
                </div>`
            );
        }

        modal.removeClass('hidden').addClass('flex');
    }

    function closePreview() {
        const modal = $('#previewModal');
        modal.addClass('hidden').removeClass('flex');
    }

    function deleteFile(fileId) {
        if (confirm('Are you sure you want to delete this file?')) {
            $.ajax({
                url: '<?= BASEURL ?>/researchoutput/delete',
                type: 'POST',
                data: {id: fileId},
                success: function (response) {
                    alert('File deleted successfully!');
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    alert('An error occurred: ' + error);
                }
            });
        }
    }

    function filter(status) {
        $.ajax({
            url: '<?= BASEURL ?>/home/filterHasilPenelitian',
            method: 'POST',
            dataType: 'json',
            data: {status: status},
            success: function (data) {
                console.log('Success Response:', data);

                const fileContainer = $('.files-container');
                const navElement = $('nav[aria-label="Page navigation example"]');

                fileContainer.empty();
                navElement.empty();

                data.forEach(file => {
                    const fileHTML = `
                        <div class="file-card bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 visible">
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
                            </div>
                        </div>
                    </div>
                `;

                    fileContainer.append(fileHTML);
                });

            },
            error: function (xhr, status, error) {
                console.error('Error Status:', status);
                console.error('Error Details:', error);
                console.error('Response Text:', xhr.responseText);
            }
        });
    }

    $(document).ready(function () {
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
        topicButtons.on('click', function () {
            topicButtons.removeClass('active');
            $(this).addClass('active');
        });

        const fileCards = $('.file-card');
        fileCards.each(function () {
            observer.observe(this);

            $(this).on('click', function () {
                $(this).toggleClass('zoomed');
            });
        });
    });
</script>
</body>
</html>