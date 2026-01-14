document.addEventListener('DOMContentLoaded', () => {
    // ----------- USER SEARCH DROPDOWN -----------
    const searchInput = document.getElementById('user-search');
    const dropdown = document.getElementById('userDropdown');

    if (searchInput && dropdown) {
        searchInput.addEventListener('focus', () => dropdown.classList.add('show'));

        searchInput.addEventListener('input', () => {
            const q = searchInput.value.toLowerCase();
            dropdown.querySelectorAll('.dropdown-item').forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(q) ? 'flex' : 'none';
            });
        });

        dropdown.addEventListener('click', e => {
            const item = e.target.closest('.dropdown-item');
            if (!item) return;
            window.location = `checklist.php?user_id=${item.dataset.id}`;
        });

        document.addEventListener('click', e => {
            if (!e.target.closest('.user-select')) {
                dropdown.classList.remove('show');
            }
        });
    }

    // ----------- TASK CRUD -----------
    const taskSection = document.getElementById('taskSection');
    if (!taskSection) return;

    const userId = taskSection.dataset.userId;
    const checklistId = taskSection.dataset.checklistId;

    // ADD TASK
    const addBtn = document.getElementById('addTaskBtn'); // corrected ID
    if (addBtn) {
        addBtn.addEventListener('click', async () => {
            const title = prompt('Nieuwe taak:');
            if (!title) return;

            await fetch('../api/task_create.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ checklist_id: checklistId, title })
            });
            location.reload();
        });
    }

    // EDIT + DELETE
    taskSection.addEventListener('click', async e => {
        const task = e.target.closest('.task-item');
        if (!task) return;
        const taskId = task.dataset.id;

        // DELETE
        if (e.target.closest('.delete')) {
            if (!confirm('Weet je zeker dat je deze taak wilt verwijderen?')) return;

            await fetch('../api/task_delete.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ id: taskId })
            });
            task.remove();
        }

        // EDIT
        if (e.target.closest('.edit')) {
            const p = task.querySelector('p.task-title');
            const newTitle = prompt('Taak aanpassen:', p.innerText);
            if (!newTitle) return;

            await fetch('../api/task_update.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({ id: taskId, title: newTitle })
            });
            p.innerText = newTitle;
        }
    });

    // TOGGLE COMPLETED
    taskSection.addEventListener('change', async e => {
        const task = e.target.closest('.task-item');
        if (!task || !e.target.classList.contains('task-complete')) return;

        const taskId = task.dataset.id;
        const completed = e.target.checked ? 1 : 0;

        await fetch('../api/task_toggle.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ user_id: userId, task_id: taskId, completed })
        });
    });
});
