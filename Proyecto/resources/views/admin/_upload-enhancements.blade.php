<script>
document.addEventListener('DOMContentLoaded', function(){
  // For each form with class .ajax-upload-form set up drag-drop, preview and XHR submit with progress
  document.querySelectorAll('form.ajax-upload-form').forEach(function(form){
    const fileInput = form.querySelector('input[type=file][name="images[]"]');
    const preview = form.querySelector('#preview');
    const dropzone = form.querySelector('.upload-dropzone');
    const progressWrap = form.querySelector('.upload-progress-wrap');
    const progressBar = progressWrap ? progressWrap.querySelector('.progress-bar') : null;

    let stagedFiles = null; // array of File

    function renderPreview(files){
      if(!preview) return;
      preview.innerHTML = '';
      files.forEach(file => {
        if(!file.type.startsWith('image/')) return;
        const reader = new FileReader();
        const wrapper = document.createElement('div');
        wrapper.className = 'me-2 mb-2';
        reader.onload = function(e){
          const img = document.createElement('img');
          img.src = e.target.result;
          img.style.width = '120px'; img.style.height='80px'; img.style.objectFit='cover'; img.className='rounded';
          wrapper.appendChild(img);
        };
        reader.readAsDataURL(file);
        preview.appendChild(wrapper);
      });
    }

    if(fileInput){
      fileInput.addEventListener('change', function(e){
        stagedFiles = Array.from(e.target.files || []);
        renderPreview(stagedFiles);
      });
    }

    if(dropzone){
      // click to open file dialog
      dropzone.addEventListener('click', ()=> fileInput && fileInput.click());
      dropzone.addEventListener('dragover', function(e){ e.preventDefault(); dropzone.classList.add('drag-over'); });
      dropzone.addEventListener('dragleave', function(e){ e.preventDefault(); dropzone.classList.remove('drag-over'); });
      dropzone.addEventListener('drop', function(e){
        e.preventDefault(); dropzone.classList.remove('drag-over');
        const dt = e.dataTransfer;
        if(!dt) return;
        const files = Array.from(dt.files || []).filter(f=>f.type && f.type.startsWith('image/'));
        stagedFiles = files;
        // attempt to populate the file input if supported
        try{
          const dataTransfer = new DataTransfer();
          files.forEach(f=> dataTransfer.items.add(f));
          if(fileInput) fileInput.files = dataTransfer.files;
        }catch(err){
          // ignore
        }
        renderPreview(stagedFiles);
      });
    }

    // Intercept submit to send via XHR and display progress
    form.addEventListener('submit', function(e){
      // Only intercept if FormData is available and there's a file input
      if(!fileInput) return; // let default submit
      e.preventDefault();

      const xhr = new XMLHttpRequest();
      const action = form.getAttribute('action') || window.location.href;
      const method = (form.getAttribute('method') || 'POST').toUpperCase();

      const fd = new FormData();
      // append regular inputs
      Array.from(form.elements).forEach(el=>{
        if(!el.name) return;
        if(el.type === 'file') return; // skip file inputs
        if(el.type === 'checkbox' || el.type === 'radio'){
          if(!el.checked) return;
        }
        if(el.tagName === 'SELECT' && el.multiple){
          Array.from(el.selectedOptions).forEach(opt=> fd.append(el.name, opt.value));
        } else {
          fd.append(el.name, el.value);
        }
      });

      // append files: prefer stagedFiles, otherwise use fileInput.files
      const filesToSend = stagedFiles || Array.from(fileInput.files || []);
      filesToSend.forEach(f => fd.append('images[]', f));

      // show progress UI
      if(progressWrap && progressBar){ progressWrap.style.display = 'block'; progressBar.style.width = '0%'; }

      xhr.open(method, action, true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

      xhr.upload.addEventListener('progress', function(ev){
        if(!ev.lengthComputable) return;
        const pct = Math.round((ev.loaded/ev.total)*100);
        if(progressBar) progressBar.style.width = pct + '%';
      });

      xhr.addEventListener('load', function(){
        if(xhr.status >=200 && xhr.status < 300){
          // On success, redirect to final URL (responseURL)
          try{ window.location = xhr.responseURL || action; } catch(err){ window.location = action; }
        } else if(xhr.status === 422){
          // validation errors; try to parse JSON
          try{
            const json = JSON.parse(xhr.responseText);
            const msgs = [];
            for(const k in json.errors){ msgs.push(json.errors[k].join(' ')); }
            alert('Errores:\n' + msgs.join('\n'));
          }catch(err){ alert('Error en el envío.'); }
          if(progressWrap && progressBar) progressBar.style.width = '0%';
        } else {
          alert('Error en el servidor (status ' + xhr.status + ')');
          if(progressWrap && progressBar) progressBar.style.width = '0%';
        }
      });

      xhr.addEventListener('error', function(){ alert('Error de red al subir.'); if(progressWrap && progressBar) progressBar.style.width = '0%'; });
      xhr.send(fd);
    });
  });
});
</script>

<style>
.upload-dropzone{cursor:pointer;background:#f8f9fa;border:2px dashed #e9ecef;padding:18px;border-radius:6px}
.upload-dropzone.drag-over{background:#eef7ff;border-color:#8ec5ff}
.upload-progress-wrap{display:none}
</style>
