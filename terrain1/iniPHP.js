document.addEventListener('DOMContentLoaded', function() {
    var cells = document.querySelectorAll('td');
    cells.forEach(function(cell) {
        cell.addEventListener('click', function() {
            if (!this.classList.contains('blanc') && !this.classList.contains('noir')) {
                this.classList.add('blanc');
                this.innerHTML = '<span>B</span>';
            } else if (this.classList.contains('blanc')) {
                this.classList.remove('blanc');
                this.classList.add('noir');
                this.innerHTML = '<span>N</span>';
            } else {
                this.classList.remove('noir');
                this.innerHTML = '';
            }
        });
    });
});