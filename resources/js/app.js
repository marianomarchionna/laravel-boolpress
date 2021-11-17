require('./bootstrap');

let deleteform = document.querySelectorAll('.delete-post');

deleteform.forEach(item =>{
    item.addEventListener('submit', function(e) {
        const resp = confirm('Se confermi il post verrà eliminato definitivamente. Proseguire?');
        if(!resp) {
            e.preventDefault();
        }
    })
})

const alertDiv = document.querySelectorAll('.alert');
if(alertDiv[0]){
    setTimeout(()=>{
        alertDiv[0].remove();
    }, 2000);
}