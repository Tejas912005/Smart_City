/**
 * Smart City Portal - Shared JavaScript
 * Used by login, register, footer, help pages
 */

function togglePass(id) {
  var input = document.getElementById(id);
  var icon = input.nextElementSibling.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('fa-eye', 'fa-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.replace('fa-eye-slash', 'fa-eye');
  }
}

function checkStrength(password) {
  var fill = document.getElementById('strengthFill');
  var text = document.getElementById('strengthText');
  if (!fill || !text) return;
  var strength = 0;
  if (password.length >= 8) strength++;
  if (password.match(/[a-z]/)) strength++;
  if (password.match(/[A-Z]/)) strength++;
  if (password.match(/[0-9]/)) strength++;
  if (password.match(/[^a-zA-Z0-9]/)) strength++;
  var levels = [
    { text: '', color: '#e5e7eb', width: 0 },
    { text: 'Weak', color: '#ef4444', width: 25 },
    { text: 'Fair', color: '#f59e0b', width: 50 },
    { text: 'Good', color: '#84cc16', width: 75 },
    { text: 'Strong', color: '#22c55e', width: 100 }
  ];
  var level = levels[Math.min(strength, 4)];
  fill.style.width = level.width + '%';
  fill.style.backgroundColor = level.color;
  text.textContent = password.length > 0 ? level.text : '';
  text.style.color = level.color;
}

function handleNewsletter(e) {
  e.preventDefault();
  var email = document.getElementById('newsletterEmail');
  if (email) {
    alert('Thank you for subscribing with: ' + email.value + '\nWe\'ll keep you updated!');
    email.value = '';
  }
  return false;
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function toggleFaq(btn) {
  var answer = btn.nextElementSibling;
  var isOpen = answer.classList.contains('show');
  document.querySelectorAll('.faq-answer').forEach(function(a) { a.classList.remove('show'); });
  document.querySelectorAll('.faq-question').forEach(function(q) { q.classList.remove('active'); });
  if (!isOpen) {
    answer.classList.add('show');
    btn.classList.add('active');
  }
}

function filterFAQs() {
  var search = document.getElementById('faqSearch');
  if (!search) return;
  var val = search.value.toLowerCase();
  document.querySelectorAll('.faq-item').forEach(function(item) {
    item.style.display = item.textContent.toLowerCase().indexOf(val) !== -1 ? 'block' : 'none';
  });
}

document.addEventListener('DOMContentLoaded', function() {
  var backToTop = document.getElementById('backToTop');
  if (backToTop) {
    window.onscroll = function() {
      if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
        backToTop.classList.add('show');
      } else {
        backToTop.classList.remove('show');
      }
    };
  }
});
