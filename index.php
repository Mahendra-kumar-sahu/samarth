<?php
// ---------------------------------------------
// Smarth Public School – Question Generator
// Single-file Home (index.php)
// ---------------------------------------------
$school_name = "Samarth Public School";

// (Optional) If you have a db connection file, include it:
// include "db.php";

// Any flash messages (e.g. after login or actions) can be shown like this:
$flash = $_GET['msg'] ?? "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title><?php echo htmlspecialchars($school_name) ?> • Question Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

  <!-- Bootstrap (optional, used for grid & utilities) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

  <style>
    :root{
      --bg:#0f1225;            /* deep navy */
      --bg-2:#0b0e1d;
      --card:#101426;
      --muted:#a8b1c7;
      --text:#eef2ff;
      --brand:#66e3ff;         /* cyan */
      --brand-2:#9b8cff;       /* violet */
      --accent:#ffd166;        /* warm accent for CTAs */
      --glass:rgba(255,255,255,.08);
      --border:rgba(255,255,255,.12);
      --shadow:0 20px 60px rgba(0,0,0,.35);
      --radius:18px;
    }

    *{box-sizing:border-box}
    html,body{margin:0;padding:0;font-family:Poppins,system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;color:var(--text);background:
      radial-gradient(80% 60% at 10% 0%, rgba(153,108,255,.25), transparent 50%),
      radial-gradient(60% 60% at 110% 20%, rgba(102,227,255,.18), transparent 50%),
      linear-gradient(180deg,var(--bg),var(--bg-2));
      min-height:100%;
    }
    img{max-width:100%;display:block}
    a{text-decoration:none;color:inherit}

    /* Header / Navbar */
    .site-header{
      position:sticky;top:0;z-index:50;
      backdrop-filter:blur(10px);
      background:rgba(8,12,28,.55);
      border-bottom:1px solid var(--border);
    }
    .nav-wrap{display:flex;align-items:center;justify-content:space-between;padding:12px 0;}
    .brand{display:flex;align-items:center;gap:12px;font-weight:700;font-size:18px}
    .brand__logo{
      width:36px;height:36px;border-radius:10px;display:grid;place-items:center;
      background:linear-gradient(135deg,var(--brand),var(--brand-2));box-shadow:var(--shadow);
    }
    .menu{display:flex;gap:18px;align-items:center}
    .menu a{color:var(--muted);font-weight:500}
    .menu a:hover{color:#fff}
    .burger{display:none;background:none;border:0;color:#fff;font-size:22px}

    /* Hero */
    .hero{
      position:relative;overflow:hidden;padding:64px 0 24px;
    }
    .hero__grid{
      display:grid;grid-template-columns:1.1fr .9fr;gap:36px;align-items:center;
    }
    .chip{
      display:inline-flex;align-items:center;gap:8px;
      padding:8px 12px;border-radius:999px;
      background:linear-gradient(135deg,rgba(153,108,255,.25),rgba(102,227,255,.25));
      border:1px solid var(--border);
      font-size:14px;color:#dfe6ff;
    }
    .hero h1{font-size:clamp(28px,4vw,54px);line-height:1.08;margin:14px 0 10px}
    .hero p{color:var(--muted);margin:0 0 18px;max-width:60ch}
    .hero__cta{display:flex;flex-wrap:wrap;gap:12px;margin:18px 0 12px}
    .btn{
      display:inline-flex;align-items:center;gap:8px;padding:12px 18px;
      border-radius:12px;border:1px solid var(--border);background:#131832;color:#fff;cursor:pointer;transition:.2s;
    }
    .btn:hover{transform:translateY(-2px)}
    .btn--primary{background:linear-gradient(135deg,var(--brand),var(--brand-2));border:0}
    .btn--ghost{background:transparent}
    .btn--pill{border-radius:999px}
    .badge-list{display:flex;gap:16px;list-style:none;padding:0;margin:12px 0 0;color:var(--muted);flex-wrap:wrap}
    .hero__art{filter:drop-shadow(var(--shadow))}
    .blob{position:absolute;border-radius:50%;filter:blur(90px);opacity:.35;z-index:-1}
    .b1{width:380px;height:380px;background:var(--brand);top:-60px;left:-40px}
    .b2{width:340px;height:340px;background:var(--brand-2);bottom:-80px;right:-40px}

    /* Section */
    .section{padding:64px 0}
    .section--alt{background:rgba(255,255,255,.02);border-top:1px solid var(--border);border-bottom:1px solid var(--border)}
    .section__title{text-align:center;font-size:clamp(22px,2.6vw,34px);margin:0 0 24px}

    /* Cards */
    .cards{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}
    .card{
      background:radial-gradient(120% 120% at 0% 0%, rgba(255,255,255,.05), rgba(255,255,255,.02));
      border:1px solid var(--border);padding:22px;border-radius:16px;box-shadow:var(--shadow);height:100%;
    }
    .card__icon{font-size:28px;color:var(--brand)}
    .card h3{margin:10px 0 6px;font-size:18px}
    .card p{color:var(--muted);margin:0}

    /* Steps */
    .steps{display:grid;place-items:center;gap:20px}
    .steps__list{list-style:none;display:grid;gap:14px;padding:0;margin:0;max-width:860px;width:100%}
    .steps__list li{
      display:grid;grid-template-columns:56px 1fr;gap:14px;align-items:start;
      background:rgba(255,255,255,.03);border:1px solid var(--border);padding:16px;border-radius:14px
    }
    .steps__num{
      width:56px;height:56px;border-radius:14px;display:grid;place-items:center;
      background:linear-gradient(135deg,var(--brand),var(--brand-2));font-weight:700
    }

    /* Footer */
    .footer{padding:28px 0;border-top:1px solid var(--border);background:rgba(0,0,0,.2)}
    .footer__grid{display:flex;justify-content:space-between;align-items:center;gap:18px;flex-wrap:wrap}
    .brand--footer .brand__logo{width:28px;height:28px}
    .footer__links{display:flex;gap:18px}
    .muted{color:var(--muted)}

    /* Reveal animation */
    [data-reveal]{opacity:0;transform:translateY(16px);transition:opacity .6s ease, transform .6s ease}
    [data-reveal].is-visible{opacity:1;transform:none}

    /* Responsive */
    @media (max-width: 992px){
      .hero__grid{grid-template-columns:1fr}
      .cards{grid-template-columns:repeat(2,1fr)}
    }
    @media (max-width: 576px){
      .menu{display:none;position:absolute;top:64px;right:4%;flex-direction:column;background:#0b0f21;border:1px solid var(--border);padding:12px;border-radius:12px}
      .menu.is-open{display:flex}
      .burger{display:block}
      .cards{grid-template-columns:1fr}
      .steps__list li{grid-template-columns:48px 1fr}
      .steps__num{width:48px;height:48px}
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header class="site-header">
    <div class="container nav-wrap">
      <a class="brand" href="#">
        <span class="brand__logo"><img src="spsk1.png"></span>
        <span><?php echo htmlspecialchars($school_name) ?></span>
      </a>

      <nav id="menu" class="menu">
        <a href="admin_login.php">Admin</a>
        <a href="teacher_register.php">Teacher</a>
        <a href="about.php">About</a>
       
      </nav>

      <button id="burger" class="burger" aria-label="Menu"><i class="ri-menu-3-line"></i></button>
    </div>
  </header>

  <!-- Flash message (if any) -->
  <?php if(!empty($flash)): ?>
    <div class="container mt-3">
      <div class="alert alert-info py-2 px-3" role="alert">
        <?php echo htmlspecialchars($flash) ?>
      </div>
    </div>
  <?php endif; ?>

  <!-- Hero -->
  <section class="hero">
    <div class="container hero__grid">
      <div class="hero__content" data-reveal>
        <span class="chip"><i class="ri-sparkling-2-line"></i> Question Paper – Fast & Smart</span>
        <h1>Build question papers in minutes for <span style="background:linear-gradient(135deg,var(--brand),var(--brand-2));-webkit-background-clip:text;background-clip:text;color:transparent;">every class & subject</span>.</h1>
        <p>Upload chapter-wise questions (image), choose how many you need, and download a neat printable paper. Randomized. Unique. Consistent formatting.</p>

        <div class="hero__cta">
          <a href="admin_login.html" class="btn btn--primary btn--pill"><i class="ri-flashlight-line"></i>Generate Question</a>
          <a href="about.php" class="btn btn--ghost btn--pill"><i class="ri-folder-upload-line"></i>About</a>
        </div>

        <ul class="badge-list">
          <li><i class="ri-shield-check-line"></i> Secure</li>
          <li><i class="ri-smartphone-line"></i> 100% Responsive</li>
          <li><i class="ri-file-pdf-line"></i> PDF Ready</li>
        </ul>
      </div>

      <div class="hero__art" data-reveal>
        <!-- Decorative mockup card -->
        <div class="card" style="border-radius:var(--radius);padding:0;overflow:hidden">
          <div style="display:flex;gap:8px;align-items:center;background:rgba(255,255,255,.05);padding:10px 12px;border-bottom:1px solid var(--border)">
            <div style="width:10px;height:10px;border-radius:50%;background:#ff6b6b"></div>
            <div style="width:10px;height:10px;border-radius:50%;background:#ffd166"></div>
            <div style="width:10px;height:10px;border-radius:50%;background:#06d6a0"></div>
            <span class="muted" style="margin-left:6px">Paper Preview</span>
          </div>
          <div style="padding:18px">
            <h3 style="margin:0 0 6px">Class 10 – Mathematics</h3>
            <p class="muted" style="margin:0 0 14px">Algebra • Trigonometry • Geometry</p>
            <ol style="display:grid;gap:8px;margin:0 0 12px 18px">
              <li>Solve: If x + y = 12 and xy = 20, find x² + y².</li>
              <li>Find sin θ if tan θ = 3/4.</li>
              <li>Construct a triangle with sides 6cm, 7cm, 8cm.</li>
            </ol>
            <div style="display:flex;gap:8px;flex-wrap:wrap">
              <span class="chip" style="padding:6px 10px"><i class="ri-shuffle-line"></i> Randomized</span>
              <span class="chip" style="padding:6px 10px"><i class="ri-checkbox-circle-line"></i> Unique</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- background blobs -->
    <div class="blob b1"></div>
    <div class="blob b2"></div>
  </section>

  <!-- Features -->
  <section id="features" class="section section--alt">
    <div class="container">
      <h2 class="section__title" data-reveal>Why teachers love it</h2>
      <div class="cards" data-reveal>
        <article class="card">
          <i class="ri-upload-2-line card__icon"></i>
          <h3>Upload Images / PDFs</h3>
          <p>Keep a chapter-wise bank. PDF pages are auto-mapped for assembling.</p>
        </article>
        <article class="card">
          <i class="ri-shuffle-line card__icon"></i>
          <h3>Random & Unique</h3>
          <p>Pick exactly N questions. No duplicates across a single paper.</p>
        </article>
        <article class="card">
          <i class="ri-file-pdf-line card__icon"></i>
          <h3>One-Click PDF</h3>
          <p>Download professional layout with school header & sections.</p>
        </article>
        <article class="card">
          <i class="ri-settings-4-line card__icon"></i>
          <h3>Filters & Levels</h3>
          <p>Filter by chapter, difficulty, type (MCQ/SA/LA) and marks.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- Steps -->
  <section id="how" class="section">
    <div class="container steps" data-reveal>
      <h2 class="section__title">How it works</h2>
      <ol class="steps__list">
        <li>
          <span class="steps__num">1</span>
          <div>
            <h4>Create chapters</h4>
            <p class="muted">Add class & chapter names to organize your bank.</p>
          </div>
        </li>
        <li>
          <span class="steps__num">2</span>
          <div>
            <h4>Upload questions</h4>
            <p class="muted">Upload images or PDFs. Map pages to chapters.</p>
          </div>
        </li>
        <li>
          <span class="steps__num">3</span>
          <div>
            <h4>Generate paper</h4>
            <p class="muted">Choose chapter & count. Get randomized, unique paper as PDF.</p>
          </div>
        </li>
      </ol>
      <div style="margin-top:14px">
        <a href="random-picker.html" class="btn btn--primary btn--pill"><i class="ri-flashlight-line"></i> Start Generating</a>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container footer__grid">
      <div class="brand brand--footer">
        <span class="brand__logo"><i class="ri-school-line"></i></span>
        <strong><?php echo htmlspecialchars($school_name) ?></strong>
        <div class="muted">© <span id="year"></span> All rights reserved.</div>
      </div>
      <div class="footer__links">
        <a class="muted" href="#features">Features</a>
        <a class="muted" href="#how">How it works</a>
      
      </div>
    </div>
  </footer>

  <!-- JS: minimal interactions -->
  <script>
    // Intersection reveal
    const $$ = (s,sc=document)=>Array.from(sc.querySelectorAll(s));
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('is-visible'); io.unobserve(e.target);} });
    },{threshold:.12});
    $$('[data-reveal]').forEach(el=>io.observe(el));

    // Mobile menu
    const burger = document.getElementById('burger');
    const menu = document.getElementById('menu');
    if(burger && menu){ burger.addEventListener('click',()=> menu.classList.toggle('is-open')); }

    // Year
    document.getElementById('year').textContent = new Date().getFullYear();
  </script>

  <!-- Bootstrap bundle (for navbar toggler icons if needed) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
