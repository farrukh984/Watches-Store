@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home-premium.css') }}">
@endsection

@section('content')

{{-- ══════════════════════════════════════════════════════
     1. HERO — Split screen: Text left, floating watch right
     ══════════════════════════════════════════════════════ --}}
<section class="sec-hero">
    <div class="hero-particles" id="heroParticles"></div>
    <div class="container hero-split">
        <div class="hero-left" id="heroLeft">
            <div class="hero-tag"><span class="hero-tag-dot"></span> New Collection 2026</div>
            <h1 class="hero-heading">Crafted for<br><span class="hero-accent">Perfection</span></h1>
            <p class="hero-sub">Explore handpicked luxury timepieces from the world's most iconic brands. Every second counts.</p>
            <div class="hero-btns">
                <a href="{{ route('products.index') }}" class="btn-hero-primary">
                    Explore Now <i class="fa-solid fa-arrow-right-long"></i>
                </a>
                <a href="#sec-featured" class="btn-hero-ghost">
                    <i class="fa-regular fa-circle-play"></i> Watch Story
                </a>
            </div>
            <div class="hero-mini-stats">
                <div class="hm-stat"><strong>12K+</strong><span>Happy Clients</span></div>
                <div class="hm-stat"><strong>500+</strong><span>Luxury Watches</span></div>
                <div class="hm-stat"><strong>50+</strong><span>Top Brands</span></div>
            </div>
        </div>
        <div class="hero-right-img" id="heroRight">
            <div class="hero-glow"></div>
            <img src="{{ asset('images/hero_watch_dark.png') }}" alt="Luxury Watch" class="hero-watch-float" loading="eager">
            <div class="hero-float-badge hfb-top">
                <i class="fa-solid fa-certificate"></i> Certified Authentic
            </div>
            <div class="hero-float-badge hfb-bottom">
                <i class="fa-solid fa-shield-halved"></i> 2-Year Warranty
            </div>
        </div>
    </div>
    <div class="hero-scroll-cue" id="scrollCue">
        <div class="scroll-dot"></div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     2. BRAND MARQUEE — Infinite scrolling brand names
     ══════════════════════════════════════════════════════ --}}
<section class="sec-marquee">
    <div class="marquee-track">
        <div class="marquee-content">
            <span>ROLEX</span><span class="mq-dot">⬥</span>
            <span>OMEGA</span><span class="mq-dot">⬥</span>
            <span>TAG HEUER</span><span class="mq-dot">⬥</span>
            <span>CARTIER</span><span class="mq-dot">⬥</span>
            <span>BREITLING</span><span class="mq-dot">⬥</span>
            <span>PATEK PHILIPPE</span><span class="mq-dot">⬥</span>
            <span>HUBLOT</span><span class="mq-dot">⬥</span>
            <span>IWC</span><span class="mq-dot">⬥</span>
            <span>TISSOT</span><span class="mq-dot">⬥</span>
            <span>SEIKO</span><span class="mq-dot">⬥</span>
            <span>ROLEX</span><span class="mq-dot">⬥</span>
            <span>OMEGA</span><span class="mq-dot">⬥</span>
            <span>TAG HEUER</span><span class="mq-dot">⬥</span>
            <span>CARTIER</span><span class="mq-dot">⬥</span>
            <span>BREITLING</span><span class="mq-dot">⬥</span>
            <span>PATEK PHILIPPE</span><span class="mq-dot">⬥</span>
            <span>HUBLOT</span><span class="mq-dot">⬥</span>
            <span>IWC</span><span class="mq-dot">⬥</span>
            <span>TISSOT</span><span class="mq-dot">⬥</span>
            <span>SEIKO</span><span class="mq-dot">⬥</span>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     3. FLASH DEALS — Dark neon-accent card strip
     ══════════════════════════════════════════════════════ --}}
@if($activeDeal)
<section class="sec-deals" id="secDeals">
    <div class="container">
        <div class="deals-top">
            <div class="deals-title-wrap">
                <div class="deals-icon-pulse"><i class="fa-solid fa-bolt-lightning"></i></div>
                <div>
                    <h2>Flash Deals</h2>
                    <p>Limited time offers — grab before they're gone</p>
                </div>
            </div>
            <div class="deals-timer" id="countdown">
                <div class="dt-block"><span id="days">00</span><small>Days</small></div>
                <div class="dt-sep">:</div>
                <div class="dt-block"><span id="hours">00</span><small>Hrs</small></div>
                <div class="dt-sep">:</div>
                <div class="dt-block"><span id="minutes">00</span><small>Min</small></div>
                <div class="dt-sep">:</div>
                <div class="dt-block"><span id="seconds">00</span><small>Sec</small></div>
            </div>
        </div>
        <div class="deals-strip">
            @foreach($deals as $item)
            @if($item->product)
            <a href="{{ route('products.show', $item->product_id) }}" class="deal-card-v2">
                <div class="dcv2-discount">-{{ $item->discount_percent }}%</div>
                <div class="dcv2-img"><img src="{{ display_image($item->product->image) }}" alt="{{ $item->product->name }}" loading="lazy"></div>
                <div class="dcv2-body">
                    <p class="dcv2-name">{{ $item->product->name }}</p>
                    @php $dp = $item->product->price * (1 - $item->discount_percent / 100); @endphp
                    <span class="dcv2-price">${{ number_format($dp, 2) }}</span>
                    <span class="dcv2-was">${{ number_format($item->product->price, 2) }}</span>
                </div>
            </a>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ══════════════════════════════════════════════════════
     4. CATEGORY EXPLORER — Bento grid with overlay
     ══════════════════════════════════════════════════════ --}}
<section class="sec-categories" id="secCategories">
    <div class="container">
        <div class="sec-head-center">
            <span class="sec-label">Browse</span>
            <h2>Shop by Category</h2>
            <p>Find the perfect watch for every occasion</p>
        </div>
        <div class="bento-grid">
            @foreach($categories->take(6) as $cat)
            <a href="{{ route('products.index', ['category' => $cat->id]) }}" class="bento-item {{ $loop->first ? 'bento-large' : '' }}">
                <div class="bento-bg"
                    @if($cat->background_image)
                    style="background-image: url('{{ display_image($cat->background_image) }}')"
                    @else
                    style="background: linear-gradient(135deg, hsl({{ $loop->index * 55 + 200 }}, 50%, 20%), hsl({{ $loop->index * 55 + 240 }}, 60%, 10%))"
                    @endif
                ></div>
                <div class="bento-content">
                    <h3>{{ $cat->name }}</h3>
                    <span class="bento-count">{{ $cat->products->count() }} items →</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     5. FEATURED COLLECTION — Large showcase cards (2-col)
     ══════════════════════════════════════════════════════ --}}
<section class="sec-featured" id="sec-featured">
    <div class="container">
        <div class="sec-head-left">
            <span class="sec-label">Curated</span>
            <h2>Featured Collection</h2>
        </div>
        <div class="featured-duo">
            @foreach($recommended->take(2) as $fp)
            <div class="feat-card">
                <div class="feat-img-wrap">
                    <img src="{{ display_image($fp->image) }}" alt="{{ $fp->name }}" loading="lazy">
                </div>
                <div class="feat-details">
                    <span class="feat-badge">{{ $loop->first ? '🔥 Best Seller' : '⭐ Editor\'s Pick' }}</span>
                    <h3>{{ $fp->name }}</h3>
                    <div class="feat-price">${{ number_format($fp->price, 2) }}
                        @if($fp->old_price)<del>${{ number_format($fp->old_price, 2) }}</del>@endif
                    </div>
                    <a href="{{ route('products.show', $fp->id) }}" class="feat-btn">View Details <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     6. CATEGORY PRODUCT ROWS — Tabbed sections
     ══════════════════════════════════════════════════════ --}}
@foreach($categories->take(3) as $category)
@if($category->products->count() > 0)
<section class="sec-prodrow {{ $loop->even ? 'prodrow-alt' : '' }}">
    <div class="container">
        <div class="sec-head-between">
            <h2>{{ $category->name }}</h2>
            <a href="{{ route('products.index', ['category' => $category->id]) }}" class="link-arrow">See all <i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <div class="prodrow-grid">
            @foreach($category->products->take(5) as $product)
            <a href="{{ route('products.show', $product->id) }}" class="pcard">
                <div class="pcard-visual">
                    <img src="{{ display_image($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                    <div class="pcard-hover-ring"><i class="fa-solid fa-bag-shopping"></i></div>
                </div>
                <div class="pcard-info">
                    <p>{{ $product->name }}</p>
                    <strong>${{ number_format($product->price, 2) }}</strong>
                    @if($product->old_price)<del>${{ number_format($product->old_price, 2) }}</del>@endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endforeach


{{-- ══════════════════════════════════════════════════════
     7. PARALLAX CTA STRIP — Full-width quote
     ══════════════════════════════════════════════════════ --}}
<section class="sec-parallax-cta">
    <div class="parallax-bg" style="background-image:url('{{ asset('images/hero_watch_banner.png') }}')"></div>
    <div class="parallax-overlay"></div>
    <div class="container parallax-content">
        <h2>"A watch is the most personal piece of art you can wear."</h2>
        <a href="{{ route('products.index') }}" class="parallax-btn">Discover Our Collection</a>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     8. WHY CHOOSE US — Glassmorphism info cards
     ══════════════════════════════════════════════════════ --}}
<section class="sec-why" id="secWhy">
    <div class="container">
        <div class="sec-head-center">
            <span class="sec-label">Our Promise</span>
            <h2>Why Choose Us</h2>
            <p>We deliver excellence at every step of your journey</p>
        </div>
        <div class="why-grid">
            <div class="why-card why-c1">
                <div class="why-icon"><i class="fa-solid fa-gem"></i></div>
                <h4>100% Authentic</h4>
                <p>Every timepiece is verified and certified genuine with complete documentation.</p>
            </div>
            <div class="why-card why-c2">
                <div class="why-icon"><i class="fa-solid fa-truck-fast"></i></div>
                <h4>Express Delivery</h4>
                <p>Free insured shipping worldwide. Track your order in real-time from our warehouse to your door.</p>
            </div>
            <div class="why-card why-c3">
                <div class="why-icon"><i class="fa-solid fa-rotate-left"></i></div>
                <h4>30-Day Returns</h4>
                <p>Not satisfied? Return any unworn watch within 30 days for a full refund, no questions asked.</p>
            </div>
            <div class="why-card why-c4">
                <div class="why-icon"><i class="fa-solid fa-headset"></i></div>
                <h4>24/7 Concierge</h4>
                <p>Our dedicated watch experts are available around the clock to assist you with anything.</p>
            </div>
            <div class="why-card why-c5">
                <div class="why-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>Secure Payments</h4>
                <p>Shop with confidence. 256-bit SSL encryption and trusted payment gateways protect your data.</p>
            </div>
            <div class="why-card why-c6">
                <div class="why-icon"><i class="fa-solid fa-gift"></i></div>
                <h4>Premium Packaging</h4>
                <p>Each watch arrives in a luxury gift box with authenticity certificate and care kit included.</p>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     9. RECOMMENDED — Pinterest-style masonry grid
     ══════════════════════════════════════════════════════ --}}
<section class="sec-recommended" id="secRecommended">
    <div class="container">
        <div class="sec-head-between">
            <div>
                <span class="sec-label">Just For You</span>
                <h2>Recommended</h2>
            </div>
            <a href="{{ route('products.index') }}" class="link-arrow">View All <i class="fa-solid fa-chevron-right"></i></a>
        </div>
        <div class="rec-masonry">
            @foreach($recommended as $rp)
            <a href="{{ route('products.show', $rp->id) }}" class="rec-tile {{ $loop->iteration % 5 == 1 ? 'rec-tall' : '' }}">
                <div class="rec-tile-img">
                    <img src="{{ display_image($rp->image) }}" alt="{{ $rp->name }}" loading="lazy">
                </div>
                <div class="rec-tile-info">
                    <p>{{ $rp->name }}</p>
                    <strong>${{ number_format($rp->price, 2) }}</strong>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     10. INQUIRY / QUOTE — Asymmetric two-tone section
     ══════════════════════════════════════════════════════ --}}
<section class="sec-inquiry" id="inquiry-section">
    <div class="inquiry-left-bg"></div>
    <div class="container inquiry-wrap">
        <div class="inquiry-text">
            <span class="sec-label">Get a Quote</span>
            <h2>Can't find what<br>you're looking for?</h2>
            <p>Submit your requirements and our sourcing team will find the perfect timepiece from our global supplier network.</p>
            <div class="inquiry-perks">
                <div class="iq-perk"><i class="fa-regular fa-circle-check"></i> Multiple Supplier Quotes</div>
                <div class="iq-perk"><i class="fa-regular fa-circle-check"></i> Price Match Guarantee</div>
                <div class="iq-perk"><i class="fa-regular fa-circle-check"></i> Expert Consultation</div>
                <div class="iq-perk"><i class="fa-regular fa-circle-check"></i> Global Sourcing Network</div>
            </div>
        </div>
        <div class="inquiry-form-card">
            <h4>Send Your Request</h4>
            <form method="POST" action="{{ route('inquiry.send') }}">
                @csrf
                <div class="iq-field">
                    <label>What are you looking for?</label>
                    <input type="text" name="item" placeholder="e.g. Rolex Submariner" required>
                </div>
                <div class="iq-field">
                    <label>Additional Details</label>
                    <textarea name="details" placeholder="Condition, year, specific model..." rows="3"></textarea>
                </div>
                <div class="iq-row">
                    <div class="iq-field">
                        <label>Quantity</label>
                        <input type="number" name="quantity" placeholder="1" required>
                    </div>
                    <div class="iq-field">
                        <label>Unit</label>
                        <select name="unit">
                            <option value="Pcs">Pieces</option>
                            <option value="Sets">Sets</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="iq-submit">Submit Request <i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     11. TESTIMONIALS — Customer reviews
     ══════════════════════════════════════════════════════ --}}
<section class="sec-testimonials" id="secTestimonials">
    <div class="container">
        <div class="sec-head-center">
            <span class="sec-label">Reviews</span>
            <h2>What Our Customers Say</h2>
        </div>
        <div class="testi-row">
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p>"Absolutely stunning watch! The quality exceeded my expectations. Fast shipping and impeccable packaging. Will definitely order again."</p>
                <div class="testi-author">
                    <div class="testi-avatar ta-1">A</div>
                    <div><strong>Ahmed K.</strong><span>Verified Buyer</span></div>
                </div>
            </div>
            <div class="testi-card testi-highlight">
                <div class="testi-stars">★★★★★</div>
                <p>"I've been collecting watches for 15 years and this store has the best selection I've found online. Their authentication process gives me total confidence."</p>
                <div class="testi-author">
                    <div class="testi-avatar ta-2">S</div>
                    <div><strong>Sarah M.</strong><span>Premium Member</span></div>
                </div>
            </div>
            <div class="testi-card">
                <div class="testi-stars">★★★★★</div>
                <p>"Received my order in just 3 days with beautiful gift wrapping. The customer service team was incredibly helpful. Highly recommended!"</p>
                <div class="testi-author">
                    <div class="testi-avatar ta-3">R</div>
                    <div><strong>Rizwan A.</strong><span>Verified Buyer</span></div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     12. STATS COUNTER — Animated numbers strip
     ══════════════════════════════════════════════════════ --}}
<section class="sec-counter" id="secCounter">
    <div class="container counter-grid">
        <div class="counter-item">
            <span class="counter-num" data-target="12500">0</span>
            <p>Watches Sold</p>
        </div>
        <div class="counter-item">
            <span class="counter-num" data-target="98">0</span>
            <p>% Satisfaction</p>
        </div>
        <div class="counter-item">
            <span class="counter-num" data-target="55">0</span>
            <p>Countries Served</p>
        </div>
        <div class="counter-item">
            <span class="counter-num" data-target="24">0</span>
            <p>/ 7 Support</p>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     13. NEWSLETTER — Gradient card with pattern
     ══════════════════════════════════════════════════════ --}}
<section class="sec-newsletter" id="secNewsletter">
    <div class="container">
        <div class="nl-card">
            <div class="nl-pattern"></div>
            <div class="nl-inner">
                <div class="nl-text">
                    <i class="fa-regular fa-bell nl-bell"></i>
                    <h3>Don't Miss Out</h3>
                    <p>Subscribe for exclusive launches, flash sales & VIP access to limited editions.</p>
                </div>
                <form method="POST" action="{{ route('newsletter.subscribe') }}" class="nl-form">
                    @csrf
                    <div class="nl-input-group">
                        <input type="email" name="email" placeholder="your@email.com" required>
                        <button type="submit">Subscribe</button>
                    </div>
                    <span class="nl-note"><i class="fa-solid fa-lock"></i> We respect your privacy. Unsubscribe anytime.</span>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ── Countdown Timer ── */
    @if($activeDeal && $activeDeal->end_date)
    (function(){
        const end = new Date("{{ $activeDeal->end_date->toIso8601String() }}");
        function tick(){
            const d = end - new Date();
            if(d<=0){ const s=document.querySelector('.sec-deals'); if(s) s.style.display='none'; return; }
            document.getElementById('days').textContent    = String(Math.floor(d/864e5)).padStart(2,'0');
            document.getElementById('hours').textContent   = String(Math.floor(d%864e5/36e5)).padStart(2,'0');
            document.getElementById('minutes').textContent = String(Math.floor(d%36e5/6e4)).padStart(2,'0');
            document.getElementById('seconds').textContent = String(Math.floor(d%6e4/1e3)).padStart(2,'0');
        }
        tick(); setInterval(tick,1000);
    })();
    @endif


    /* ── Animated Counter ── */
    const counterSection = document.getElementById('secCounter');
    if(counterSection){
        let counted = false;
        const countObs = new IntersectionObserver(entries => {
            if(entries[0].isIntersecting && !counted){
                counted = true;
                document.querySelectorAll('.counter-num').forEach(el => {
                    const target = +el.dataset.target;
                    const step = target / 60;
                    let cur = 0;
                    const timer = setInterval(() => {
                        cur += step;
                        if(cur >= target){ el.textContent = target.toLocaleString(); clearInterval(timer); }
                        else el.textContent = Math.floor(cur).toLocaleString();
                    }, 25);
                });
            }
        }, { threshold: 0.4 });
        countObs.observe(counterSection);
    }


    /* ── GSAP Animations ── */
    if(typeof gsap !== 'undefined'){

        // Hero entrance
        const tl = gsap.timeline({ defaults:{ ease:'power3.out' } });
        tl.from('#heroLeft .hero-tag', { x:-40, opacity:0, duration:0.5 })
          .from('#heroLeft .hero-heading', { y:50, opacity:0, duration:0.7 }, '-=0.2')
          .from('#heroLeft .hero-sub', { y:30, opacity:0, duration:0.5 }, '-=0.3')
          .from('#heroLeft .hero-btns', { y:20, opacity:0, duration:0.5 }, '-=0.2')
          .from('#heroLeft .hm-stat', { y:15, opacity:0, stagger:0.1, duration:0.4 }, '-=0.2')
          .from('#heroRight', { x:60, opacity:0, duration:0.8, ease:'power2.out' }, '-=0.8')
          .from('.hfb-top', { y:-20, opacity:0, duration:0.5 }, '-=0.3')
          .from('.hfb-bottom', { y:20, opacity:0, duration:0.5 }, '-=0.3')
          .from('#scrollCue', { opacity:0, duration:0.4 });

        // Floating watch animation
        gsap.to('.hero-watch-float', {
            y: -15, duration: 2.5, repeat: -1, yoyo: true, ease: 'sine.inOut'
        });

        // Scroll-triggered sections
        const reveals = document.querySelectorAll('.sec-deals, .sec-categories, .sec-featured, .sec-prodrow, .sec-parallax-cta, .sec-why, .sec-recommended, .sec-inquiry, .sec-testimonials, .sec-counter, .sec-newsletter');
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if(e.isIntersecting){
                    e.target.classList.add('revealed');
                    io.unobserve(e.target);
                }
            });
        }, { threshold:0.08, rootMargin:'0px 0px -40px 0px' });
        reveals.forEach(s => io.observe(s));

        // Parallax on hero
        const hImg = document.querySelector('.hero-watch-float');
        window.addEventListener('scroll', () => {
            const s = window.scrollY;
            if(s < 900 && hImg){
                hImg.style.transform = `translateY(${-15 + s*0.08}px)`;
            }
        }, {passive:true});
    }


    /* ── Hero Particle Effect (lightweight) ── */
    const canvas = document.getElementById('heroParticles');
    if(canvas){
        // Create floating dots using CSS
        for(let i=0;i<20;i++){
            const dot = document.createElement('div');
            dot.className = 'particle-dot';
            dot.style.left = Math.random()*100+'%';
            dot.style.top = Math.random()*100+'%';
            dot.style.animationDelay = Math.random()*6+'s';
            dot.style.animationDuration = (4+Math.random()*6)+'s';
            canvas.appendChild(dot);
        }
    }
});
</script>
@endsection