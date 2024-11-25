// EmailJS initialization
(function () {
    emailjs.init({
        publicKey: "gc_x1ML7SQHlDcNnk",
      }); // Remplacez par votre User ID EmailJS
  })();
  
  const participants = [];
  
  document.getElementById('add-participant').addEventListener('click', () => {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
  
    if (name && email) {
      participants.push({ name, email });
      updateParticipantsList();
      document.getElementById('name').value = '';
      document.getElementById('email').value = '';
    } else {
      alert('Veuillez remplir les deux champs.');
    }
  });
  
  document.getElementById('generate').addEventListener('click', () => {
    if (participants.length < 7) {
      alert('Ajoutez au moins deux participants.');
      return;
    }
  
    const shuffled = [...participants].sort(() => Math.random() - 0.5);
    const pairs = shuffled.map((participant, index) => {
      const receiver = shuffled[(index + 1) % shuffled.length];
      return { giver: participant, receiver };
    });
  
    sendEmails(pairs);
    displayResults(pairs);
  });
  
  function updateParticipantsList() {
    const list = document.getElementById('participants');
    list.innerHTML = participants
      .map(participant => `<li>${participant.name} (${participant.email})</li>`)
      .join('');
  }
  
  function displayResults(pairs) {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = '<h3>Résultats :</h3>';
    pairs.forEach(pair => {
      resultDiv.innerHTML += `<p>${pair.giver.name} offrira un cadeau à ${pair.receiver.name}</p>`;
    });
  }
  
  function sendEmails(pairs) {
    const emailStatus = document.getElementById('email-status');
    emailStatus.textContent = 'Envoi des e-mails en cours...';
  
    let emailsSent = 0;
  
    pairs.forEach(pair => {
      const { giver, receiver } = pair;
  
      const templateParams = {
        giver_name: giver.name,
        receiver_name: receiver.name,
        receiver_email: receiver.email,
      };
  
      emailjs
        .send('service_twx9mic', 'template_mwyqaua', templateParams)
        .then(
          response => {
            emailsSent++;
            if (emailsSent === pairs.length) {
              emailStatus.textContent = 'Tous les e-mails ont été envoyés avec succès ! 🎉';
            }
          },
          error => {
            emailStatus.textContent = 'Une erreur est survenue lors de l’envoi des e-mails. Veuillez réessayer.';
            console.error('Échec de l’envoi de l’e-mail :', error);
          }
        );
    });
  }
  