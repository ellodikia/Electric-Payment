<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="fixed top-0 left-0 right-0 z-[100] transition-all duration-500" id="main-nav">
    <div class="bg-zinc-950/80 backdrop-blur-xl border-b border-white/5 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center transition-all duration-500" id="nav-content">
                
                <div class="flex items-center gap-3 group cursor-pointer shrink-0">
                    <div class="relative">
                        <div class="p-2 md:p-2.5 bg-yellow-400 rounded-xl transform group-hover:rotate-12 transition-transform duration-300">
                            <i class="fa-solid fa-bolt text-zinc-950 text-lg md:text-xl"></i>
                        </div>
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="font-black text-lg md:text-xl tracking-tighter text-white uppercase italic">
                            ELECTRO<span class="text-yellow-400">PAY</span>
                        </span>
                        <span class="text-[8px] md:text-[9px] text-zinc-500 font-bold tracking-[0.3em] uppercase">Power Management</span>
                    </div>
                </div>

                <div class="hidden lg:flex bg-zinc-900/50 border border-white/5 rounded-2xl px-1.5 py-1.5 items-center gap-1">
                    <?php
                    $menus = [
                        'index2.php' => ['Dashboard', 'fa-house', ['index2']],
                        'data_pelanggan.php' => ['Pelanggan', 'fa-user-astronaut', ['pelanggan']],
                        'data_pembayaran.php' => ['Transaksi', 'fa-wallet', ['pembayaran']],
                        'data_tarif.php' => ['Tarif', 'fa-bolt', ['tarif']],
                        'data_penggunaan.php' => ['Meter', 'fa-gauge-simple-high', ['penggunaan']],
                        'data_tagihan.php' => ['Tagihan', 'fa-receipt', ['tagihan']],
                    ];

                    foreach ($menus as $file => $menuData):
                        $isActive = false;
                        foreach ($menuData[2] as $keyword) {
                            if (strpos($current_page, $keyword) !== false) { $isActive = true; break; }
                        }
                    ?>
                        <a href="<?= $file ?>" 
                           class="flex items-center gap-2 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 
                           <?= $isActive ? 'bg-yellow-400 text-zinc-950 shadow-lg shadow-yellow-400/20' : 'text-zinc-400 hover:text-white hover:bg-white/5' ?>">
                            <i class="fa-solid <?= $menuData[1] ?>"></i>
                            <span><?= $menuData[0] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="flex items-center gap-2 md:gap-4">
                    <div class="hidden sm:flex flex-col items-end border-r border-white/10 pr-4">
                        <span class="text-[10px] font-black text-yellow-400 tracking-widest uppercase italic leading-none">Administrator</span>
                        <span class="text-sm text-zinc-300 font-medium mt-1 leading-none">
                            <?php echo isset($_SESSION['user']) ? $_SESSION['user'] : 'Admin'; ?>
                        </span>
                    </div>

                    <a href="logout.php" title="Keluar Sistem" class="hidden sm:flex w-10 h-10 rounded-xl bg-zinc-900 border border-white/5 items-center justify-center text-zinc-400 hover:text-red-500 hover:border-red-500/50 transition-all group">
                        <i class="fa-solid fa-right-from-bracket group-hover:translate-x-0.5 transition-transform"></i>
                    </a>

                    <button id="menu-toggle" class="lg:hidden p-3 rounded-xl bg-zinc-900 border border-white/5 text-white z-[120] relative active:scale-95 transition-all">
                        <div class="flex flex-col gap-1.5 items-end">
                            <span id="l1" class="w-6 h-0.5 bg-white transition-all duration-300"></span>
                            <span id="l2" class="w-4 h-0.5 bg-yellow-400 transition-all duration-300"></span>
                            <span id="l3" class="w-6 h-0.5 bg-white transition-all duration-300"></span>
                        </div>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div id="side-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm opacity-0 invisible transition-all duration-500 z-[110]"></div>

    <div id="side-drawer" class="fixed top-0 right-0 h-full w-[280px] bg-zinc-950 border-l border-white/10 z-[115] translate-x-full transition-transform duration-500 ease-in-out p-8 flex flex-col">
        <div class="mb-10">
            <span class="text-yellow-400 text-[10px] font-black uppercase tracking-[0.3em]">Menu Navigasi</span>
            <div class="h-px w-10 bg-yellow-400 mt-2"></div>
        </div>

        <ul class="space-y-6 flex-1">
            <?php foreach ($menus as $file => $menuData): 
                $isActive = false;
                foreach ($menuData[2] as $keyword) {
                    if (strpos($current_page, $keyword) !== false) { $isActive = true; break; }
                }
            ?>
                <li>
                    <a href="<?= $file ?>" class="flex items-center gap-4 group">
                        <div class="w-10 h-10 rounded-lg bg-zinc-900 border border-white/5 flex items-center justify-center transition-all group-hover:border-yellow-400/50 <?= $isActive ? 'text-yellow-400 border-yellow-400/50 bg-yellow-400/10' : 'text-zinc-500' ?>">
                            <i class="fa-solid <?= $menuData[1] ?>"></i>
                        </div>
                        <span class="text-lg font-bold uppercase tracking-tighter transition-all <?= $isActive ? 'text-white' : 'text-zinc-400 group-hover:text-white' ?>">
                            <?= $menuData[0] ?>
                        </span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="pt-8 border-t border-white/5">
            <a href="logout.php" class="flex items-center gap-4 text-red-500 group">
                <div class="w-10 h-10 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:bg-red-500/20 transition-all">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <span class="font-black uppercase tracking-widest text-xs">Keluar Sistem</span>
            </a>
        </div>
    </div>
</nav>

<div class="h-20 lg:h-24"></div>

<script>
    const menuToggle = document.getElementById('menu-toggle');
    const sideDrawer = document.getElementById('side-drawer');
    const sideOverlay = document.getElementById('side-overlay');
    const l1 = document.getElementById('l1');
    const l2 = document.getElementById('l2');
    const l3 = document.getElementById('l3');
    const navContent = document.getElementById('nav-content');

    function toggleMenu() {
        const isOpen = sideDrawer.classList.contains('translate-x-0');
        
        if (!isOpen) {
            sideDrawer.classList.replace('translate-x-full', 'translate-x-0');
            sideOverlay.classList.replace('invisible', 'visible');
            sideOverlay.classList.replace('opacity-0', 'opacity-100');
            l1.classList.add('rotate-45', 'translate-y-2', 'origin-center');
            l2.classList.add('opacity-0', '-translate-x-4');
            l3.classList.add('-rotate-45', '-translate-y-2', 'origin-center');
            document.body.style.overflow = 'hidden';
        } else {
            sideDrawer.classList.replace('translate-x-0', 'translate-x-full');
            sideOverlay.classList.replace('opacity-100', 'opacity-0');
            setTimeout(() => sideOverlay.classList.replace('visible', 'invisible'), 500);
            l1.classList.remove('rotate-45', 'translate-y-2', 'origin-center');
            l2.classList.remove('opacity-0', '-translate-x-4');
            l3.classList.remove('-rotate-45', '-translate-y-2', 'origin-center');
            document.body.style.overflow = '';
        }
    }

    menuToggle.addEventListener('click', toggleMenu);
    sideOverlay.addEventListener('click', toggleMenu);

    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navContent.classList.replace('h-20', 'h-16');
        } else {
            navContent.classList.replace('h-16', 'h-20');
        }
    });
</script>