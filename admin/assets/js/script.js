document.addEventListener('DOMContentLoaded', function () {
  // Confirm before any delete link/button
  document.querySelectorAll('.confirm-delete').forEach(function (el) {
    el.addEventListener('click', function (e) {
      if (!confirm('Are you sure you want to delete this? This cannot be undone.')) {
        e.preventDefault();
      }
    });
  });

  // Repeatable input rows (project goals / results)
  document.querySelectorAll('[data-repeat-add]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var listId = btn.getAttribute('data-repeat-add');
      var list = document.getElementById(listId);
      var row = document.createElement('div');
      row.className = 'repeat-row';
      row.innerHTML = '<input type="text" name="' + btn.getAttribute('data-name') + '[]" placeholder="' + btn.getAttribute('data-placeholder') + '">' +
        '<button type="button" class="btn btn-outline btn-sm remove-row">&times;</button>';
      list.appendChild(row);
    });
  });

  document.body.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
      e.target.closest('.repeat-row').remove();
    }
  });
});
