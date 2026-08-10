@if(session('success'))
<div id="flash-alert" class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
</div>
@endif

@if(session('error'))
<div id="flash-alert" class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
    <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
</div>
@endif

@if(session('warning'))
<div id="flash-alert" class="alert alert-warning border-0 shadow-sm rounded-4 mb-4">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('warning') }}
</div>
@endif

<script>
setTimeout(function(){
    const alert=document.getElementById('flash-alert');
    if(!alert)return;
    alert.style.transition='opacity .5s';
    alert.style.opacity='0';
    setTimeout(()=>alert.remove(),500);
},3000);
</script>