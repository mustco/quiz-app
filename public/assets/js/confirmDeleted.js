function confirmDeleted($id) {
    if(confirm("Apakah Yakin Ingin Menghapus Data ini?")) {
        document.getElementById('delete-form').submit();
    }else{
        console.log($id)
    }
}