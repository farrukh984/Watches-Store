@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<link rel="stylesheet" href="{{ asset('css/home-premium.css') }}">
@endsection

@section('content')

{{-- ══════════════════════════════════════════════════════
     1. HERO — Real-world E-commerce Shoppable Banner
     ══════════════════════════════════════════════════════ --}}
<section class="ec-hero">
    <div class="ec-hero-bg"></div>
    
    <div class="swiper ec-hero-swiper">
        <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
                <div class="container swiper-slide-inner">
                    <div class="ec-hero-content">
                        <div class="ec-badge">Available Now</div>
                        <h1 class="ec-hero-title">The Oceanographer<br><span>Collection</span></h1>
                        <p class="ec-hero-desc">Discover our exclusive selection of chronographs engineered for the deep. Featuring luminescent markers and 500m water resistance.</p>
                        
                        <div class="ec-hero-actions">
                            <a href="{{ route('products.index') }}" class="ec-btn-primary">
                                Shop Collection
                            </a>
                            <a href="#new-arrivals" class="ec-btn-secondary">
                                View Lookbook
                            </a>
                        </div>

                        <div class="ec-hero-trust">
                            <span><i class="fa-solid fa-check-circle"></i> Authenticity Guaranteed</span>
                            <span><i class="fa-solid fa-truck-fast"></i> Free Global Shipping</span>
                        </div>
                    </div>

                    <div class="ec-hero-product">
                        <div class="ec-hero-glow"></div>
                        <img src="{{ asset('images/hero_watch_cyan.png') }}" class="ec-hero-img" alt="Luxury Watch">
                        <!-- Shoppable floating tag -->
                        <a href="{{ route('products.index') }}" class="ec-shoppable-tag">
                            <div class="ec-tag-dot"></div>
                            <div class="ec-tag-info">
                                <small>Featured Model</small>
                                <strong>AquaTerra Series 4</strong>
                                <span>Shop Now <i class="fa-solid fa-arrow-right"></i></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
                <div class="container swiper-slide-inner">
                    <div class="ec-hero-content">
                        <div class="ec-badge" style="color:var(--ec-accent); border-color:var(--ec-accent);">Limited Release</div>
                        <h1 class="ec-hero-title">Celestial Aviator<br><span>Chronograph</span></h1>
                        <p class="ec-hero-desc">Engineered for absolute precision in the skies. A masterpiece blending heritage aesthetics with modern aerodynamics.</p>
                        
                        <div class="ec-hero-actions">
                            <a href="{{ route('products.index') }}" class="ec-btn-primary" style="background:linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow:0 4px 15px rgba(16,185,129,0.3);">
                                Shop Now
                            </a>
                        </div>
                    </div>

                    <div class="ec-hero-product">
                        <div class="ec-hero-glow" style="background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, transparent 70%);"></div>
                        <img src="{{ asset('images/hero_watch_cyan.png') }}" style="filter: hue-rotate(150deg) drop-shadow(0 20px 40px rgba(0,0,0,0.6));" class="ec-hero-img" alt="Aviator Watch">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="ec-swiper-pagination"></div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     2. QUICK CATEGORIES — Shoppable Pills
     ══════════════════════════════════════════════════════ --}}
<section class="ec-quick-cats">
    <div class="container">
        <div class="ec-qcats-scroll">
            <a href="{{ route('products.index') }}" class="ec-qcat active">All Timepieces</a>
            @foreach($categories->take(6) as $cat)
                <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="ec-qcat">
                    {{ $cat->name }}
                </a>
            @endforeach
            <a href="{{ route('products.index') }}" class="ec-qcat ec-qcat-sale">Sale & Offers</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     2.5 BRANDS MARQUEE
     ══════════════════════════════════════════════════════ --}}
<section class="ec-brand-marquee">
    <div class="ec-marquee-track">
        <!-- Duplicate elements for infinite scroll illusion -->
        <span class="ec-brand-item">Rolex</span>
        <span class="ec-brand-item">Omega</span>
        <span class="ec-brand-item">Patek Philippe</span>
        <span class="ec-brand-item">Cartier</span>
        <span class="ec-brand-item">Tag Heuer</span>
        <span class="ec-brand-item">Audemars Piguet</span>
        <span class="ec-brand-item">Rolex</span>
        <span class="ec-brand-item">Omega</span>
        <span class="ec-brand-item">Patek Philippe</span>
        <span class="ec-brand-item">Cartier</span>
        <span class="ec-brand-item">Tag Heuer</span>
        <span class="ec-brand-item">Audemars Piguet</span>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     3. FLASH DEALS — E-commerce urgency block
     ══════════════════════════════════════════════════════ --}}
@if($activeDeal)
<section class="ec-flash-sales">
    <div class="container">
        <div class="ec-section-header">
            <div class="ec-sh-left">
                <h2>Limited Time Offers</h2>
                <div class="ec-countdown" id="countdown">
                    <span>Ends in:</span>
                    <strong id="days">00</strong>d
                    <strong id="hours">00</strong>h
                    <strong id="minutes">00</strong>m
                    <strong id="seconds">00</strong>s
                </div>
            </div>
            <a href="{{ route('products.index') }}" class="ec-link-viewall">View All Deals</a>
        </div>

        <div class="ec-deals-grid">
            @foreach($deals->take(4) as $item)
            @if($item->product)
            <div class="ec-product-card">
                <div class="ec-discount-tag">-{{ $item->discount_percent }}%</div>
                <a href="{{ route('products.show', $item->product_id) }}" class="ec-pc-image">
                    <img src="{{ display_image($item->product->image) }}" alt="{{ $item->product->name }}" loading="lazy">
                    <div class="ec-pc-overlay">
                        <span class="ec-pc-quickview">Quick View</span>
                    </div>
                </a>
                <div class="ec-pc-info">
                    <div class="ec-pc-brand">Luxury Collection</div>
                    <a href="{{ route('products.show', $item->product_id) }}" class="ec-pc-title">{{ $item->product->name }}</a>
                    <div class="ec-pc-pricing">
                        @php $dp = $item->product->price * (1 - $item->discount_percent / 100); @endphp
                        <span class="ec-pc-price">${{ number_format($dp, 2) }}</span>
                        <span class="ec-pc-old">${{ number_format($item->product->price, 2) }}</span>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ══════════════════════════════════════════════════════
     4. SHOP BY CATEGORY — Visual E-commerce Grid
     ══════════════════════════════════════════════════════ --}}
<section class="ec-visual-cats">
    <div class="container">
        <div class="ec-section-header">
            <h2>Shop by Department</h2>
        </div>
        <div class="ec-vcat-grid">
            @foreach($categories->take(4) as $cat)
            <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="ec-vcat-card">
                <div class="ec-vcat-bg" 
                     @if($cat->background_image) style="background-image: url('{{ display_image($cat->background_image) }}')" @endif>
                </div>
                <div class="ec-vcat-content">
                    <h3>{{ $cat->name }}</h3>
                    <span>{{ $cat->products->count() }} Products <i class="fa-solid fa-arrow-right"></i></span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     5. NEW ARRIVALS — Standard Store Shelf
     ══════════════════════════════════════════════════════ --}}
<section class="ec-products-shelf" id="new-arrivals">
    <div class="container">
        <div class="ec-section-header">
            <h2>New Arrivals</h2>
            <div class="ec-shelf-nav">
                <button class="ec-nav-btn ec-prev"><i class="fa-solid fa-chevron-left"></i></button>
                <button class="ec-nav-btn ec-next"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="swiper ec-products-swiper">
            <div class="swiper-wrapper">
                @foreach($recommended->take(8) as $product)
                <div class="swiper-slide">
                    <div class="ec-product-card">
                        @if($loop->first) <div class="ec-new-tag">New</div> @endif
                        <button class="ec-wishlist-btn"><i class="fa-regular fa-heart"></i></button>
                        
                        <a href="{{ route('products.show', $product->id) }}" class="ec-pc-image">
                            <img src="{{ display_image($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            <div class="ec-pc-actions">
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="ec-add-to-cart">
                                        <i class="fa-solid fa-cart-shopping"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </a>
                        <div class="ec-pc-info">
                            <div class="ec-pc-brand">Swiss Made</div>
                            <a href="{{ route('products.show', $product->id) }}" class="ec-pc-title">{{ $product->name }}</a>
                            <div class="ec-pc-pricing">
                                <span class="ec-pc-price">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     5.5 PARALLAX BANNER (CRAFTSMANSHIP)
     ══════════════════════════════════════════════════════ --}}
<section class="container">
    <div class="ec-parallax-banner" style="background-image: url('{{ asset('images/banner1.jpg') }}');">
        <div class="ec-pb-overlay"></div>
        <div class="ec-pb-content">
            <h2>The Art of Horology</h2>
            <p>Every timepiece tells a story of generational craftsmanship, meticulous engineering, and unyielding dedication to perfection. Discover watches that transcend time.</p>
            <a href="{{ route('products.index') }}" class="ec-btn-primary">Explore Legacy</a>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     6. EDITORIAL / MAGAZINE — The brand story
     ══════════════════════════════════════════════════════ --}}
<section class="ec-editorial">
    <div class="container">
        <div class="ec-editorial-wrapper">
            <div class="ec-ed-image">
                <!-- Using hero image as placeholder for editorial shot -->
                <img src="{{ asset('images/hero_watch_cyan.png') }}" loading="lazy" alt="Craftsmanship">
            </div>
            <div class="ec-ed-content">
                <span class="ec-ed-tag">The Journal</span>
                <h2>Mastering the Art of Horology</h2>
                <p>Behind every dial lies a masterpiece of micro-engineering. Our latest editorial explores the intricate world of Swiss automatic movements and why mechanical watches will never lose their soul in the digital age.</p>
                <ul class="ec-ed-highlights">
                    <li><i class="fa-solid fa-circle-check"></i> Hand-assembled calibers</li>
                    <li><i class="fa-solid fa-circle-check"></i> Sapphire crystal durability</li>
                    <li><i class="fa-solid fa-circle-check"></i> Timeless aesthetic value</li>
                </ul>
                <a href="#" class="ec-btn-outline">Read the Story</a>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     7. TRUST & AUTHENTICITY — Checkout confidence
     ══════════════════════════════════════════════════════ --}}
<section class="ec-trust-bar">
    <div class="container">
        <div class="ec-trust-grid">
            <div class="ec-trust-item">
                <div class="ec-ti-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="ec-ti-text">
                    <strong>100% Authentic</strong>
                    <span>Verified by certified watchmakers</span>
                </div>
            </div>
            <div class="ec-trust-item">
                <div class="ec-ti-icon"><i class="fa-solid fa-cube"></i></div>
                <div class="ec-ti-text">
                    <strong>Secure Shipping</strong>
                    <span>Fully insured & tracked delivery</span>
                </div>
            </div>
            <div class="ec-trust-item">
                <div class="ec-ti-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <div class="ec-ti-text">
                    <strong>30-Day Returns</strong>
                    <span>Hassle-free return policy</span>
                </div>
            </div>
            <div class="ec-trust-item">
                <div class="ec-ti-icon"><i class="fa-solid fa-lock"></i></div>
                <div class="ec-ti-text">
                    <strong>Secure Checkout</strong>
                    <span>256-bit SSL encrypted payments</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     7.5 CLIENT TESTIMONIALS
     ══════════════════════════════════════════════════════ --}}
<section class="ec-testimonials">
    <div class="container">
        <h2>What Our Collectors Say</h2>
        <div class="swiper ec-reviews-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="ec-review-card">
                        <div class="ec-rc-stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="ec-rc-quote">"An absolutely flawless experience. The watch arrived overnight in pristine condition with all original papers. The Midnight Ocean theme is stunning."</p>
                        <span class="ec-rc-author">— Alexander J.</span>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="ec-review-card">
                        <div class="ec-rc-stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="ec-rc-quote">"The authenticity guaranteed service gave me the peace of mind I needed for such a high-end purchase. Truly the standard for luxury e-commerce."</p>
                        <span class="ec-rc-author">— Marcus T.</span>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="ec-review-card">
                        <div class="ec-rc-stars">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="ec-rc-quote">"Incredible selection of rare timepieces. The customer support team was knowledgeable and extremely helpful during the checkout process."</p>
                        <span class="ec-rc-author">— Sophia L.</span>
                    </div>
                </div>
            </div>
            <div class="ec-swiper-pagination ec-reviews-pagination"></div>
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════════
     8. MAILING LIST — Clean E-commerce Newsletter
     ══════════════════════════════════════════════════════ --}}
<section class="ec-newsletter">
    <div class="container">
        <div class="ec-nl-box">
            <div class="ec-nl-content">
                <h2>Join the Collector's Club</h2>
                <p>Subscribe to receive updates on rare timepieces, exclusive promotions, and industry news.</p>
            </div>
            <div class="ec-nl-form-wrap">
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="ec-nl-form">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
                <div class="ec-nl-terms">By subscribing, you agree to our Privacy Policy.</div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    /* ── E-commerce Countdown Timer ── */
    @if($activeDeal && $activeDeal->end_date)
    (function(){
        const end = new Date("{{ $activeDeal->end_date->toIso8601String() }}");
        function tick(){
            const d = end - new Date();
            if(d<=0){ return; }
            document.getElementById('days').textContent    = String(Math.floor(d/864e5)).padStart(2,'0');
            document.getElementById('hours').textContent   = String(Math.floor(d%864e5/36e5)).padStart(2,'0');
            document.getElementById('minutes').textContent = String(Math.floor(d%36e5/6e4)).padStart(2,'0');
            document.getElementById('seconds').textContent = String(Math.floor(d%6e4/1e3)).padStart(2,'0');
        }
        tick(); setInterval(tick,1000);
    })();
    @endif

    /* ── Scroll Animations ── */
    if(typeof gsap !== 'undefined'){
        gsap.to('.ec-hero-img', {
            y: -15, duration: 3, repeat: -1, yoyo: true, ease: "sine.inOut"
        });

        // Setup scroll reveals for sections
        const sections = document.querySelectorAll('.ec-flash-sales, .ec-visual-cats, .ec-products-shelf, .ec-editorial, .ec-trust-bar, .ec-newsletter');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if(entry.isIntersecting) {
                    gsap.fromTo(entry.target, 
                        { y: 40, opacity: 0 },
                        { y: 0, opacity: 1, duration: 0.8, ease: "power3.out" }
                    );
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

        sections.forEach(sec => {
            sec.style.opacity = '0'; // hide initially
            observer.observe(sec);
        });
    }

    /* ── Swiper Carousel (Hero) ── */
    new Swiper('.ec-hero-swiper', {
        loop: true,
        parallax: true,
        speed: 1200, // Smooth slow transition
        autoplay: {
            delay: 6000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.ec-swiper-pagination',
            clickable: true,
        },
        effect: 'fade',
        fadeEffect: { crossFade: true },
        on: {
            // Re-trigger GSAP animations on every slide change for maximum premium feel
            slideChangeTransitionStart: function () {
                const activeSlide = this.slides[this.activeIndex];
                if(typeof gsap !== 'undefined') {
                    // Reset and animate text elements
                    gsap.fromTo(activeSlide.querySelectorAll('.ec-hero-title, .ec-hero-desc, .ec-hero-actions, .ec-badge, .ec-hero-trust'), 
                        { y: 30, opacity: 0 }, 
                        { y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: 'power3.out' }
                    );
                    // Reset and animate image/product
                    gsap.fromTo(activeSlide.querySelectorAll('.ec-hero-product'), 
                        { x: 50, opacity: 0, scale: 0.95 },
                        { x: 0, opacity: 1, scale: 1, duration: 1.2, ease: 'power2.out', delay: 0.2 }
                    );
                }
            },
            init: function () {
                // Initialize first slide animation
                const activeSlide = this.slides[this.activeIndex];
                if(typeof gsap !== 'undefined') {
                    gsap.fromTo(activeSlide.querySelectorAll('.ec-hero-title, .ec-hero-desc, .ec-hero-actions, .ec-badge, .ec-hero-trust'), 
                        { y: 30, opacity: 0 }, 
                        { y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: 'power3.out' }
                    );
                    gsap.fromTo(activeSlide.querySelectorAll('.ec-hero-product'), 
                        { x: 50, opacity: 0, scale: 0.95 },
                        { x: 0, opacity: 1, scale: 1, duration: 1.2, ease: 'power2.out', delay: 0.2 }
                    );
                }
            }
        }
    });

    /* ── Swiper Carousel (Products Shelf) ── */
    new Swiper('.ec-products-swiper', {
        slidesPerView: 1.2, // Peek next slide on mobile
        spaceBetween: 20,
        navigation: {
            nextEl: '.ec-nav-btn.ec-next',
            prevEl: '.ec-nav-btn.ec-prev',
        },
        breakpoints: {
            576: { slidesPerView: 2.2, spaceBetween: 20 },
            768: { slidesPerView: 3.2, spaceBetween: 20 },
            992: { slidesPerView: 4, spaceBetween: 24 }
        }
    });

    /* ── Swiper Carousel (Testimonials) ── */
    new Swiper('.ec-reviews-swiper', {
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.ec-reviews-pagination',
            clickable: true,
        },
        effect: 'fade',
        fadeEffect: { crossFade: true }
    });
});
</script>
@endsection