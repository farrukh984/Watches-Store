<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Authentication') - {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/auth-premium.css') }}?v={{ time() }}">
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    
    <!-- Theme JS -->
    <script src="{{ asset('js/theme.js') }}"></script>
    
    @yield('styles')
</head>
<body class="auth-body">

    <!-- ═══ PREMIUM LOADER ═══ -->
    <div id="auth-loader">
        <div class="loader-orb loader-orb-1"></div>
        <div class="loader-orb loader-orb-2"></div>
        <div class="loader-content">
            <div class="loader-icon">
                <div class="loader-icon-ring"></div>
                <div class="loader-icon-ring"></div>
                <div class="loader-icon-gem">
                    <i class="fa-solid fa-gem"></i>
                </div>
            </div>
            <div class="loader-brand">{{ config('app.name') }}</div>
            <div class="loader-progress">
                <div class="loader-progress-bar"></div>
            </div>
            <div class="loader-status">Loading Experience</div>
        </div>
    </div>

    <!-- ═══ ANIMATED MESH BACKGROUND ═══ -->
    <div class="auth-bg">
        <div class="auth-bg-overlay"></div>
        <div class="auth-particles" id="particles-container"></div>
    </div>

    <!-- ═══ PREMIUM TOAST NOTIFICATIONS ═══ -->
    <div class="toast-container" id="toast-container"></div>

    <!-- ═══ THEME TOGGLE ═══ -->
    <div class="auth-theme-toggle">
        <button class="theme-btn theme-toggle" title="Toggle Theme">
            <i class="fa-solid fa-moon theme-toggle-icon"></i>
        </button>
    </div>

    <!-- ═══ MAIN — Split Screen ═══ -->
    <main class="auth-main">
        <div class="auth-wrapper {{ request()->routeIs('register') ? 'auth-reversed' : '' }}" id="auth-wrapper">
            <!-- LEFT: Form Panel -->
            <div class="auth-panel-left">
                @yield('content')
            </div>

            <!-- RIGHT: Showcase Slider Panel -->
            <div class="auth-panel-right" id="showcase-panel">
                <!-- Slides Container -->
                <div class="showcase-slider" id="showcase-slider">
                    @php
                        $slides = [
                            ['img' => 'watch-slide-1.png', 'alt' => 'Luxury Chronograph'],
                            ['img' => 'watch-slide-2.png', 'alt' => 'Watch Collection'],
                            ['img' => 'watch-slide-3.png', 'alt' => 'Dress Watch'],
                            ['img' => 'watch-slide-4.png', 'alt' => 'Dive Watch'],
                        ];
                    @endphp
                    @foreach($slides as $index => $slide)
                        <div class="showcase-slide {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}">
                            <img src="{{ asset('images/auth/' . $slide['img']) }}" alt="{{ $slide['alt'] }}" loading="{{ $index === 0 ? 'eager' : 'lazy' }}">
                        </div>
                    @endforeach
                </div>

                <!-- Gradient overlays -->
                <div class="auth-showcase-overlay"></div>

                <!-- Slider progress bar -->
                <div class="showcase-slider-progress">
                    <div class="showcase-slider-progress-bar" id="slider-progress-bar"></div>
                </div>

                <!-- Slider dots -->
                <div class="showcase-slider-dots" id="slider-dots">
                    @foreach($slides as $index => $slide)
                        <button class="slider-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}" aria-label="Go to slide {{ $index + 1 }}">
                            <span class="dot-fill"></span>
                        </button>
                    @endforeach
                </div>

                <!-- Text Content -->
                <div class="auth-showcase-content" id="showcase-content">
                    <div class="auth-showcase-badge gs-reveal-right">
                        <i class="fa-solid fa-gem"></i>
                        @hasSection('showcase-badge')
                            @yield('showcase-badge')
                        @else
                            PREMIUM COLLECTION
                        @endif
                    </div>
                    <h2 class="auth-showcase-title gs-reveal-right">
                        @hasSection('showcase-title')
                            @yield('showcase-title')
                        @else
                            Discover <span>Timeless</span> Elegance
                        @endif
                    </h2>
                    <p class="auth-showcase-desc gs-reveal-right">
                        @hasSection('showcase-desc')
                            @yield('showcase-desc')
                        @else
                            Explore our curated collection of luxury timepieces from world-renowned brands.
                        @endif
                    </p>
                    <div class="auth-showcase-stats gs-reveal-right">
                        @hasSection('showcase-stats')
                            @yield('showcase-stats')
                        @else
                            <div class="showcase-stat">
                                <div class="showcase-stat-value">500<span>+</span></div>
                                <div class="showcase-stat-label">Watches</div>
                            </div>
                            <div class="showcase-stat">
                                <div class="showcase-stat-value">50<span>+</span></div>
                                <div class="showcase-stat-label">Brands</div>
                            </div>
                            <div class="showcase-stat">
                                <div class="showcase-stat-value">24<span>/7</span></div>
                                <div class="showcase-stat-label">Support</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ═══ GLOBAL SCRIPTS ═══ -->
    <script>
        // ═══ PREMIUM TOAST NOTIFICATION SYSTEM ═══
        const PremiumToast = {
            container: null,
            init() {
                this.container = document.getElementById('toast-container');
            },
            show({ type = 'info', title = '', message = '', duration = 5000 }) {
                if (!this.container) this.init();

                const toast = document.createElement('div');
                toast.className = `premium-toast toast-${type}`;

                const icons = {
                    success: 'fa-circle-check',
                    error:   'fa-circle-xmark',
                    warning: 'fa-triangle-exclamation',
                    info:    'fa-circle-info'
                };

                const iconLabels = {
                    success: 'Success',
                    error:   'Error',
                    warning: 'Warning',
                    info:    'Info'
                };

                toast.innerHTML = `
                    <div class="toast-accent"></div>
                    <div class="toast-icon-wrap">
                        <div class="toast-icon-bg">
                            <i class="fa-solid ${icons[type] || icons.info}"></i>
                        </div>
                        <div class="toast-icon-pulse"></div>
                    </div>
                    <div class="toast-body">
                        <div class="toast-header">
                            <span class="toast-type-label">${iconLabels[type] || 'Info'}</span>
                            ${title ? `<span class="toast-title">${title}</span>` : ''}
                        </div>
                        <p class="toast-message">${message}</p>
                    </div>
                    <button class="toast-close" onclick="PremiumToast.dismiss(this.closest('.premium-toast'))">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                    <div class="toast-timer">
                        <div class="toast-timer-bar" style="animation-duration: ${duration}ms"></div>
                    </div>
                `;

                this.container.appendChild(toast);

                // Entrance animation
                requestAnimationFrame(() => {
                    toast.classList.add('toast-entering');
                    setTimeout(() => toast.classList.add('toast-visible'), 20);
                });

                // Auto-dismiss
                const timer = setTimeout(() => this.dismiss(toast), duration);
                toast._timer = timer;

                // Pause timer on hover
                toast.addEventListener('mouseenter', () => {
                    clearTimeout(toast._timer);
                    const bar = toast.querySelector('.toast-timer-bar');
                    if (bar) bar.style.animationPlayState = 'paused';
                });
                toast.addEventListener('mouseleave', () => {
                    const bar = toast.querySelector('.toast-timer-bar');
                    if (bar) bar.style.animationPlayState = 'running';
                    toast._timer = setTimeout(() => this.dismiss(toast), 2000);
                });

                return toast;
            },
            dismiss(toast) {
                if (!toast || toast._dismissed) return;
                toast._dismissed = true;
                clearTimeout(toast._timer);
                toast.classList.add('toast-exiting');
                toast.classList.remove('toast-visible');
                setTimeout(() => {
                    if (toast.parentNode) toast.parentNode.removeChild(toast);
                }, 500);
            },
            success(message, title = '') { return this.show({ type: 'success', title, message }); },
            error(message, title = '')   { return this.show({ type: 'error', title, message }); },
            warning(message, title = '') { return this.show({ type: 'warning', title, message }); },
            info(message, title = '')    { return this.show({ type: 'info', title, message }); },
        };

        // ═══ PREMIUM LOADER ═══
        function showAuthLoader(text = 'Processing', statusText = 'Please Wait') {
            let loader = document.getElementById('auth-loader');
            if (!loader) {
                loader = document.createElement('div');
                loader.id = 'auth-loader';
                loader.innerHTML = `
                    <div class="loader-orb loader-orb-1"></div>
                    <div class="loader-orb loader-orb-2"></div>
                    <div class="loader-content">
                        <div class="loader-icon">
                            <div class="loader-icon-ring"></div>
                            <div class="loader-icon-ring"></div>
                            <div class="loader-icon-gem"><i class="fa-solid fa-gem"></i></div>
                        </div>
                        <div class="loader-brand">${text}</div>
                        <div class="loader-progress"><div class="loader-progress-bar"></div></div>
                        <div class="loader-status">${statusText}</div>
                    </div>`;
                document.body.appendChild(loader);
            } else {
                const brand = loader.querySelector('.loader-brand');
                const status = loader.querySelector('.loader-status');
                if (brand) brand.textContent = text;
                if (status) status.textContent = statusText;
                loader.classList.remove('hide');
            }
        }

        window.addEventListener('load', function() {
            const loader = document.getElementById('auth-loader');
            if (loader) {
                loader.classList.add('hide');
                setTimeout(() => {
                    loader.remove();
                    initPageAnimations();
                }, 600);
            }
        });

        // Show loader on form submit
        document.addEventListener('submit', function(e) {
            if (e.defaultPrevented) return;
            showAuthLoader('Processing', 'Please Wait');
        });

        // ═══ FLOATING PARTICLES ═══
        (function() {
            const container = document.getElementById('particles-container');
            if (!container) return;
            const count = window.innerWidth < 576 ? 8 : 18;
            const colors = [
                'rgba(6, 182, 212, 0.3)',
                'rgba(14, 165, 233, 0.25)',
                'rgba(20, 184, 166, 0.2)',
                'rgba(99, 102, 241, 0.15)'
            ];
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.classList.add('particle');
                const size = Math.random() * 8 + 4;
                const color = colors[Math.floor(Math.random() * colors.length)];
                p.style.width = size + 'px';
                p.style.height = size + 'px';
                p.style.left = Math.random() * 100 + '%';
                p.style.bottom = -(Math.random() * 20) + '%';
                p.style.animationDuration = (Math.random() * 10 + 8) + 's';
                p.style.animationDelay = (Math.random() * 8) + 's';
                p.style.opacity = Math.random() * 0.4 + 0.15;
                p.style.background = 'radial-gradient(circle, ' + color + ' 0%, transparent 70%)';
                container.appendChild(p);
            }
        })();

        // ═══ SHOWCASE IMAGE SLIDER ═══
        (function() {
            const slides = document.querySelectorAll('.showcase-slide');
            const dots = document.querySelectorAll('.slider-dot');
            const progressBar = document.getElementById('slider-progress-bar');
            if (slides.length <= 1) return;

            let currentIndex = 0;
            const totalSlides = slides.length;
            const interval = 5000; // 5 seconds per slide
            let timer = null;
            let isTransitioning = false;

            function goToSlide(idx, direction = 'next') {
                if (isTransitioning || idx === currentIndex) return;
                isTransitioning = true;

                const oldSlide = slides[currentIndex];
                const newSlide = slides[idx];

                // Update dots
                dots.forEach(d => d.classList.remove('active'));
                dots[idx].classList.add('active');

                // Reset progress bar
                if (progressBar) {
                    progressBar.style.transition = 'none';
                    progressBar.style.width = '0%';
                }

                // Determine direction
                const isNext = direction === 'next' || idx > currentIndex;

                // Animation: crossfade + subtle Ken Burns
                newSlide.classList.add('active');
                const img = newSlide.querySelector('img');
                const oldImg = oldSlide.querySelector('img');

                // Set initial states
                gsap.set(newSlide, { opacity: 0, zIndex: 2 });
                gsap.set(oldSlide, { zIndex: 1 });

                // Scale effect for Ken Burns
                if (img) {
                    gsap.fromTo(img, 
                        { scale: 1.15, x: isNext ? 30 : -30 },
                        { scale: 1.05, x: 0, duration: 1.4, ease: "power2.out" }
                    );
                }

                // Crossfade
                gsap.to(newSlide, {
                    opacity: 1,
                    duration: 1,
                    ease: "power2.inOut",
                    onComplete: () => {
                        oldSlide.classList.remove('active');
                        gsap.set(oldSlide, { opacity: 0, zIndex: 0 });
                        gsap.set(newSlide, { zIndex: 1 });
                        currentIndex = idx;
                        isTransitioning = false;

                        // Restart progress
                        startProgress();
                    }
                });

                // Fade out old
                if (oldImg) {
                    gsap.to(oldImg, { scale: 1.1, duration: 1, ease: "power2.in" });
                }
            }

            function nextSlide() {
                const next = (currentIndex + 1) % totalSlides;
                goToSlide(next, 'next');
            }

            function startProgress() {
                if (progressBar) {
                    requestAnimationFrame(() => {
                        progressBar.style.transition = `width ${interval}ms linear`;
                        progressBar.style.width = '100%';
                    });
                }
            }

            function startAutoplay() {
                stopAutoplay();
                startProgress();
                timer = setInterval(nextSlide, interval);
            }

            function stopAutoplay() {
                if (timer) clearInterval(timer);
                timer = null;
            }

            // Dot clicks
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    stopAutoplay();
                    goToSlide(i, i > currentIndex ? 'next' : 'prev');
                    // Restart after a pause
                    setTimeout(startAutoplay, interval);
                });
            });

            // Pause on hover
            const panel = document.getElementById('showcase-panel');
            if (panel) {
                panel.addEventListener('mouseenter', stopAutoplay);
                panel.addEventListener('mouseleave', startAutoplay);
            }

            // Initial Ken Burns on first slide
            const firstImg = slides[0] && slides[0].querySelector('img');
            if (firstImg) {
                gsap.fromTo(firstImg, { scale: 1.1 }, { scale: 1.02, duration: 12, ease: "none", repeat: -1, yoyo: true });
            }

            // Start
            startAutoplay();
        })();

        // ═══ PAGE ENTRANCE ANIMATIONS (GSAP) ═══
        function initPageAnimations() {
            const authWrapper = document.getElementById('auth-wrapper');
            const isReversed = authWrapper ? authWrapper.classList.contains('auth-reversed') : false;
            const playFlipIn = sessionStorage.getItem('playFlipIn') === 'true';

            // 1. FLIP TRANSITION
            if (authWrapper && playFlipIn) {
                sessionStorage.removeItem('playFlipIn');
                gsap.fromTo(authWrapper,
                    { rotationY: isReversed ? 90 : -90, scale: 0.9, opacity: 0 },
                    { rotationY: 0, scale: 1, opacity: 1, duration: 0.8, ease: "power3.out", clearProps: "all" }
                );
            }

            // Card entrance
            const card = document.querySelector('.auth-card');
            if (card && !playFlipIn) {
                gsap.to(card, {
                    opacity: 1,
                    y: 0,
                    duration: 0.9,
                    ease: "power4.out",
                    delay: 0.1
                });
            } else if (card) {
               gsap.set(card, { opacity: 1, y: 0 });
            }

            // Intercept flip toggles
            document.querySelectorAll('.flip-trigger').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (e.defaultPrevented || window.innerWidth <= 860) return; 
                    e.preventDefault();
                    const targetUrl = this.href;
                    sessionStorage.setItem('playFlipIn', 'true');
                    
                    gsap.to(authWrapper, {
                        rotationY: isReversed ? 90 : -90,
                        scale: 0.9,
                        opacity: 0,
                        duration: 0.5,
                        ease: "power2.in",
                        onComplete: () => { 
                            showAuthLoader(
                                targetUrl.includes('register') ? 'Registration' : 'Authentication', 
                                'Preparing Experience...'
                            );
                            window.location.href = targetUrl; 
                        }
                    });
                });
            });

            // Form elements — staggered reveal
            gsap.fromTo(".auth-card .gs-reveal",
                { opacity: 0, y: 25 },
                { 
                    opacity: 1, y: 0, 
                    stagger: 0.07, 
                    duration: 0.7, 
                    ease: "power3.out", 
                    delay: 0.3,
                    clearProps: "all"
                }
            );

            // Brand icon — scale + rotate entrance
            gsap.fromTo(".auth-brand-icon",
                { opacity: 0, scale: 0.3, rotation: -15 },
                { 
                    opacity: 1, scale: 1, rotation: 0, 
                    duration: 0.8, 
                    ease: "back.out(1.7)", 
                    delay: 0.2,
                    clearProps: "all"
                }
            );

            // Brand name — typed reveal
            gsap.fromTo(".auth-brand-name",
                { opacity: 0, x: -20 },
                { 
                    opacity: 1, x: 0, 
                    duration: 0.6, 
                    ease: "power2.out", 
                    delay: 0.4,
                    clearProps: "all"
                }
            );

            // Showcase panel animations
            const showcasePanel = document.getElementById('showcase-panel');
            if (showcasePanel) {
                // Showcase content — slide from right
                gsap.fromTo(".auth-showcase-content .gs-reveal-right",
                    { opacity: 0, x: 50 },
                    { 
                        opacity: 1, x: 0, 
                        stagger: 0.12, 
                        duration: 0.8, 
                        ease: "power3.out", 
                        delay: 0.6,
                        clearProps: "all"
                    }
                );

                // Stats counter animation
                document.querySelectorAll('.showcase-stat-value').forEach(el => {
                    const text = el.textContent;
                    const num = parseInt(text);
                    if (!isNaN(num)) {
                        const suffix = text.replace(num.toString(), '');
                        gsap.from({ val: 0 }, {
                            val: num,
                            duration: 2,
                            ease: "power2.out",
                            delay: 1.2,
                            onUpdate: function() {
                                el.innerHTML = Math.round(this.targets()[0].val) + '<span>' + suffix + '</span>';
                            }
                        });
                    }
                });
            }

            // Input focus micro-animations
            document.querySelectorAll('.input-wrapper input').forEach(inp => {
                inp.addEventListener('focus', () => {
                    gsap.to(inp.closest('.input-wrapper'), { 
                        scale: 1.02, 
                        duration: 0.3, 
                        ease: "power2.out" 
                    });
                    gsap.to(inp.closest('.input-wrapper .icon'), { 
                        scale: 1.2, 
                        duration: 0.3, 
                        ease: "back.out(1.7)" 
                    });
                });
                inp.addEventListener('blur', () => {
                    gsap.to(inp.closest('.input-wrapper'), { 
                        scale: 1, 
                        duration: 0.2 
                    });
                    gsap.to(inp.closest('.input-wrapper .icon'), { 
                        scale: 1, 
                        duration: 0.2 
                    });
                });
            });

            // Button hover parallax
            const submitBtn = document.querySelector('.btn-submit');
            if (submitBtn) {
                submitBtn.addEventListener('mouseenter', () => {
                    gsap.to(submitBtn, { 
                        boxShadow: "0 16px 40px -8px rgba(6, 182, 212, 0.4)", 
                        duration: 0.3 
                    });
                });
                submitBtn.addEventListener('mouseleave', () => {
                    gsap.to(submitBtn, { 
                        boxShadow: "0 8px 20px -4px rgba(6, 182, 212, 0.25)", 
                        duration: 0.3 
                    });
                });
            }
        }

        // Fallback
        if (document.readyState === 'complete') {
            const loader = document.getElementById('auth-loader');
            if (loader && !loader.classList.contains('hide')) {
                loader.classList.add('hide');
                setTimeout(() => {
                    loader.remove();
                    initPageAnimations();
                }, 600);
            } else if (!document.getElementById('auth-loader')) {
                initPageAnimations();
            }
        }

        // Safety fallback
        let _animInit = false;
        const _origInit = initPageAnimations;
        initPageAnimations = function() {
            if (_animInit) return;
            _animInit = true;
            _origInit();
        };
        setTimeout(() => {
            if (!_animInit) {
                const loader = document.getElementById('auth-loader');
                if (loader) { loader.classList.add('hide'); setTimeout(() => loader.remove(), 600); }
                initPageAnimations();
            }
        }, 3000);
    </script>

    @yield('scripts')
</body>
</html>
