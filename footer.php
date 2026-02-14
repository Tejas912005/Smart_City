<!-- Newsletter Section - Modern -->
<!-- <section class="newsletter-new">
  <div class="container">
    <div class="newsletter-card">
      <div class="newsletter-left">
        <div class="newsletter-icon-wrap">
          <i class="fas fa-bell"></i>
        </div>
        <h3>Never Miss An Update!</h3>
        <p>Get notified about city improvements, new features, and important announcements directly in your inbox.</p>
        <div class="newsletter-benefits">
          <span><i class="fas fa-check-circle"></i>Weekly Digest</span>
          <span><i class="fas fa-check-circle"></i>No Spam</span>
          <span><i class="fas fa-check-circle"></i>Unsubscribe Anytime</span>
        </div>
      </div>
      <div class="newsletter-right">
        <form onsubmit="return handleNewsletter(event)">
          <div class="newsletter-input-wrap">
            <i class="fas fa-envelope"></i>
            <input type="email" id="newsletterEmail" placeholder="your@email.com" required>
          </div>
          <button type="submit" class="newsletter-btn">
            <i class="fas fa-paper-plane me-2"></i>Subscribe Now
          </button>
          <p class="newsletter-privacy"><i class="fas fa-shield-alt me-1"></i>We respect your privacy</p>
        </form>
      </div>
    </div>
  </div>
</section> -->

<style>
.newsletter-new {
  padding: 80px 0;
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}
.newsletter-card {
  background: white;
  border-radius: 24px;
  padding: 50px;
  display: flex;
  align-items: center;
  gap: 60px;
  box-shadow: 0 20px 60px rgba(0,0,0,0.08);
  border: 1px solid rgba(99, 102, 241, 0.1);
}
.newsletter-left {
  flex: 1;
}
.newsletter-icon-wrap {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 20px;
}
.newsletter-icon-wrap i {
  font-size: 1.8rem;
  color: white;
}
.newsletter-left h3 {
  font-size: 2rem;
  font-weight: 800;
  color: #1e293b;
  margin-bottom: 10px;
}
.newsletter-left p {
  color: #64748b;
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 20px;
}
.newsletter-benefits {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}
.newsletter-benefits span {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #22c55e;
  font-weight: 600;
  font-size: 0.9rem;
}
.newsletter-right {
  flex: 0 0 350px;
}
.newsletter-input-wrap {
  position: relative;
  margin-bottom: 15px;
}
.newsletter-input-wrap i {
  position: absolute;
  left: 18px;
  top: 50%;
  transform: translateY(-50%);
  color: #6366f1;
}
.newsletter-input-wrap input {
  width: 100%;
  padding: 18px 18px 18px 50px;
  border: 2px solid #e5e7eb;
  border-radius: 14px;
  font-size: 1rem;
  transition: all 0.3s;
}
.newsletter-input-wrap input:focus {
  border-color: #6366f1;
  outline: none;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}
.newsletter-btn {
  width: 100%;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: white;
  border: none;
  padding: 18px;
  border-radius: 14px;
  font-weight: 700;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.3s;
}
.newsletter-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(99, 102, 241, 0.35);
}
.newsletter-privacy {
  text-align: center;
  color: #94a3b8;
  font-size: 0.85rem;
  margin-top: 15px;
  margin-bottom: 0;
}
@media (max-width: 991px) {
  .newsletter-card {
    flex-direction: column;
    padding: 35px;
    gap: 30px;
  }
  .newsletter-right { flex: 1; width: 100%; }
  .newsletter-left h3 { font-size: 1.5rem; }
}
</style>

<footer class="footer-new">
  <div class="footer-wave">
    <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0 50L48 45C96 40 192 30 288 35C384 40 480 60 576 65C672 70 768 60 864 50C960 40 1056 30 1152 35C1248 40 1344 60 1392 70L1440 80V100H0V50Z" fill="currentColor"/>
    </svg>
  </div>
  
  <div class="footer-content">
    <div class="container">
      <div class="row g-4">
        <!-- Brand Column -->
        <div class="col-lg-4 col-md-6">
          <div class="footer-brand">
            <div class="brand-logo">
              <i class="fas fa-city"></i>
              <span>Smart City</span>
            </div>
            <p>Empowering citizens to build better communities through transparent civic engagement and rapid issue resolution.</p>
            <div class="footer-stats">
              <div class="stat"><strong>8</strong><span>Categories</span></div>
              <div class="stat"><strong>99%</strong><span>Uptime</span></div>
              <div class="stat"><strong>24/7</strong><span>Support</span></div>
            </div>
          </div>
        </div>
        
        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5>Quick Links</h5>
          <ul class="footer-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="feedback.php">Feedback</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin/admin_login.php">Admin</a></li>
          </ul>
        </div>
        
        <!-- Resources -->
        <div class="col-lg-2 col-md-6 col-6">
          <h5>Resources</h5>
          <ul class="footer-links">
            <li><a href="terms.php">Terms of Service</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="guidelines.php">Guidelines</a></li>
            <li><a href="help.php">Help & FAQs</a></li>
          </ul>
        </div>
        
        <!-- Contact -->
        <div class="col-lg-4 col-md-6">
          <h5>Get In Touch</h5>
          <div class="contact-cards">
            <a href="mailto:support@smartcity.gov.in" class="contact-card">
              <i class="fas fa-envelope"></i>
              <span>tejaschaudhari976@gmail.com</span>
            </a>
            <a href="tel:+919876543210" class="contact-card">
              <i class="fas fa-phone-alt"></i>
              <span>+91 88068 85738</span>
            </a>
          </div>
          <div class="social-links">
            <a href="https://facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://linkedin.com/company/smartcityportal" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <a href="https://youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="footer-bottom-new">
    <div class="container">
      <p>&copy; <?= date('Y') ?> Smart City Portal. Made with <i class="fas fa-heart"></i> by <strong>Tejas Chaudhari</strong></p>
    </div>
  </div>
</footer>

<style>
.footer-new {
  background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
  position: relative;
  overflow: hidden;
}
.footer-wave {
  color: #f8fafc;
  margin-bottom: -5px;
}
.footer-wave svg {
  width: 100%;
  height: auto;
}
.footer-content {
  padding: 60px 0 40px;
}
.footer-brand .brand-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 20px;
}
.footer-brand .brand-logo i {
  font-size: 2.5rem;
  background: linear-gradient(135deg, #818cf8, #c084fc);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.footer-brand .brand-logo span {
  font-size: 1.8rem;
  font-weight: 800;
  color: white;
}
.footer-brand p {
  color: #a5b4fc;
  line-height: 1.7;
  margin-bottom: 25px;
}
.footer-stats {
  display: flex;
  gap: 25px;
}
.footer-stats .stat {
  text-align: center;
}
.footer-stats .stat strong {
  display: block;
  font-size: 1.5rem;
  color: white;
  font-weight: 800;
}
.footer-stats .stat span {
  font-size: 0.8rem;
  color: #a5b4fc;
}
.footer-new h5 {
  color: white;
  font-weight: 700;
  font-size: 1.1rem;
  margin-bottom: 20px;
  position: relative;
  padding-bottom: 10px;
}
.footer-new h5::after {
  content: '';
  position: absolute;
  left: 0;
  bottom: 0;
  width: 30px;
  height: 3px;
  background: linear-gradient(90deg, #818cf8, #c084fc);
  border-radius: 2px;
}
.footer-links {
  list-style: none;
  padding: 0;
  margin: 0;
}
.footer-links li {
  margin-bottom: 12px;
}
.footer-links a {
  color: #a5b4fc;
  text-decoration: none;
  transition: all 0.3s;
  display: inline-flex;
  align-items: center;
}
.footer-links a::before {
  content: '→';
  margin-right: 8px;
  opacity: 0;
  transform: translateX(-10px);
  transition: all 0.3s;
}
.footer-links a:hover {
  color: white;
  padding-left: 5px;
}
.footer-links a:hover::before {
  opacity: 1;
  transform: translateX(0);
}
.contact-cards {
  display: flex;
  flex-direction: column;
  gap: 12px;
  margin-bottom: 20px;
}
.contact-card {
  display: flex;
  align-items: center;
  gap: 12px;
  background: rgba(255,255,255,0.08);
  padding: 12px 16px;
  border-radius: 10px;
  color: #c7d2fe;
  text-decoration: none;
  transition: all 0.3s;
  border: 1px solid rgba(255,255,255,0.1);
}
.contact-card:hover {
  background: rgba(255,255,255,0.15);
  color: white;
  transform: translateX(5px);
}
.contact-card i {
  font-size: 1rem;
  color: #818cf8;
}
.social-links {
  display: flex;
  gap: 12px;
}
.social-links a {
  width: 42px;
  height: 42px;
  background: rgba(255,255,255,0.1);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #a5b4fc;
  text-decoration: none;
  transition: all 0.3s;
}
.social-links a:hover {
  background: linear-gradient(135deg, #818cf8, #c084fc);
  color: white;
  transform: translateY(-3px);
}
.footer-bottom-new {
  background: rgba(0,0,0,0.2);
  padding: 20px 0;
  text-align: center;
}
.footer-bottom-new p {
  color: #a5b4fc;
  margin: 0;
  font-size: 0.9rem;
}
.footer-bottom-new i.fa-heart {
  color: #f43f5e;
  animation: heartbeat 1.5s infinite;
}
@keyframes heartbeat {
  0%, 100% { transform: scale(1); }
  50% { transform: scale(1.2); }
}
@media (max-width: 991px) {
  .footer-stats { justify-content: flex-start; }
}
</style>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" onclick="scrollToTop()" title="Back to Top" aria-label="Scroll back to top of page">
  <i class="fas fa-arrow-up" aria-hidden="true"></i>
</button>

<script src="assets/js/common.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>
</html>
