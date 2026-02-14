<style>
.auth-page {
  background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  min-height: 100vh;
  padding-top: 80px;
}
.auth-card {
  background: white;
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}
.auth-header {
  text-align: center;
  margin-bottom: 30px;
}
.auth-icon {
  width: 70px;
  height: 70px;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  font-size: 1.8rem;
  color: white;
}
.auth-header h1 {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 5px;
}
.auth-header p {
  color: #64748b;
  font-size: 0.9rem;
}
.auth-alert {
  padding: 12px 16px;
  border-radius: 10px;
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 0.9rem;
}
.auth-alert.error {
  background: #fef2f2;
  color: #dc2626;
  border: 1px solid #fecaca;
}
.auth-form .form-group {
  margin-bottom: 20px;
}
.auth-form label {
  display: block;
  font-weight: 600;
  color: #374151;
  margin-bottom: 8px;
  font-size: 0.9rem;
}
.input-wrapper {
  position: relative;
  display: flex;
  align-items: center;
}
.input-wrapper > i:first-child {
  position: absolute;
  left: 16px;
  color: #6366f1;
  font-size: 1rem;
}
.input-wrapper input {
  width: 100%;
  padding: 14px 45px;
  border: 2px solid #e5e7eb;
  border-radius: 12px;
  font-size: 1rem;
  transition: all 0.3s;
  background: #f9fafb;
}
.input-wrapper input:focus {
  border-color: #6366f1;
  background: white;
  outline: none;
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
}
.toggle-btn {
  position: absolute;
  right: 12px;
  background: none;
  border: none;
  color: #9ca3af;
  cursor: pointer;
  padding: 5px;
}
.toggle-btn:hover {
  color: #6366f1;
}
.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}
.remember-me {
  display: flex;
  align-items: center;
  gap: 8px;
  color: #64748b;
  font-size: 0.9rem;
  cursor: pointer;
}
.remember-me input {
  accent-color: #6366f1;
}
.forgot-link {
  color: #6366f1;
  font-size: 0.9rem;
  font-weight: 500;
  text-decoration: none;
}
.forgot-link:hover {
  text-decoration: underline;
}
.auth-btn {
  width: 100%;
  padding: 14px;
  border: none;
  border-radius: 12px;
  font-size: 1rem;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  cursor: pointer;
  transition: all 0.3s;
  background: linear-gradient(135deg, #6366f1, #8b5cf6);
  color: white;
}
.auth-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 25px rgba(99, 102, 241, 0.35);
}
.auth-footer {
  text-align: center;
  margin-top: 25px;
  padding-top: 25px;
  border-top: 1px solid #e5e7eb;
}
.auth-footer p {
  color: #64748b;
  font-size: 0.95rem;
}
.auth-footer a {
  color: #6366f1;
  font-weight: 600;
  text-decoration: none;
}
.auth-footer a:hover {
  text-decoration: underline;
}
.animate-up {
  animation: slideUp 0.5s ease;
}
@keyframes slideUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
@media (max-width: 576px) {
  .auth-card { padding: 30px 25px; }
}
</style>
