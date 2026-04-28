document.addEventListener('DOMContentLoaded', function () {
    const bgInput = document.getElementById('bg');
    const bgTransparentCheckbox = document.getElementById('bgTransparent');

    bgTransparentCheckbox.addEventListener('change', function(){
        bgInput.disabled = this.checked;
    })
})