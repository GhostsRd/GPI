   // JS pour changer l'étape active
      const steps = document.querySelectorAll('.step');
      const connectors = document.querySelectorAll('.connector .fill');
      let currentIndex = 0;

     // function updateSteps() {
     //   steps.forEach((step, i) => {
      //    step.classList.remove('past', 'current', 'future');
       //   if (i < currentIndex) step.classList.add('past');
        //  else if (i === currentIndex) step.classList.add('current');
         // else step.classList.add('future');
        //});

       // const pct = currentIndex / (steps.length - 1) * 100;
       // connectors.forEach(c => c.style.width = pct + '%');
      //}
   const canvas = document.getElementById('parallaxCanvas');
const ctx = canvas.getContext('2d');
let particles = [];

function initParticles() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  particles = [];
  for (let i = 0; i < 100; i++) {
    particles.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      r: Math.random() * 3 + 1,
      dx: (Math.random() - 0.5) * 0.5,
      dy: (Math.random() - 0.5) * 0.5
    });
  }
}
function animate() {
  ctx.clearRect(0,0,canvas.width, canvas.height);
  particles.forEach(p => {
    ctx.beginPath();
    ctx.arc(p.x, p.y, p.r, 0, Math.PI*2);
    ctx.fillStyle = 'rgba(255,255,255,0.6)';
    ctx.fill();
    p.x += p.dx;
    p.y += p.dy;

    if (p.x > canvas.width) p.x = 0;
    if (p.x < 0) p.x = canvas.width;
    if (p.y > canvas.height) p.y = 0;
    if (p.y < 0) p.y = canvas.height;
  });
  requestAnimationFrame(animate);
}
window.addEventListener('resize', initParticles);
initParticles();
animate();

      document.getElementById('nextBtn').addEventListener('click', () => {
        if (currentIndex < steps.length - 1) currentIndex++;
        updateSteps();
      });
      document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentIndex > 0) currentIndex--;
        updateSteps();
      });

      // Cliquer sur un step pour sauter
     // steps.forEach(step => {
      //  step.addEventListener('click', () => {
      //    currentIndex = parseInt(step.dataset.index);
      //    updateSteps();
      //  });
     // });

      updateSteps();



    // 🎬 Animation : progression auto du ticket
    const stepss = document.querySelectorAll(".timeline-step");
    let current = 0;

    function nextStep() {
      if (current < stepss.length) {
        stepss[current].classList.add("complete");
        if (stepss[current + 1]) stepss[current + 1].classList.add("active");
        current++;
      }
    }

    // Simulation automatique (tu peux relier ça à ton backend plus tard)
    setInterval(nextStep, 4000);
