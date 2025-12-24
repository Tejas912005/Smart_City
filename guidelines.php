<?php include 'header.php'; ?>

<main class="container my-5">
  <div class="policy-page animate-up">
    <div class="policy-header">
      <i class="fas fa-clipboard-list"></i>
      <h1>Report Guidelines</h1>
      <p>How to submit effective civic issue reports</p>
    </div>

    <div class="policy-content">
      <section>
        <h2><i class="fas fa-check-circle text-success me-2"></i>What You Can Report</h2>
        <div class="guidelines-grid">
          <div class="guideline-item">
            <i class="fas fa-road"></i>
            <h4>Roads & Potholes</h4>
            <p>Damaged roads, potholes, broken footpaths</p>
          </div>
          <div class="guideline-item">
            <i class="fas fa-lightbulb"></i>
            <h4>Street Lights</h4>
            <p>Non-working, flickering, or damaged lights</p>
          </div>
          <div class="guideline-item">
            <i class="fas fa-trash-alt"></i>
            <h4>Garbage</h4>
            <p>Uncollected waste, illegal dumping</p>
          </div>
          <div class="guideline-item">
            <i class="fas fa-water"></i>
            <h4>Drainage</h4>
            <p>Blocked drains, waterlogging, sewage issues</p>
          </div>
          <div class="guideline-item">
            <i class="fas fa-tree"></i>
            <h4>Parks</h4>
            <p>Damaged equipment, overgrown areas, safety issues</p>
          </div>
          <div class="guideline-item">
            <i class="fas fa-tint"></i>
            <h4>Water Supply</h4>
            <p>Leakages, low pressure, contamination</p>
          </div>
        </div>
      </section>

      <section>
        <h2><i class="fas fa-camera text-primary me-2"></i>How to Submit a Good Report</h2>
        <ol class="steps-list">
          <li>
            <strong>Take Clear Photos</strong>
            <p>Capture the issue clearly in daylight. Multiple angles help!</p>
          </li>
          <li>
            <strong>Provide Exact Location</strong>
            <p>Include nearby landmarks, street names, or use the map feature.</p>
          </li>
          <li>
            <strong>Write Clear Description</strong>
            <p>Explain what the issue is, how long it's been there, and its impact.</p>
          </li>
          <li>
            <strong>Select Correct Category</strong>
            <p>Choose the most appropriate category for faster routing.</p>
          </li>
        </ol>
      </section>

      <section>
        <h2><i class="fas fa-times-circle text-danger me-2"></i>What NOT to Report</h2>
        <ul class="not-allowed-list">
          <li>Personal disputes or legal matters</li>
          <li>Issues on private property</li>
          <li>Emergency situations (call 112 instead)</li>
          <li>Complaints about individuals</li>
          <li>Commercial or advertising content</li>
        </ul>
      </section>

      <section>
        <h2><i class="fas fa-clock text-warning me-2"></i>Response Time</h2>
        <p>After submitting a report:</p>
        <ul>
          <li><strong>24-48 hours:</strong> Report is reviewed and assigned</li>
          <li><strong>3-7 days:</strong> Initial response for most issues</li>
          <li><strong>1-4 weeks:</strong> Resolution for standard issues</li>
          <li><strong>Varies:</strong> Major infrastructure may take longer</li>
        </ul>
      </section>
    </div>
  </div>
</main>

<style>
.policy-page { max-width: 900px; margin: 0 auto; }
.policy-header { text-align: center; margin-bottom: 40px; }
.policy-header i { font-size: 3rem; color: #6366f1; margin-bottom: 15px; }
.policy-header h1 { font-size: 2.5rem; font-weight: 800; color: #1e293b; margin-bottom: 10px; }
.policy-header p { color: #64748b; }
.policy-content { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); }
.policy-content section { margin-bottom: 30px; padding-bottom: 30px; border-bottom: 1px solid #e5e7eb; }
.policy-content section:last-child { margin-bottom: 0; padding-bottom: 0; border-bottom: none; }
.policy-content h2 { font-size: 1.3rem; font-weight: 700; color: #1e293b; margin-bottom: 20px; }
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

<?php include 'footer.php'; ?>
