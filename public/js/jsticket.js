// Ticket Table Interactions
document.addEventListener('DOMContentLoaded', function() {
    // Sélection globale des tickets
    const selectAll = document.querySelector('thead .checkbox-modern');
    const checkboxes = document.querySelectorAll('tbody .checkbox-modern');

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
                updateRowSelection(checkbox.closest('tr'), this.checked);
            });
            updateDeleteButton();
        });
    }

    // Sélection individuelle
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateRowSelection(this.closest('tr'), this.checked);
            updateSelectAllState();
            updateDeleteButton();
        });
    });

    function updateRowSelection(row, isSelected) {
        if (isSelected) {
            row.style.backgroundColor = '#f0f4ff';
            row.classList.add('selected');
        } else {
            row.style.backgroundColor = '';
            row.classList.remove('selected');
        }
    }

    function updateSelectAllState() {
        if (!selectAll) return;

        const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);
        selectAll.checked = checkedBoxes.length === checkboxes.length;
        selectAll.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < checkboxes.length;
    }

    function updateDeleteButton() {
        const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        const deleteBtn = document.querySelector('.btn-modern.secondary');

        if (deleteBtn) {
            if (checkedCount > 0) {
                deleteBtn.innerHTML = `
                    <i class="fas fa-trash"></i>
                    Supprimer (${checkedCount})
                `;
            } else {
                deleteBtn.innerHTML = `
                    <i class="fas fa-download"></i>
                    Exporter
                `;
            }
        }
    }

    // Animation au survol des lignes
    const rows = document.querySelectorAll('.modern-table tbody tr');
    rows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Recherche en temps réel
    const searchInput = document.querySelector('.search-box input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    }

    // Actions des boutons
    const viewButtons = document.querySelectorAll('.btn-view');
    const editButtons = document.querySelectorAll('.btn-edit');
    const deleteButtons = document.querySelectorAll('.btn-delete');

    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const ticketId = this.closest('tr').querySelector('td:nth-child(2)').textContent;
            console.log('Voir ticket:', ticketId);
            // Livewire.emit('viewTicket', ticketId);
        });
    });

    editButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const ticketId = this.closest('tr').querySelector('td:nth-child(2)').textContent;
            console.log('Éditer ticket:', ticketId);
            // Livewire.emit('editTicket', ticketId);
        });
    });

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const ticketId = this.closest('tr').querySelector('td:nth-child(2)').textContent;
            if (confirm(`Voulez-vous vraiment supprimer le ticket ${ticketId} ?`)) {
                console.log('Supprimer ticket:', ticketId);
                // Livewire.emit('deleteTicket', ticketId);
            }
        });
    });
});

// Livewire specific handlers
document.addEventListener('livewire:load', function() {
    // Réinitialiser la sélection quand les données changent
    Livewire.hook('message.processed', (message, component) => {
        if (message.updateQueue[0]?.payload?.name === 'tickets') {
            const selectAll = document.querySelector('thead .checkbox-modern');
            if (selectAll) {
                selectAll.checked = false;
                selectAll.indeterminate = false;
            }
        }
    });
});
