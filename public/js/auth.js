/**
 * Authentication Helper Scripts
 */
function togglePass(id, btn) {
    const el = document.getElementById(id);
    if (!el) return;
    const isPass = el.type === 'password';
    el.type = isPass ? 'text' : 'password';
    const open = btn.querySelector('.svg-open');
    const closed = btn.querySelector('.svg-closed');
    if (open && closed) {
        open.style.display = isPass ? 'none' : 'block';
        closed.style.display = isPass ? 'block' : 'none';
    }
}

// Make togglePass globally available
window.togglePass = togglePass;
