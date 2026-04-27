document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('studentForm');
    if(form) {
        form.addEventListener('submit', function(e) {
            if(document.getElementById('nom').value.trim() === "" || document.getElementById('prenom').value.trim() === "") {
                e.preventDefault();
                alert("Veuillez remplir tous les champs.");
            }
        });
    }
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.onclick = (e) => { if(!confirm("Supprimer ?")) e.preventDefault(); };
    });
});


