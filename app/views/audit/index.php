<?php
$title = "Audit Log";
require_once __DIR__ . '/../layout/header.php';

// Helper function for time ago
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime();
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff_w = floor($diff->d / 7);
    $diff_d = $diff->d - ($diff_w * 7);

    $parts = array(
        'y' => array('val' => $diff->y, 'label' => 'tahun'),
        'm' => array('val' => $diff->m, 'label' => 'bulan'),
        'w' => array('val' => $diff_w, 'label' => 'minggu'),
        'd' => array('val' => $diff_d, 'label' => 'hari'),
        'h' => array('val' => $diff->h, 'label' => 'jam'),
        'i' => array('val' => $diff->i, 'label' => 'menit'),
        's' => array('val' => $diff->s, 'label' => 'detik'),
    );

    $string = array();
    foreach ($parts as $k => $v) {
        if ($v['val']) {
            $string[] = $v['val'] . ' ' . $v['label'];
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
}
?>

<div class="bg-white rounded-lg shadow-sm border border-slate-200">
    <div class="p-6 border-b border-slate-200 flex justify-between items-center">
        <h2 class="text-xl font-bold text-slate-800">Audit Log</h2>
        <a href="<?= BASE_URL ?>audit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
              <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
            </svg>
            Muat Ulang
        </a>
    </div>

    <div class="p-6">
        <div class="space-y-4">
            <?php if (empty($logs)): ?>
                <div class="text-slate-500 text-center py-8">Belum ada log aktivitas.</div>
            <?php else: ?>
                <?php foreach ($logs as $log): ?>
                <div class="flex flex-col md:flex-row md:items-center justify-between p-5 bg-slate-50 border border-slate-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-start gap-4">
                        <div class="mt-1 flex-shrink-0">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.25 1.146l-.91-.41a7.015 7.015 0 0 0 .086-.35zM1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM7.5 3a.5.5 0 0 0-1 0v5.207l3.5 3.5a.5.5 0 0 0 .708-.708L7.5 7.707V3z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <div class="text-base">
                                <span class="font-bold text-blue-600"><?= htmlspecialchars($log['action_type']) ?></span> 
                                <span class="text-slate-500">oleh</span> <span class="font-semibold text-slate-800"><?= htmlspecialchars($log['user_name']) ?></span>
                            </div>
                            <div class="text-sm text-slate-600 mt-1">
                                <?= htmlspecialchars($log['description']) ?>
                            </div>
                            <div class="text-xs text-slate-400 mt-2.5 flex items-center gap-3">
                                <span class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                      <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                      <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                    Tx Date: <?= date('d/m/Y', strtotime($log['transaction_date'])) ?>
                                </span>
                                <span>&bull;</span>
                                <span class="flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                                      <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                                      <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    </svg>
                                    IP: <?= htmlspecialchars($log['ip_address']) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex flex-col md:items-end text-left md:text-right border-t md:border-t-0 border-slate-200 pt-3 md:pt-0">
                        <span class="inline-block px-3 py-1.5 bg-slate-200 text-slate-700 text-xs font-semibold rounded-full mb-1 w-max md:w-auto">
                            <?= time_elapsed_string($log['created_at']) ?>
                        </span>
                        <div class="text-xs text-slate-500 font-medium">
                            <?= date('d M Y, H:i', strtotime($log['created_at'])) ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <?php if ($totalPages > 1): ?>
        <div class="mt-6 flex justify-center">
            <div class="flex gap-1">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?p=<?= $i ?>" class="px-3 py-1 rounded <?= $i === $page ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
