<style>
.policy-page { max-width: 900px; margin: 0 auto; }
.policy-content h2 { margin-bottom: 20px; }
.guidelines-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
.guideline-item { background: #f8fafc; border-radius: 12px; padding: 20px; text-align: center; }
.guideline-item i { font-size: 2rem; color: #6366f1; margin-bottom: 10px; }
.guideline-item h4 { font-size: 1rem; font-weight: 700; color: #1e293b; margin-bottom: 5px; }
.guideline-item p { font-size: 0.85rem; color: #64748b; margin: 0; }
.steps-list { counter-reset: step; list-style: none; padding: 0; }
.steps-list li { position: relative; padding-left: 60px; margin-bottom: 25px; }
.steps-list li::before { content: counter(step); counter-increment: step; position: absolute; left: 0; top: 0; width: 40px; height: 40px; background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; }
.steps-list li strong { display: block; font-size: 1.1rem; color: #1e293b; margin-bottom: 5px; }
.steps-list li p { color: #64748b; margin: 0; }
.not-allowed-list { list-style: none; padding: 0; }
.not-allowed-list li { padding: 12px 15px; background: #fef2f2; border-radius: 8px; margin-bottom: 10px; color: #dc2626; display: flex; align-items: center; }
.not-allowed-list li::before { content: "✕"; margin-right: 10px; font-weight: 700; }
</style>
