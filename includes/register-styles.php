<style>
.auth-form .form-group { margin-bottom: 18px; }
.auth-btn { text-decoration: none; }
.auth-btn:hover { color: white; }
.register-icon {
  background: linear-gradient(135deg, #22c55e, #16a34a);
}
.strength-bar {
  height: 5px;
  background: #e5e7eb;
  border-radius: 5px;
  margin-top: 8px;
  overflow: hidden;
}
.strength-fill {
  height: 100%;
  width: 0;
  transition: all 0.3s;
  border-radius: 5px;
}
.strength-text {
  font-size: 0.8rem;
  font-weight: 600;
  margin-top: 5px;
  display: block;
}
.success-card {
  text-align: center;
  padding: 50px 40px;
}
.success-animation {
  margin-bottom: 25px;
}
.checkmark-circle {
  width: 90px;
  height: 90px;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
  animation: scaleIn 0.5s ease, pulse 2s infinite;
}
.checkmark-circle i {
  font-size: 2.5rem;
  color: white;
}
@keyframes scaleIn {
  0% { transform: scale(0); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}
@keyframes pulse {
  0%, 100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.4); }
  50% { box-shadow: 0 0 0 15px rgba(34, 197, 94, 0); }
}
.success-card h1 {
  font-size: 1.6rem;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 10px;
}
.success-card > p {
  color: #64748b;
  margin-bottom: 25px;
}
.success-features {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin-bottom: 30px;
}
.success-features .feature {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
}
.success-features .feature i {
  font-size: 1.4rem;
  color: #6366f1;
}
.success-features .feature span {
  font-size: 0.85rem;
  font-weight: 600;
  color: #64748b;
}
.back-home {
  display: block;
  margin-top: 15px;
  color: #64748b;
  font-size: 0.9rem;
  text-decoration: none;
}
.back-home:hover {
  color: #6366f1;
}
@media (max-width: 576px) {
  .success-features { gap: 15px; }
}
</style>
