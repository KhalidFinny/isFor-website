<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Agenda - IsFor Internet of Things For Human Life's</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@500;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/IsFor-website/php/app/views/assets/css/inandout.css">
    <link rel="stylesheet" href="<?= CSS; ?>/main/agenda.css?>">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="http://localhost/IsFor-website/php/app/views/assets/js/animations.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php if (!isset($_SESSION['user_id'])) : ?>
    <?php include_once '../app/views/assets/components/navbar.php'; ?>
<?php else : ?>
    <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
<?php endif; ?>
<section class="min-h-screen py-20 relative overflow-hidden bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        <!-- Header -->
        <div class="mb-20">
            <span class="inline-block px-4 py-2 bg-red-50 text-red-600 rounded-full text-sm font-medium mb-4">
                Agenda Riset
            </span>
            <h2 class="text-5xl font-bold mb-6 text-red-900">
                Fokus Penelitian
            </h2>
            <div class="w-24 h-1 bg-gradient-to-r from-red-600 to-red-800 rounded-full"></div>
        </div>

        <!-- Agenda Items -->
        <div class="space-y-8">
            <?php
            if (empty($data['agenda'])) {
                echo '<div class="text-center text-gray-600 py-8">Belum ada agenda saat ini.</div>';
            } else {
                foreach ($data['agenda'] as $topic):
                    ?>
                    <div class="agenda-item group">
                        <div class="flex items-start space-x-8 p-8 border-2 border-gray-100 hover:border-red-200 transition-all duration-300">
                            <div class="number-label text-6xl font-bold leading-none">
                                <?php echo $data['no']++; ?>
                            </div>
                            <div class="flex-1 pt-2">
                                <h3 class="text-2xl font-bold text-red-900 mb-3 group-hover:text-red-600 transition-colors duration-300">
                                    <?php echo $topic['title']; ?>
                                </h3>
                                <p class="text-gray-600 leading-relaxed">
                                    <?php echo $topic['description']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
    </div>

    <script>
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

            $('.agenda-item').each(function () {
                observer.observe(this);
            });
        });
    </script>
</section>
</html>