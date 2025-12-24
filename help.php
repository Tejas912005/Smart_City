<?php include 'header.php'; ?>

<main class="container my-5">
  <div class="policy-page animate-up">
    <div class="policy-header">
      <i class="fas fa-question-circle"></i>
      <h1>Help & FAQs</h1>
      <p>Find answers to commonly asked questions</p>
    </div>

    <div class="policy-content">
      <div class="faq-search mb-4">
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-search"></i></span>
          <input type="text" class="form-control" id="faqSearch" placeholder="Search FAQs..." oninput="filterFAQs()">
        </div>
      </div>

      <div class="accordion" id="faqAccordion">
        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>How do I submit a report?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>To submit a report:</p>
            <ol>
              <li>Login to your account (or register if you're new)</li>
              <li>Click "Report an Issue" on the home page</li>
              <li>Select a category and describe the issue</li>
              <li>Upload photos and provide location details</li>
              <li>Click Submit!</li>
            </ol>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>How can I track my report status?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Go to your Dashboard to see all your submitted reports. Each report shows its current status: Pending, In Progress, or Resolved. You'll also receive email notifications when the status changes.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>How long does it take to resolve an issue?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Resolution time depends on the issue type:</p>
            <ul>
              <li><strong>Minor issues</strong> (garbage, street lights): 3-7 days</li>
              <li><strong>Medium issues</strong> (potholes, drainage): 1-2 weeks</li>
              <li><strong>Major issues</strong> (road repairs): 2-4 weeks or more</li>
            </ul>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>Can I edit or delete my report?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Currently, you cannot edit reports after submission to maintain integrity. If you need to add information, submit a new report. Contact support if a report was submitted in error.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>Is my personal information safe?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Yes! We take privacy seriously. Your personal data is encrypted and only shared with relevant authorities to resolve your reports. Read our <a href="privacy.php">Privacy Policy</a> for details.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>What if my issue isn't resolved?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>If your report hasn't been addressed within the expected timeframe:</p>
            <ol>
              <li>Check your dashboard for any updates</li>
              <li>Use the feedback form to escalate</li>
              <li>Contact our support team directly</li>
            </ol>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>How do I reset my password?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Click "Forgot Password" on the login page, enter your email, and follow the reset link sent to your inbox.</p>
          </div>
        </div>

        <div class="faq-item">
          <button class="faq-question" onclick="toggleFaq(this)">
            <span>Can I report anonymously?</span>
            <i class="fas fa-chevron-down"></i>
          </button>
          <div class="faq-answer">
            <p>Currently, an account is required to submit reports. This helps us communicate updates and prevents spam. Your identity is kept confidential from the public.</p>
          </div>
        </div>
      </div>

      <div class="contact-support mt-5 text-center">
        <h3>Still need help?</h3>
        <p>Our support team is here to assist you</p>
        <a href="contact.php" class="btn btn-primary">
          <i class="fas fa-headset me-2"></i>Contact Support
        </a>
      </div>
    </div>
  </div>
</main>

<style>
.policy-page { max-width: 800px; margin: 0 auto; }
.policy-header { text-align: center; margin-bottom: 40px; }
.policy-header i { font-size: 3rem; color: #6366f1; margin-bottom: 15px; }
.policy-header h1 { font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 10px; }
.policy-header p { color: #64748b; }
.policy-content { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); }
.faq-search .input-group-text { background: #f8fafc; border-right: none; }
.faq-search input { border-left: none; }
.faq-search input:focus { box-shadow: none; border-color: #e5e7eb; }
.faq-item { border: 1px solid #e5e7eb; border-radius: 12px; margin-bottom: 15px; overflow: hidden; }
.faq-question { width: 100%; background: #f8fafc; border: none; padding: 20px; text-align: left; display: flex; justify-content: space-between; align-items: center; cursor: pointer; transition: all 0.3s; }
.faq-question:hover { background: #f1f5f9; }
.faq-question span { font-weight: 600; color: #1e293b; font-size: 1rem; }
.faq-question i { color: #6366f1; transition: transform 0.3s; }
.faq-question.active i { transform: rotate(180deg); }
.faq-answer { padding: 0 20px; max-height: 0; overflow: hidden; transition: all 0.3s; background: white; }
.faq-answer.show { padding: 20px; max-height: 500px; }
.faq-answer p, .faq-answer li { color: #475569; line-height: 1.7; }
.faq-answer a { color: #6366f1; font-weight: 600; }
.contact-support h3 { font-weight: 700; color: #1e293b; }
.contact-support p { color: #64748b; margin-bottom: 20px; }
</style>

<script>
function toggleFaq(btn) {
  const answer = btn.nextElementSibling;
  const isOpen = answer.classList.contains('show');
  
  // Close all
  document.querySelectorAll('.faq-answer').forEach(a => a.classList.remove('show'));
  document.querySelectorAll('.faq-question').forEach(q => q.classList.remove('active'));
  
  // Open clicked if was closed
  if (!isOpen) {
    answer.classList.add('show');
    btn.classList.add('active');
  }
}

function filterFAQs() {
  const search = document.getElementById('faqSearch').value.toLowerCase();
  document.querySelectorAll('.faq-item').forEach(item => {
    const text = item.textContent.toLowerCase();
    item.style.display = text.includes(search) ? 'block' : 'none';
  });
}
</script>

<?php include 'footer.php'; ?>
