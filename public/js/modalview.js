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