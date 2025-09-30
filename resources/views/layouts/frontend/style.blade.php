<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #fff;
  }
  .hero-section { padding: 80px 0; }
  .hero-text h1 {
    font-family: 'Playfair Display', serif;
    font-weight: 700;
    font-size: 3rem;
    line-height: 1.2;
  }
  .brand-logos img {
    height: 80px;
    margin-right: 50px;
  }
  .btn-pink {
    background-color: #f47183;
    border: none;
  }
  .btn-pink:hover {
    background-color: #e35a6f;
  }
  .navbar-brand span {
    color: #f47183;
    font-weight: bold;
  }
  .navbar-nav .nav-link {
    margin: 0 10px;
    padding: 8px 10px;
    font-weight: 500;
}

  .hero-text {
      opacity:0;
      transform: translateY(-30px) scale(0.95);
      animation: fadeInScale 1.2s forwards;
    }
    .hero-text:nth-child(2) { animation-delay: 0.3s; }

    @keyframes fadeInScale {
      0% { opacity:0; transform: translateY(-30px) scale(0.95); }
      100% { opacity:1; transform: translateY(0) scale(1); }
    }

    @keyframes floatImage {
      0% { transform: translateY(0) rotate(-1deg); }
      100% { transform: translateY(-25px) rotate(1deg); }
    }

    @keyframes floatBubble {
      0% { transform: translateY(0) translateX(0); opacity:0.6; }
      50% { transform: translateY(-50px) translateX(15px); opacity:0.8; }
      100% { transform: translateY(-120px) translateX(0); opacity:0; }
    }

    @keyframes twinkle {
      0% { opacity:0.3; transform: scale(0.7); }
      50% { opacity:1; transform: scale(1.3); }
      100% { opacity:0.3; transform: scale(0.7); }
    }

    /* Button Gradient Glow */
    .btn-gradient-pink-purple {
      background: linear-gradient(45deg, #ff4d94, #b19cd9);
      color:white;
      border-radius:50px;
      padding:14px 50px;
      font-weight:700;
      font-size:1.15rem;
      box-shadow:0 12px 35px rgba(255,77,148,0.6);
      transition:0.3s;
    }
    .btn-gradient-pink-purple:hover {
      transform:translateY(-6px) scale(1.06);
      box-shadow:0 22px 65px rgba(255,77,148,0.8);
    }

  /* Button Style */
    .btn-gradient-pink-purple {
      background: linear-gradient(45deg, #ff4d94, #b19cd9);
      color:white;
      font-weight:600;
      box-shadow:0 8px 20px rgba(255,77,148,0.3);
      transition:0.3s;
    }
    .btn-gradient-pink-purple:hover {
      transform:translateY(-4px);
      box-shadow:0 12px 30px rgba(255,77,148,0.5);
    }

    /* Animation */
    @keyframes fadeInUp {
      0% { opacity:0; transform: translateY(30px); }
      100% { opacity:1; transform: translateY(0); }
    }
    @keyframes floatImage {
      0% { transform: translateY(0); }
      100% { transform: translateY(-10px); }
    }
    .fadeInUp {
      animation: fadeInUp 1s ease-out forwards;
    }
    /* Kenapa Harus Pakai Acme Section */
.why-acme-section {
  background: linear-gradient(135deg, #b19cd9 0%, #91cbe8 100%);
}

.section-title {
  position: relative;
  display: inline-block;
}
.section-title::after {
  content: "";
  display: block;
  height: 4px;
  width: 60px;
  background: linear-gradient(90deg, #ff4d94, #b19cd9);
  margin: 8px auto 0;
  border-radius: 2px;
}

.why-card {
  background: #fff;
  color: #333;
  border-radius: 20px;
  padding: 30px 20px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
}
.why-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 18px 45px rgba(0,0,0,0.12);
}

.feature-icon {
  width: 90px;
  height: auto;
  border-radius: 50%;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}
/* Stats Section */
.stats-section {
  background-color: #f9dcdc;
  color: #333;
  padding: 90px 0;
}
.stats-section h3 {
  font-size: 1.8rem;
}
.stats-section p {
  font-size: 1rem;
}
.stats-section h2 {
  color: #e85a70;
  transition: transform 0.3s ease;
}
.stats-section h2:hover {
  transform: scale(1.1);
}
.stats-divider {
  border-left: 2px solid rgba(255,255,255,0.3);
  border-right: 2px solid rgba(255,255,255,0.3);
}

/* Produk Unggulan */
.section-title {
  position: relative;
  display: inline-block;
}
.section-title::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  margin: 8px auto 0;
  background-color: #e85a70;
  border-radius: 2px;
}

.product-card {
  border: none;
  border-radius: 15px;
  overflow: hidden;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  transition: all 0.3s ease;
}
.product-card:hover {
  transform: translateY(-6px);
  
}

.product-img-wrapper {
  width: 100%;
  height: 300px;
  overflow: hidden;
}
.product-img-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.4s ease;
}

.btn-dark {
    background-color: #e85a70; /* pink */
    color: #fff;
    border: none;
}

.btn-dark:hover {
    background-color: #ff69b4; /* pink lebih terang saat hover */
    color: #fff;
}

.back-icon {
    width: 40px;
    height: 40px;
    background-color: #f47183; /* warna pink */
    color: white;
    font-weight: bold;
    font-size: 1.25rem;
    border-radius: 8px; /* sudut membulat */
    text-decoration: none;
    transition: background-color 0.3s;
}

.back-icon:hover {
    background-color: #e15f73;
}

.brand-acme {
    font-family: 'Great Vibes', cursive;
    font-size: 28px;
    color: #e15f73; 



</style>
