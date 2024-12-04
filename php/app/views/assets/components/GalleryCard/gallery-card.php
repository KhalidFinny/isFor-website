<?php foreach ($data['images'] as $image) : ?>
    <!-- Kartu gambar -->
    <div class="bg-white p-4 rounded-xl shadow-md image-card">
        <img src="<?= GALLERY; ?>/files/<?= htmlspecialchars($image['image']); ?>"
             alt="Gambar <?= htmlspecialchars($image['title']); ?>"
             class="w-full h-32 object-cover rounded-t-md">
        <h3 class="text-lg font-bold text-blue-900 mt-2"><?= htmlspecialchars($image['title']); ?></h3>
        <p class="text-sm text-blue-600"><?= htmlspecialchars($image['category']); ?></p>
        <p class="text-xs text-blue-500 mt-2">Diunggah
            pada <?= date('d M Y', strtotime($image['created_at'])); ?></p>
        <span class="status-badge text-xs font-semibold px-2 py-1 rounded-lg mt-2 inline-block
            <?php
        if ($image['status'] == 1) echo 'bg-yellow-100 text-yellow-600';
        elseif ($image['status'] == 2) echo 'bg-green-100 text-green-600';
        else echo 'bg-red-100 text-red-600';
        ?>">
            <?php
            if ($image['status'] == 1) echo 'Pending';
            elseif ($image['status'] == 2) echo 'Approved';
            else echo 'Rejected';
            ?>
        </span>
    </div>
<?php endforeach; ?>

