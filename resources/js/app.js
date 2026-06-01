import './bootstrap';

const calculator = document.querySelector('[data-calculator]');
if (calculator) {
  const service = calculator.querySelector('[name="service"]');
  const timeline = calculator.querySelector('[name="timeline_weeks"]');
  const pages = calculator.querySelector('[name="pages"]');
  const features = calculator.querySelectorAll('[name="features[]"]');
  const output = document.querySelector('[data-price-output]');
  const advance = document.querySelector('[data-advance-output]');
  const baseMap = {
    'Custom Web Application': 180000,
    'Mobile App Development': 240000,
    'CRM / ERP Solution': 320000,
    'SaaS Product MVP': 420000,
    'Website & Landing System': 120000,
  };
  const money = new Intl.NumberFormat('en-IN', { style: 'currency', currency: 'INR', maximumFractionDigits: 0 });
  const recalc = () => {
    const selected = Array.from(features).filter((item) => item.checked).length;
    const base = baseMap[service.value] || 120000;
    let estimate = base + selected * 35000 + Number(pages.value || 1) * 5000;
    if (Number(timeline.value || 5) <= 4) estimate *= 1.15;
    output.textContent = money.format(estimate);
    advance.textContent = money.format(Math.ceil(estimate * 0.3));
  };
  calculator.addEventListener('input', recalc);
  recalc();
}
