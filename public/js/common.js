function del() {
    var msg = "Are you sure you want to delete it？\n\nPlease confirm！";
    if (confirm(msg)==true){
        return true;
    }else{
        return false;
    }
}